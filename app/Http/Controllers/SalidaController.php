<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    public function Crear(Request $request)
    {
        $rentrada = new Salida();
        $rentrada->estado = 'Activo';
        $rentrada->id_user = $request['id'];
        $rentrada->save();
        return redirect()->route("home")->with('status', 'Salida Creada!');
    }
}
