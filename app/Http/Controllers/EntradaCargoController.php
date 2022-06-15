<?php

namespace App\Http\Controllers;

use App\Models\EntradaCargo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EntradaCargoController extends Controller
{
    public function Crear(Request $data)
    {
        $data->validate(
            [
                'horas'=>'required | max:250 | between:1,12',
            ]
        );

        $entrada = new EntradaCargo();
        $entrada->horas = $data["horas"];
        $entrada->estado = 'Activo';
        $entrada->id_cargo = $data["nombre_cargo"];
        $entrada->save();

        return redirect()->route("home")->with('status', 'Entrada Creada!');
    }
    public function Editar(Request $data)
    {
        $data->validate(
            [
                'horas'=>'required | max:250 | between:1,12',
            ]
        );

        $entrada = EntradaCargo::find($data->id);
        $entrada->horas = $data["horas"];
        $entrada->id_cargo = $data["nombre_cargo"];
        $entrada->save();

        return redirect()->route("home")->with('status', 'Entrada Actualizada!');
    }
    public function Activar(Request $data)
    {
        $entrada = EntradaCargo::find($data->id);
        $entrada->estado = 'Activo';
        $entrada->save();

        return redirect()->route('home')->with('status', 'Entrada Activada!');
    }

    public function Desactivar(Request $data)
    {
        $entrada = EntradaCargo::find($data->id);
        $entrada->estado = 'Inactivo';
        $entrada->save();

        return redirect()->route('home')->with('status', 'Entrada Inactiva!');
    }
}
