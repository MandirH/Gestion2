<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Gráficos -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/estilos.css">

    <!-- Date Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <style>
        .titulo{
            font-size: 1.5rem;
            text-align: center;
            width: 100%;
            background-color: #a2c5e7;
            font-weight: 700;
        }
        .tabla {
            width: 100%;
            max-width: 100%;
            margin-bottom: $spacer;
            background-color: $table-bg; // Reset for nesting within parents with `background-color`.

            th,
            td {
                padding: $table-cell-padding;
                vertical-align: top;
                border-top: $table-border-width solid $table-border-color;
            }

            thead th {
                vertical-align: bottom;
                border-bottom: (2 * $table-border-width) solid $table-border-color;
            }

            tbody + tbody {
                border-top: (2 * $table-border-width) solid $table-border-color;
            }

            .tabla {
                background-color: $body-bg;
            }
        }
        th,td{
            padding: 0.5rem 0.5rem;
        }
    </style>
</head>
<body>
<div id="app">
    <main class="py-4">
    <div class="container">
    @if(Auth::user()->cargo == 1)
    @else
    <div class="contenedor-home justify-content-center">
            <div class="box-home-registro">
                @if(session('status'))
                    @if(session('status')=='Entrada Creada!')
                        <div class="alert alert-esp alert-primary alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">REGISTRADO!</strong> Entrada registrada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('status')=='Entrada Actualizada!')
                        <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZDO!</strong> Entrada actualizada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('status')=='Entrada Activada!')
                        <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTIVADO!</strong> Entrada activada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('status')=='Entrada Inactiva!')
                        <div class="alert alert-esp alert-danger alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">INACTIVO!</strong> Entrada inactiva.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endif
                <div class="cont-body-prin mr-20px">
                    <div class="cont-body-box-table">
                        <div class="titulo">REPORTE</div>
                        <table class="table tabla table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="cell-align"><span class="icon-nav-table"><ion-icon name="git-merge-outline"></ion-icon></span></th>
                                <th scope="col">Día</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Salida</th>
                                <th scope="col">Total</th>
                                <th scope="col">Recuperar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 1; $ArrayHoraA = array(); $ArrayMinA = array(); $ArraySegA = array(); $ArrayHoraB = array(); $ArrayMinB = array(); $ArraySegB = array();?>
                            @if(isset($queryE) && isset($queryS))
                                @foreach($queryE as $datae)
                                    @foreach($queryS as $datas)
                                        @if(date("Y-m-d", strtotime($datae->created_at)) == date("Y-m-d", strtotime($datas->created_at)))
                                            <tr>
                                                <th scope="row" class="cell-align">{{$cont++}}</th>
                                                <td class="cell-align">{{date("Y-m-d", strtotime($datae->created_at))}}</td>
                                                <td class="cell-align">{{date("H:i:s", strtotime($datae->created_at))}}</td>
                                                <td class="cell-align">{{date("H:i:s", strtotime($datas->created_at))}}</td>
                                                <td class="cell-align">
                                                    <?php
                                                        $hora = abs(intval(date("H", strtotime($datas->created_at))) - intval(date("H:i:s", strtotime($datae->created_at))));
                                                        $min = abs(intval(date("i", strtotime($datas->created_at))) - intval(date("i", strtotime($datae->created_at))));
                                                        $seg = abs(intval(date("s", strtotime($datas->created_at))) - intval(date("s", strtotime($datae->created_at))));

                                                        if($hora < 10 && $min < 10 && $seg < 10){
                                                            echo '0' . $hora . ":0" . $min . ":0" . $seg;
                                                        }elseif($hora < 10 && $min < 10){
                                                            echo '0' . $hora . ":0" . $min . ":" . $seg;
                                                        }elseif($min < 10 && $seg < 10){
                                                            echo $hora . ":0" . $min . ":0" . $seg;
                                                        }elseif($hora < 10){
                                                            echo '0' . $hora . ":" . $min . ":" . $seg;
                                                        }elseif($min < 10){
                                                            echo $hora . ":0" . $min . ":" . $seg;
                                                        }elseif($seg < 10){
                                                            echo $hora . ":" . $min . ":0" . $seg;
                                                        }else{
                                                            echo $hora . ":" . $min . ":" . $seg;
                                                        }

                                                        array_push($ArrayHoraA, $hora);
                                                        array_push($ArrayMinA, $min);
                                                        array_push($ArraySegA, $seg);

                                                        $sumSegMin = floor(array_sum($ArraySegA)/60);
                                                        $sumSeg = array_sum($ArraySegA)%60;

                                                        $sumMinHora = floor(array_sum($ArrayMinA)/60);
                                                        $sumMin = array_sum($ArrayMinA)%60 + $sumSegMin;

                                                        $sumHora = array_sum($ArrayHoraA) + $sumMinHora;
                                                    ?>
                                                </td>
                                                <td class="cell-align">
                                                    @foreach ($rcargo as $cargo)
                                                        @if(Auth::user()->cargo == $cargo['id'])
                                                            <?php
                                                                $recS = 60 - $seg;
                                                                $recM = 60 - $min;
                                                                $recH = $cargo['horas_cargo'] - $hora -1;

                                                                if($recS == 60){
                                                                    $recS = 0;
                                                                }

                                                                if($recM == 60 && $recS == 60){
                                                                    $resM = 0;
                                                                }else{
                                                                    $recM = 60 - $min -1;
                                                                }

                                                                if($recH < 10 && $recM < 10 && $recS < 10){
                                                                    echo '0' . $recH . ":0" . $recM . ":0" . $recS;
                                                                }elseif($recH < 10 && $recM < 10){
                                                                    echo '0' . $recH . ":0" . $recM . ":" . $recS;
                                                                }elseif($recM < 10 && $recS < 10){
                                                                    echo $recH . ":0" . $recM . ":0" . $recS;
                                                                }elseif($recH < 10){
                                                                    echo '0' . $recH . ":" . $recM . ":" . $recS;
                                                                }elseif($recM < 10){
                                                                    echo $recH . ":0" . $recM . ":" . $recS;
                                                                }elseif($recS < 10){
                                                                    echo $recH . ":" . $recM . ":0" . $recS;
                                                                }else{
                                                                    echo $recH . ":" . $recM . ":" . $recS;
                                                                }

                                                                array_push($ArrayHoraB, $recH);
                                                                array_push($ArrayMinB, $recM);
                                                                array_push($ArraySegB, $recS);

                                                                $sumSegMinB = floor(array_sum($ArraySegB)/60);
                                                                $sumSegB = array_sum($ArraySegB)%60;

                                                                $sumMinHoraB = floor(array_sum($ArrayMinB)/60);
                                                                $sumMinB = array_sum($ArrayMinB)%60 + $sumSegMinB;

                                                                $sumHoraB = array_sum($ArrayHoraB) + $sumMinHoraB;
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" class="cell-align" colspan="4"><span class="cell-flex"><span class="icon-nav"><ion-icon name="git-network-outline"></ion-icon></span>TOTAL</span></th>
                                    <td scope="col" class="td-green">
                                        @if(isset($queryE) && isset($queryS))
                                            @if(!empty($sumHora) || !empty($sumMin) || !empty($sumSeg))
                                                <?php
                                                    if($sumHora < 10 && $sumMin < 10 && $sumSeg < 10){
                                                        echo '0' . $sumHora . ":0" . $sumMin . ":0" . $sumSeg;
                                                    }elseif($sumHora < 10 && $sumMin < 10){
                                                        echo '0' . $sumHora . ":0" . $sumMin . ":" . $sumSeg;
                                                    }elseif($sumMin < 10 && $sumSeg < 10){
                                                        echo $sumHora . ":0" . $sumMin . ":0" . $sumSeg;
                                                    }elseif($sumHora < 10){
                                                        echo '0' . $sumHora . ":" . $sumMin . ":" . $sumSeg;
                                                    }elseif($sumMin < 10){
                                                        echo $sumHora . ":0" . $sumMin . ":" . $sumSeg;
                                                    }elseif($sumSeg < 10){
                                                        echo $sumHora . ":" . $sumMin . ":0" . $sumSeg;
                                                    }else{
                                                        echo $sumHora . ":" . $sumMin . ":" . $sumSeg;
                                                    }
                                                ?>
                                            @else
                                                --:--:--
                                            @endif
                                        @else
                                            --:--:--
                                        @endif
                                    </td>
                                    <td scope="col" class="td-red">
                                        @if(isset($queryE) && isset($queryS))
                                            @if(!empty($sumHoraB) || !empty($sumMinB) || !empty($sumSegB))
                                                <?php
                                                    if($sumHoraB < 10 && $sumMinB < 10 && $sumSegB < 10){
                                                        echo '0' . $sumHoraB . ":0" . $sumMinB . ":0" . $sumSegB;
                                                    }elseif($sumHoraB < 10 && $sumMinB < 10){
                                                        echo '0' . $sumHoraB . ":0" . $sumMinB . ":" . $sumSegB;
                                                    }elseif($sumMin < 10 && $sumSeg < 10){
                                                        echo $sumHoraB . ":0" . $sumMinB . ":0" . $sumSegB;
                                                    }elseif($sumHoraB < 10){
                                                        echo '0' . $sumHoraB . ":" . $sumMinB . ":" . $sumSegB;
                                                    }elseif($sumMinB < 10){
                                                        echo $sumHoraB . ":0" . $sumMinB . ":" . $sumSegB;
                                                    }elseif($sumSegB < 10){
                                                        echo $sumHoraB . ":" . $sumMinB . ":0" . $sumSegB;
                                                    }else{
                                                        echo $sumHoraB . ":" . $sumMinB . ":" . $sumSegB;
                                                    }
                                                ?>
                                            @else
                                                --:--:--
                                            @endif
                                        @else
                                            --:--:--
                                        @endif
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Usuario -->
        <script type="text/javascript">
            function submitData(){
                document.forms["pdfForm"].submit();
            }
        </script>
    @endif
</div>
        
    </main>
</div>

<!-- Iconos -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
