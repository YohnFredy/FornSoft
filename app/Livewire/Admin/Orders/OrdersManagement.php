<?php

namespace App\Livewire\Admin\Orders;

use App\Models\ActivationPt;
use App\Models\BinaryPoint;
use App\Models\Order;
use App\Models\User;
use App\Models\UserActivation;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersManagement extends Component
{
    use WithPagination;

    public $selectedStatus = '';
    public $orderStatuses = [
        1 => 'Pendiente',
        2 => 'Aprobada',
        3 => 'Puntos Generados',
        4 => 'Enviada',
        5 => 'Entregada',
        6 => 'Rechazada',
        7 => 'Anulación Aprobada',
        8 => 'Anulación Rechazada'
    ];

    // Actualizar la URL cuando cambie el filtro
    protected $queryString = ['selectedStatus'];

    public function mount()
    {
        // Inicializar con el valor de la URL o valor predeterminado
        $this->selectedStatus = request()->query('selectedStatus', '');
    }

    public function updatingSelectedStatus()
    {
        // Resetear la paginación cuando cambia el filtro
        $this->resetPage();
    }

    public function cashPayment($orderId)
    {
        $order = Order::find($orderId);
        $order->update(['status' => 2, 'payment_method' => 'efectivo']);
    }

    public function uploadPoints($orderId)
    {
        DB::transaction(function () use ($orderId) {
            $order = Order::where('id', $orderId)->where('status', 2)->first();

            if (!$order) {
                return; // Early return si la orden no existe o no está aprobada
            }

            $user = $order->user;

            // 1️⃣ Actualizar o crear puntos personales del usuario
            $this->updatePersonalPoints($user, $order->total_pts, $order->updated_at);

            // 2️⃣ Subir puntos en la estructura binaria
            $this->distributeBinaryPoints($user, $order->total_pts, $order->updated_at);

            // Marcar la orden como procesada
            $order->update(['status' => 3]);

            $this->activateIfEligible($user, $order);
        });
    }

    private function updatePersonalPoints(User $user, $points, string $approvedAt)
    {
        $binaryPoint = BinaryPoint::firstOrNew(['user_id' => $user->id], [
            'personal' => 0,
            'left_points' => 0,
            'right_points' => 0,
        ]);

        $binaryPoint->personal += $points;
        $binaryPoint->approved = $approvedAt;
        $binaryPoint->save();
    }

    private function distributeBinaryPoints(User $user, $points, string $approvedAt)
    {
        while ($user->binary && $user->binary->sponsor_id) {
            $sponsorId = $user->binary->sponsor_id;
            $side = $user->binary->side;

            // Obtener el patrocinador
            $sponsor = User::find($sponsorId);
            if (!$sponsor) {
                break; // Evita bucles infinitos si el sponsor no existe
            }

            // Buscar o crear el registro de puntos binarios del patrocinador
            $sponsorBinaryPoint = BinaryPoint::firstOrNew(['user_id' => $sponsor->id], [
                'personal' => 0,
                'left_points' => 0,
                'right_points' => 0,
            ]);

            // Sumar puntos en el lado correcto
            if ($side === 'left') {
                $sponsorBinaryPoint->left_points += $points;
            } else {
                $sponsorBinaryPoint->right_points += $points;
            }

            $sponsorBinaryPoint->approved = $approvedAt;
            $sponsorBinaryPoint->save();

            // Continuar con el siguiente patrocinador
            $user = $sponsor;
        }
    }

    public function uploadAllPoints()
    {
        DB::transaction(function () {
            Order::where('status', 2)
                ->chunk(10, function ($orders) {
                    foreach ($orders as $order) {
                        $this->uploadPoints($order->id);
                    }
                });
        });
    }

    public function activateIfEligible($user, $order)
    {
        $activationPt = ActivationPt::first();

        if (!$activationPt) {
            return; // Evita errores si no hay configuración de activación.
        }

        $activation = $user->activation;
        $mesNumero = $order->updated_at->month;

        /* total de puntos durante el mes actual que ya están aprobados */
        $monthlyPoints =  Order::where('user_id', $user->id)
            ->whereBetween('status', [2, 5]) // status >= 2 y status <= 5
            ->whereMonth('created_at', $mesNumero)
            ->whereYear('created_at', now()->year)
            ->sum('total_pts');

        $total_pts =  $monthlyPoints;

        if (!$activation &&  $total_pts >= $activationPt->min_pts_first) {
            UserActivation::create([
                'user_id'      => $user->id,
                'is_active'    => true,
                'activated_at' => $order->updated_at,
            ]);
        } elseif ($activation && !$activation->is_active &&  $total_pts  >= $activationPt->min_pts_monthly) {
            $activation->update([
                'is_active'    => true,
                'activated_at' => $order->updated_at,
            ]);
        }
    }

    public function sent($orderId)
    {
        $order = Order::find($orderId);
        $order->update(['status' => 4]);
    }
    public function delivered($orderId)
    {
        $order = Order::find($orderId);
        $order->update(['status' => 5]);
    }

    public function rejected($orderId)
    {
        $order = Order::find($orderId);
        $order->update(['status' => 6]);
    }

    public function cancellationApproved($orderId)
    {
        $order = Order::find($orderId);
        $order->update(['status' => 7]);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $orders = Order::query()
            ->when($this->selectedStatus !== '', function ($query) {
                return $query->where('status', $this->selectedStatus);
            })
            ->orderBy('id', 'desc')->paginate(10);

        // Contar órdenes aprobadas para el botón global
        $approvedOrdersCount = Order::where('status', Order::STATUS_SALE_APPROVED)->count();

        return view('livewire.admin.orders.orders-management', [
            'orders' => $orders,
            'approvedOrdersCount' => $approvedOrdersCount
        ]);
    }
}
