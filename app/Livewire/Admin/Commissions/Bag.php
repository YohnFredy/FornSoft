<?php

namespace App\Livewire\Admin\Commissions;

use App\Models\Binary;
use App\Models\BinaryPoint;
use App\Models\Commission;
use App\Models\UserActivation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Bag extends Component
{
     // --- CONSTANTES DE CONFIGURACIÓN ---
    // Factor de conversión de la comisión (ej. 4000 COP, 1 USD, etc.)
    private const COMMISSION_CONVERSION_FACTOR = 4000;
    // Porcentaje de los puntos calificados que van a la bolsa comisionable.
    private const COMMISSIONABLE_POOL_PERCENTAGE = 0.10; // Representa el 10%
    // Tipo de comisión (para el registro en la base de datos)
    private const COMMISSION_TYPE = 1;

    // --- PROPIEDADES PÚBLICAS ---
    public string $startDate = '';
    public string $endDate = '';

    // --- PROPIEDADES PARA CÁLCULOS Y VISTA ---
    public float $totalGlobalPoints = 0;
    public float $pointValueFactor = 0; // Anteriormente $vfb
    public float $totalQualifiedPoints = 0; // Anteriormente $puntos
    public float $commissionablePointsPool = 0; // Anteriormente $ptsTotal
    public Collection $qualifiedUsersPoints; // Anteriormente $binaryPoints

    /**
     * Se ejecuta al inicializar el componente.
     * Carga y calcula todos los valores necesarios para la vista.
     */
    public function mount(): void
    {
        $this->loadCommissionData();
    }

    /**
     * Carga y calcula los datos de la bolsa de comisiones.
     * Este método puede ser llamado para recargar la información.
     */
    public function loadCommissionData(): void
    {
        // Obtiene los IDs de usuarios con activación vigente.
        $activeUserIds = UserActivation::where('is_active', 1)->pluck('user_id');

        // Busca los puntos binarios de usuarios activos que califican:
        // - Tienen puntos en ambas piernas (izquierda y derecha).
        // - Sus puntos no han sido liquidados (locked = 0).
        $this->qualifiedUsersPoints = BinaryPoint::with('user:id,username') // Carga la relación para no hacer N+1 queries
            ->whereIn('user_id', $activeUserIds)
            ->where('left_points', '>', 0)
            ->where('right_points', '>', 0)
            ->where('locked', 0)
            ->get();

        // Suma el menor valor de las dos piernas de cada usuario calificado.
        $this->totalQualifiedPoints = $this->qualifiedUsersPoints->sum(function ($binaryPoint) {
            return min($binaryPoint->left_points, $binaryPoint->right_points);
        });

        // Calcula el 10% del total de puntos calificados para la bolsa.
        $this->commissionablePointsPool = $this->totalQualifiedPoints * self::COMMISSIONABLE_POOL_PERCENTAGE;

        // Obtiene el punto global (del usuario con ID 1, según tu lógica original).
        $globalPointData = BinaryPoint::where('user_id', 1)->first();
        if ($globalPointData) {
            $this->totalGlobalPoints = $globalPointData->personal + $globalPointData->left_points + $globalPointData->right_points;
        }

        // Calcula el Valor Final del Bono (VFB) o Factor de Valor por Punto.
        // Evita la división por cero si no hay puntos en la bolsa.
        $this->pointValueFactor = $this->commissionablePointsPool > 0
            ? round($this->totalGlobalPoints / $this->commissionablePointsPool, 2)
            : 0;
    }

    /**
     * Genera y guarda las comisiones para todos los usuarios calificados.
     */
    public function generateCommissions(): void
    {
        // Validación de las fechas.
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        // Itera sobre la colección de usuarios calificados para generar su comisión.
        foreach ($this->qualifiedUsersPoints as $userPoints) {
            // Calcula los puntos comisionables del usuario (el 10% de sus puntos calificados).
            $userQualifiedPoints = min($userPoints->left_points, $userPoints->right_points);
            $userCommissionablePoints = $userQualifiedPoints * self::COMMISSIONABLE_POOL_PERCENTAGE;

            // Calcula la comisión final.
            $commissionAmount = ($userCommissionablePoints * $this->pointValueFactor) * self::COMMISSION_CONVERSION_FACTOR;

            // Crea el registro de la comisión en la base de datos.
            Commission::create([
                'user_id' => $userPoints->user_id,
                'type' => self::COMMISSION_TYPE,
                'vfb' => $this->pointValueFactor,
                'commission' => round($commissionAmount),
                'start' => Carbon::parse($this->startDate)->startOfDay(),
                'end' => Carbon::parse($this->endDate)->endOfDay(),
            ]);

            // Bloquea los puntos del usuario para que no sean pagados de nuevo.
            $userPoints->update(['locked' => true]);
        }

        // Muestra un mensaje de éxito al usuario.
        session()->flash('status', 'Pagos de comisiones generados exitosamente.');

        // Recarga los datos del componente para reflejar los cambios en la vista.
        $this->loadCommissionData();
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.commissions.bag');
    }
}
