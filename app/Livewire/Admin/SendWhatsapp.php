<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SendWhatsapp extends Component
{

    public $user, $users, $message, $count = 0;

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->id == 1) {

            $this->users = User::all();
        }
    }

    public function getUsers()
    {
   

        if ($this->user->id == 1) {

            $this->users = User::all();
        }
    }


    public function activeUsers()
    {
        if ($this->user->id == 1) {

            $this->users =  User::whereHas('activation', function ($query) {
                $query->where('is_active', 1);
            })->with('activation')->get();
        }
    }


    public function inactiveUsers()
    {
        if ($this->user->id == 1) {

            $this->users = User::whereHas('activation', function ($query) {
                $query->where('is_active', 0);
            })
                ->orWhereDoesntHave('activation')
                ->with('activation')
                ->get();
        }
    }

    // Agrega esta función a tu componente Livewire
    private function normalizePhoneForWhatsApp($phone)
    {
        // Remover espacios, guiones, paréntesis
        $phone = preg_replace('/[\s\-\(\)]/', '', $phone);

        // Si hay múltiples números (separados por coma, slash, etc), obtener solo el primero
        if (strpos($phone, ',') !== false) {
            $phones = explode(',', $phone);
            $phone = trim($phones[0]);
        }
        if (strpos($phone, '/') !== false) {
            $phones = explode('/', $phone);
            $phone = trim($phones[0]);
        }
        if (strpos($phone, 'o') !== false || strpos($phone, 'O') !== false) {
            $phones = explode('o', str_ireplace('o', 'o', $phone));
            $phone = trim($phones[0]);
        }

        // Remover nuevamente espacios
        $phone = trim($phone);

        // Si está vacío, retornar vacío
        if (empty($phone)) {
            return '';
        }

        // Si comienza con +57, dejarlo así
        if (strpos($phone, '+57') === 0) {
            // Validar que sea un celular colombiano (10 dígitos después de +57)
            if (strlen($phone) === 13 && is_numeric(substr($phone, 3))) {
                return $phone;
            }
            return '';
        }

        // Si comienza con 57 (sin +), agregar +
        if (strpos($phone, '57') === 0) {
            $phone = '+' . $phone;
            // Validar que sea un celular colombiano
            if (strlen($phone) === 13 && is_numeric(substr($phone, 3))) {
                return $phone;
            }
            return '';
        }

        // Si es solo 10 dígitos (número local), agregar +57
        if (strlen($phone) === 10 && is_numeric($phone)) {
            // Validar que sea celular (comienza con 3)
            if (strpos($phone, '3') === 0) {
                return '+57' . $phone;
            }
            return '';
        }

        // Si tiene 11 dígitos y comienza con 57
        if (strlen($phone) === 11 && strpos($phone, '57') === 0 && is_numeric($phone)) {
            return '+' . $phone;
        }

        return '';
    }

    // Actualiza el método exportToExcel para usar esta función
    public function exportToExcel()
    {
        $fileName = 'mensajes_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = array(
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () {
            $file = fopen('php://output', 'w');

            // BOM para UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Headers
            fputcsv($file, ['Número de Teléfono', 'Mensaje', 'Mensaje 2', 'Fecha'], ';', '"');

            // Datos
            foreach ($this->users as $user) {
                $formattedName = ucwords(strtolower(e($user->name)));
                $messageProcessed = str_replace('name', $formattedName, $this->message);

                // Normalizar teléfono para WhatsApp
                $phone = $this->normalizePhoneForWhatsApp($user->userData->phone);

                // Solo exportar si el teléfono es válido
                if (!empty($phone)) {
                    fputcsv($file, [
                        "'" . $phone,  // Agregar comilla simple para forzar formato de texto
                        $messageProcessed,
                        '',
                        ''
                    ], ';', '"');
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.send-whatsapp');
    }
}
