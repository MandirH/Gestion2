<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Cargo;
use App\Models\EntradaCargo;
use App\Models\SalidaCargo;
use App\Models\Salida;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    //
    public function Mostrar()
    {
        $rentrada = Entrada::get();
        $rsalida = Salida::get();

        return view('home', ['rentrada' => $rentrada, 'rsalida' => $rsalida]);
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

        $queryE = DB::table('entradas')->select()
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate)
            ->get();

        $queryS = DB::table('salidas')->select()
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate)
            ->get();

        return view('registro' , ["rcargo"=>$rcargo, "rentradac"=>$rentradac, "rsalidac"=>$rsalidac , "rentrada"=>$rentrada, "rsalida"=>$rsalida, "queryE"=>$queryE, "queryS"=>$queryS]);

        /*return view('registro' , ["rcargo"=>$rcargo, "rentradac"=>$rentradac, "rsalidac"=>$rsalidac , "rentrada"=>$rentrada, "rsalida"=>$rsalida], compact('queryE', 'queryS'));*/
    }
}
