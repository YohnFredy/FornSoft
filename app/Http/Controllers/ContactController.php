<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\UserConfirmationMail;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validación del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'interes' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'g-recaptcha-response' => ['required', new Recaptcha()],
        ]);

        // Preparar datos para el correo
        $data = [
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'interes' => $validated['interes'],
            'mensaje' => $validated['mensaje'],
            'fecha' => now()->format('d/m/Y H:i'),
        ];

        try {
            // 1. Enviar el correo a la empresa
            Mail::to('info@fornuvi.com')->send(new ContactFormMail($data));

            // 2. Enviar correo de confirmación al usuario
            Mail::to($validated['email'])->send(new UserConfirmationMail($data));

            // Redireccionar con mensaje de éxito
            return redirect()
                ->back()
                ->with('success', 'Tu mensaje ha sido enviado correctamente. Te hemos enviado un correo de confirmación.');
        } catch (\Exception $e) {
            // En caso de error, redireccionar con mensaje de error
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un problema al enviar tu mensaje. Por favor, intenta nuevamente más tarde.']);
        }
    }
}
