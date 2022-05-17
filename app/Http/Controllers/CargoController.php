<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    //
    public function CrearCargo(Request $data)
    {
        $data->validate(
            [
                'nombre_cargo'=>'required | min:3 | max:250',
            ]
        );
    
        $cargo = new Cargo();
        $cargo->nombre_cargo = $data["nombre_cargo"];
        $cargo->save();
        return redirect()->route("cargo");
    }
}
