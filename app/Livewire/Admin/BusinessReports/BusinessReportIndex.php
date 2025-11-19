<?php

namespace App\Livewire\Admin\BusinessReports;

use App\Models\ActivationPt;
use App\Models\BinaryPoint;
use App\Models\BusinessReport;
use App\Models\Invoice;
use App\Models\User;
use App\Models\UserActivation;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BusinessReportIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search = '', $searchTerms;
    public $total = false;
    public $user = false;
    public $report, $invoice, $pts;

    public function searchEnter()
    {
        if (empty(trim($this->search))) {
            $this->clearSearch();
        } else {
            $this->searchTerms = array_filter(explode(' ', $this->search));
            $this->resetPage();
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->searchTerms = [];
        $this->resetPage();
    }

    public function destroy($id)
    {
        $this->authorize('admin.businessReports.destroy');

        $BusinessReport = BusinessReport::findOrFail($id);

        // Eliminar el registro
        $BusinessReport->delete();

        session()->flash('success', 'El soporte fue eliminado correctamente.');
    }

    public function compare($reportId)
    {

        $this->authorize('admin.businessReports.edit');

        $this->report = BusinessReport::find($reportId);
        $this->invoice = Invoice::where('invoice_number', $this->report->invoice_number)->first();
        if ($this->invoice->total_amount === $this->report->total_amount) {
            $this->total = true;
        }
        $user = User::where('dni', $this->report->user_dni)->first();
        if ($user) {

            if ($this->invoice->user_id === $user->id) {
                $this->user = true;
            }
        }

        $subTotal = $this->report->commission / 1.19;
        $bonoSocio =   $subTotal * 0.05;
        $empresa = $subTotal * 0.32;
        $saldo = $subTotal - $bonoSocio - $empresa;
        $valorPunto =  $saldo / 4000;
        $valorPunto = round($valorPunto, 2);
        $pts =  $valorPunto * 0.30;
        $this->pts = round($pts, 2);

        Flux::modal('edit-profile')->show();
    }

    public function approve()
    {

        $this->authorize('admin.businessReports.edit');

        $this->subir();
        Flux::modal('edit-profile')->close();
        session()->flash('success', 'El soporte fue aprobado.');
    }

    public function subir()
    {
        DB::transaction(function () {
            $this->invoice->update([
                'pts' => $this->pts,
                'status' => 'approved'
            ]);
            $this->report->update([
                'status' => 'approved'
            ]);

            $user = User::find($this->invoice->user_id);

            // 1️⃣ Actualizar o crear puntos personales del usuario
            $this->updatePersonalPoints($user, $this->pts);

            // 2️⃣ Subir puntos en la estructura binaria
            $this->distributeBinaryPoints($user, $this->pts);

            // 3️⃣ Activar usuario si cumple condiciones
            $this->activateIfEligible($user);
        });
    }

    public function activateIfEligible($user)
    {
        $activationPt = ActivationPt::first();

        if (!$activationPt) {
            return; // Evita errores si no hay configuración de activación.
        }

        $activation = $user->activation;

        /* total de puntos durante el mes actual que ya están aprobados */
        $total_pts =  $user->binaryPoint->personal;

        if (!$activation &&  $total_pts >= $activationPt->min_pts_first) {
            UserActivation::create([
                'user_id'      => $user->id,
                'is_active'    => true,
                'activated_at' => now(),
            ]);
        } elseif ($activation && !$activation->is_active &&  $total_pts  >= $activationPt->min_pts_monthly) {
            $activation->update([
                'is_active' => true,
                'activated_at' => now(),
            ]);
        }
    }

    private function distributeBinaryPoints(User $user, $points)
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

            $sponsorBinaryPoint->save();

            // Continuar con el siguiente patrocinador
            $user = $sponsor;
        }
    }

    private function updatePersonalPoints(User $user, $points)
    {
        $binaryPoint = BinaryPoint::firstOrNew(['user_id' => $user->id], [
            'personal' => 0,
            'left_points' => 0,
            'right_points' => 0,
        ]);

        $binaryPoint->personal += $points;
        $binaryPoint->save();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {

        $this->authorize('admin.businessReports.index');

        return view('livewire.admin.business-reports.business-report-index', [
            'businessReports' => BusinessReport::orderBy('id', 'desc')->paginate(10),
        ]);
    }
}
