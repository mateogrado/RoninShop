<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MensajeController extends Controller
{

    public function store(Request $request)
    {

        $mensaje=(object) $request->validate([
            'nombre'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'contenido'=>['required','min:5']
        ]);

        Mail::send('emails.contact',["mensaje"=>$mensaje], function($m) use ($mensaje){
            $m->to($mensaje->email,$mensaje->nombre);
            $m->subject('Mensaje desde el formulario');
        });

        return redirect(route("contacto"))->withMessage('Hemos recibido tu mensaje');
    }
}
