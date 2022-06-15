<?php


namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function Mostrar()
    {
        $resUser = User::get();
        $rcargo = Cargo::all();

        return view('perfil', ["resUser"=>$resUser, "rcargo"=>$rcargo]);
    }
    public function Actualizar(Request $data)
    {
        $data->validate(
            [
                'nombre' => 'required | string | max:255',
                'apellido' => 'required | string | max:255',
                'dni' => 'required | int | min:8',
                'celular' => 'required | int | min:9',
                'direccion' => 'required | string | max:255',
            ]
        );

        $user = User::find($data->id);
        $user->nombre = $data['nombre'];
        $user->apellido = $data['apellido'];
        $user->dni = $data['dni'];
        $user->celular = $data['celular'];
        $user->direccion = $data['direccion'];
        $user->Save();

        return redirect()->route('perfil')->with('status', 'Usuario Actualizado!');
    }
    public function ActualizarContraseña(Request $data)
    {
        $data->validate(
            [
                'password' => 'required | string | min:8 | confirmed',
            ]
        );

        $user = User::find($data->id);
        $user->password = Hash::make($data['password']);
        $user->Save();

        return redirect()->route('perfil')->with('status', 'Contraseña Actualizada!');
    }

    /* ---- USUARIOS ---- */

    public function MostrarUsuarios()
    {
        $resUser = User::get();
        $rcargo = Cargo::get();

        return view('usuarios', ["resUser"=>$resUser, "rcargo"=>$rcargo]);
    }
    public function Crear(Request $data)
    {
        $data->validate(
            [
                'nombre' => 'required | string | max:255',
                'apellido' => 'required | string | max:255',
                'dni' => 'required | int | min:8',
                'celular' => 'required | int | min:9',
                'direccion' => 'required | string | max:255',
                'email' => 'required | string | max:255 | email',
                'password' => 'required | string | min:8 | confirmed',
            ]
        );

        $user = new User();
        $user->nombre = $data['nombre'];
        $user->apellido = $data['apellido'];
        $user->dni = $data['dni'];
        $user->celular = $data['celular'];
        $user->direccion = $data['direccion'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->cargo = $data['nombre_cargo'];
        $user->estado = 'Activo';
        $user->Save();

        return redirect()->route('usuarios')->with('status', 'Usuario Creado!');
    }
    public function Editar(Request $data)
    {
        $data->validate(
            [
                'nombre' => 'required | string | max:255',
                'apellido' => 'required | string | max:255',
                'dni' => 'required | int | min:8',
                'celular' => 'required | int | min:9',
                'direccion' => 'required | string | max:255',
                'email' => 'required | string | max:255 | email',
            ]
        );

        $user = User::find($data->id);
        $user->nombre = $data['nombre'];
        $user->apellido = $data['apellido'];
        $user->dni = $data['dni'];
        $user->celular = $data['celular'];
        $user->direccion = $data['direccion'];
        $user->email = $data['email'];
        $user->cargo = $data['nombre_cargo'];
        $user->Save();

        return redirect()->route('usuarios')->with('status', 'Usuario Actualizado!');
    }
    public function Activar(Request $data)
    {
        $planta = User::find($data->id);
        $planta->estado = 'Activo';
        $planta->save();

        return redirect()->route('usuarios')->with('status', 'Usuario Activado!');
    }

    public function Desactivar(Request $data)
    {
        $planta = User::find($data->id);
        $planta->estado = 'Inactivo';
        $planta->save();

        return redirect()->route('usuarios')->with('status', 'Usuario Inactivo!');
    }
}
