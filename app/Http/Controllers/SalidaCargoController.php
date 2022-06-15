<?php

namespace App\Http\Controllers;

use App\Models\SalidaCargo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SalidaCargoController extends Controller
{
    public function Crear(Request $data)
    {
        $data->validate(
            [
                'horas'=>'required | max:250 | between:1,12',
            ]
        );

        $salida = new SalidaCargo();
        $salida->horas = $data["horas"];
        $salida->estado = 'Activo';
        $salida->id_cargo = $data["nombre_cargo"];
        $salida->save();

        return redirect()->route("home")->with('status', 'Salida Creada!');
    }
    public function Editar(Request $data)
    {
        $data->validate(
            [
                'horas'=>'required | max:250 | between:1,12',
            ]
        );

        $salida = SalidaCargo::find($data->id);
        $salida->horas = $data["horas"];
        $salida->estado = 'Activo';
        $salida->id_cargo = $data["nombre_cargo"];
        $salida->save();

        return redirect()->route("home")->with('status', 'Salida Actualizada!');
    }
    public function Activar(Request $data)
    {
        $salida = SalidaCargo::find($data->id);
        $salida->estado = 'Activo';
        $salida->save();

        return redirect()->route('home')->with('status', 'Salida Activada!');
    }

    public function Desactivar(Request $data)
    {
        $salida = SalidaCargo::find($data->id);
        $salida->estado = 'Inactivo';
        $salida->save();

        return redirect()->route('home')->with('status', 'Salida Inactiva!');
    }
}
