<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\EntradaCargo;
use App\Models\SalidaCargo;
use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Salida;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rcargo = Cargo::get();
        $rentradac = EntradaCargo::get();
        $rsalidac = SalidaCargo::get();
        $rentrada = Entrada::get();
        $rsalida = Salida::get();

        return view('/home' , ["rcargo"=>$rcargo, "rentradac"=>$rentradac, "rsalidac"=>$rsalidac , "rentrada"=>$rentrada, "rsalida"=>$rsalida]);
    }
}
