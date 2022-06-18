<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;

class EntradaController extends Controller
{
    //
    public function Mostrar()
    {
        $rentrada = Entrada::get();
        return view('home', ['rentrada' => $rentrada]);
    }

    public function Crear(Request $request)
    {
        $rentrada = new Entrada();
        $rentrada->estado = 'Activo';
        $rentrada->id_user = $request['id'];
        $rentrada->save();
        return redirect()->route("home")->with('status', 'Entrada Creada!');
    }
}
