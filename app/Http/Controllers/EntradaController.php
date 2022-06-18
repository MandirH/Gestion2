<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Cargo;
use App\Models\EntradaCargo;
use App\Models\SalidaCargo;
use App\Models\Salida;

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

    public function mostrarRegistro()
    {
        $rcargo = Cargo::get();
        $rentradac = EntradaCargo::get();
        $rsalidac = SalidaCargo::get();
        $rentrada = Entrada::get();
        $rsalida = Salida::get();

        return view('/registro' , ["rcargo"=>$rcargo, "rentradac"=>$rentradac, "rsalidac"=>$rsalidac , "rentrada"=>$rentrada, "rsalida"=>$rsalida]);
    }

    public function buscarRegistro(Request $data)
    {
        $rcargo = Cargo::get();
        $rentradac = EntradaCargo::get();
        $rsalidac = SalidaCargo::get();
        $rentrada = Entrada::get();
        $rsalida = Salida::get();


        $fromDate = $data->input('fromDate');
        $toDate = $data->input('toDate');

        $query = DB::table('entradas')->select()
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate)
            ->get();
        return view('buscarRegistro' , ["rcargo"=>$rcargo, "rentradac"=>$rentradac, "rsalidac"=>$rsalidac , "rentrada"=>$rentrada, "rsalida"=>$rsalida], compact('query'));

        /*$rentradas = Entrada::get();

        foreach($rentradas as $entradas){
            if($entradas['id_user']==$data['id']){
                if($entradas['created_at']>=$data['fromDate'] && $entradas['created_at']<=$data['toDate'] ){

                }

            }            
        }*/
    }
}
