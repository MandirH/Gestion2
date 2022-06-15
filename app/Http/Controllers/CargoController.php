<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function Mostrar(){
        $rcargo = Cargo::get();
        return view('/cargo' , ["rcargo"=>$rcargo]);
    }

    public function CrearCargo(Request $data)
    {
        $data->validate(
            [
                'nombre_cargo'=>'required | min:3 | max:250',
                'horas_cargo'=>'required | max:250 | between:1,12',
            ]
        );

        $cargo = new Cargo();
        $cargo->nombre_cargo = $data["nombre_cargo"];
        $cargo->horas_cargo = $data["horas_cargo"];
        $cargo->estado = 'Activo';
        $cargo->save();

        return redirect()->route("cargos")->with('status', 'Cargo Creado!');
    }
    public function Editar(Request $data)
    {
        $data->validate(
            [
                'nombre_cargo'=>'required | min:3 | max:250',
                'horas_cargo'=>'required | max:250 | between:1,12',
            ]
        );

        $cargo = Cargo::find($data->id);
        $cargo->nombre_cargo = $data["nombre_cargo"];
        $cargo->horas_cargo = $data["horas_cargo"];
        $cargo->save();

        return redirect()->route("cargos")->with('status', 'Cargo Actualizado!');
    }
    public function Activar(Request $data)
    {
        $planta = Cargo::find($data->id);
        $planta->estado = 'Activo';
        $planta->save();

        return redirect()->route('cargos')->with('status', 'Cargo Activado!');
    }

    public function Desactivar(Request $data)
    {
        $planta = Cargo::find($data->id);
        $planta->estado = 'Inactivo';
        $planta->save();

        return redirect()->route('cargos')->with('status', 'Cargo Inactivo!');
    }
}
