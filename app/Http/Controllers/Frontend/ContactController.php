<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'empresa' => 'nullable|string|max:255',
            'servicio' => 'required|string',
            'como_supiste' => 'nullable|string',
            'mensaje' => 'required|string|max:2000',
        ]);

        try {
            ContactMessage::create($validated);
            
            return response()->json([
                'success' => true,
                'message' => '¡Mensaje enviado exitosamente! Te contactaremos pronto.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el mensaje. Por favor, inténtalo nuevamente.'
            ], 500);
        }
    }
}