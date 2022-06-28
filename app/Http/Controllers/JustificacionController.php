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
        if($request["adjunto"]!="") {
            $request->validate(
                [
                    'titulo' => ['required', 'string', 'max:255'],
                    'mensaje' => ['required', 'string', 'max:255'],
                    'adjunto' => ['mimes:jpeg,bmp,png,jpg'],
                ]
            );

            $file = $request["adjunto"];
            $nombre =  time()."_".$file->getClientOriginalName();
            \Storage::disk('public')->put($nombre,  \File::get($file));

            $justificacion = new Justificacion();
            $justificacion->adjunto = $nombre;

        }else{
            $request->validate(
                [
                    'titulo' => ['required', 'string', 'max:255'],
                    'mensaje' => ['required', 'string', 'max:255'],
                ]
            );

            $justificacion = new Justificacion();
            $justificacion->adjunto = $request["adjunto"];
        }

        $justificacion->tipo = $request['tipo'];
        $justificacion->titulo = $request['titulo'];
        $justificacion->mensaje = $request['mensaje'];
        $justificacion->id_user = $request['id'];
        $justificacion->save();
        return redirect()->route("home")->with('status', 'Justificación Creada!');
    }
    public function Editar(Request $request)
    {
        if($request["adjunto"]!="") {
            $request->validate(
                [
                    'titulo' => ['required', 'string', 'max:255'],
                    'mensaje' => ['required', 'string', 'max:255'],
                    'adjunto' => ['mimes:jpeg,bmp,png,jpg'],
                ]
            );

            $file = $request["adjunto"];
            $nombre =  time()."_".$file->getClientOriginalName();
            \Storage::disk('public')->put($nombre,  \File::get($file));

            $justificacion = Justificacion::find($request->id_justificacion);
            $justificacion->adjunto = $nombre;

        }else{
            $request->validate(
                [
                    'titulo' => ['required', 'string', 'max:255'],
                    'mensaje' => ['required', 'string', 'max:255'],
                ]
            );

            $justificacion = Justificacion::find($request->id_justificacion);
        }

        $justificacion->tipo = $request['tipo'];
        $justificacion->titulo = $request['titulo'];
        $justificacion->mensaje = $request['mensaje'];
        $justificacion->id_user = $request['id'];
        $justificacion->save();
        return redirect()->route("home")->with('status', 'Justificación Actualizada!');
    }
    public function Eliminar(Request $request)
    {
        $justificacion = Justificacion::find($request->id_justificacion);
        $justificacion->delete();

        return redirect()->route("home")->with('status', 'Justificación Eliminada!');
    }
}
