<?php

namespace App\Http\Controllers;

use App\Models\Justificacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class JustificacionController extends Controller
{
    //ewe
    public function Crear(Request $request)
    {
        $rjustificacion = new Justificacion();
        $rjustificacion->titulo = 'titulo';
        $rjustificacion->mensaje = 'mensaje';
        $rjustificacion->id_user = $request['id'];
        $rjustificacion->save();
        return redirect()->route("home")->with('status', 'Justificación Enviada!');
    }
}
