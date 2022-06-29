<?php

namespace App\Http\Controllers;
use App\Models\Justificacion;
use App\Models\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function Aceptar(Request $request){
          
        $request->validate(
            [
                'titulo' => ['required', 'string', 'max:255'],
                'respuesta' => ['required', 'string', 'max:255'],
            ]
        );

        $respuesta = new Respuesta();
        $respuesta->titulo = $request['titulo'];
        $respuesta->respuesta = $request['respuesta'];
        $respuesta->aceptacion = $request['aceptacion'];
        $respuesta->id_justificacion = $request['id'];
        $respuesta->save();

        return redirect()->route("justificacion-mostrar")->with('status', 'Respuesta Enviada!');
    }
}
