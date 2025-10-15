<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\BienvenidoMail;

class MailController extends Controller
{
    public function enviarCorreo(Request $request)
    {
        $correo = $request->input('email'); // email que te pasa Angular

        Mail::to($correo)->send(new BienvenidoMail());

        return response()->json(['message' => 'Correo enviado correctamente']);
    }
}
