@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::user()->cargo == 1)
            <div class="cont-just">
                <div class="cont-just-box">
                    <div class="menu-just">
                        <ul class="ul-just">
                            <li class="li-just li-just-c">
                                <span class="icon-nav"><ion-icon name="layers"></ion-icon></span>CARGOS
                            </li>
                        </ul>
                    </div>
                    <div class="menu-just">
                        <ul class="ul-just ul-just-menu">
                            @foreach($rcargo as $cargo)
                                <a class="btn-li-just w-100" data-toggle="collapse" href="#multiCollapse{{$cargo['id']}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                    <li class="li-just w-100">
                                        <span class="icon-nav"><ion-icon name="cube"></ion-icon></span>{{$cargo['nombre_cargo']}}
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="cont-just-box">
                    @foreach($rcargo as $cargo)
                        <div class="collapse multi-collapse collapse-cont" id="multiCollapse{{$cargo['id']}}">
                            <div class="menu-just">
                                <ul class="ul-just">
                                    <li class="li-just li-just-c">
                                        <span class="icon-nav"><ion-icon name="people"></ion-icon></span>{{$cargo['nombre_cargo']}}
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-just">
                                <ul class="ul-just ul-just-menu">
                                    @foreach($ruser as $user)
                                        @if($user['cargo'] == $cargo['id'])
                                            <a class="btn-li-just w-100" data-toggle="collapse" href="#Collapse{{$user['id']}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                                <li class="li-just w-100 li-just-user">
                                                    <span class="icon-nav"><ion-icon name="person"></ion-icon></span>{{$user['nombre']}} {{$user['apellido']}}
                                                </li>
                                            </a>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="cont-just-box">
                    @foreach($ruser as $user)
                        <div class="collapse multi-collapse collapse-cont" id="Collapse{{$user['id']}}">
                            <div class="menu-just menu-just-activate">
                                <ul class="ul-just">
                                    <li class="li-just li-just-c">
                                        <span class="icon-nav"><ion-icon name="folder-open"></ion-icon></span>{{$user['nombre']}} {{$user['apellido']}}
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-just menu-just-j">
                                <ul class="ul-just ul-just-j">
                                    <?php $flag = 0 ?>@foreach($rjust as $justificacion)@if($justificacion['id_user'] == $user['id']) <?php $flag = 1 ?>@endif @endforeach
                                    @if($flag == 1)
                                            @foreach($rjust as $justificacion)
                                                @if($justificacion['id_user'] == $user['id'])
                                                    <div class="cont-box-j">
                                                        <div class="title-j">
                                                            <span class="icon-nav"><ion-icon name="mail"></ion-icon></span>{{$justificacion['tipo']}}
                                                            <div class="badge-j">
                                                                {{date('Y-m-d', strtotime($justificacion['created_at']))}}
                                                            </div>
                                                        </div>
                                                        <div class="cont-j">
                                                            <button type="button" class="btn btn-primary display-flex" data-toggle="modal" data-target="#JustificarR{{$justificacion['id']}}">
                                                                <span class="icon-nav"><ion-icon name="pencil"></ion-icon></span>Responder
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                    @else
                                        <div class="img-modal-j">
                                            <img src="/img/04.jpg" alt="no-justificaciones">
                                        </div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- MODAL JUSTIFICACION -->

            @foreach($ruser as $user)
                @foreach($rjust as $justificacion)
                    @if($justificacion['id_user'] == $user['id'])
                        <div class="modal fade" id="JustificarR{{$justificacion['id']}}" tabindex="-1" role="dialog" aria-labelledby="JustificarTardanzaTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-j" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{$justificacion['tipo']}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div class="card-body">
                                            <div class="card-box card-title-j">
                                                TITULO: {{$justificacion['titulo']}}
                                            </div>
                                            <div class="card-box card-text-j">
                                                {{$justificacion['mensaje']}}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="img-modal-j img-modal-j-j">
                                                @if($justificacion['adjunto'] == '')
                                                    <img src="/img/justificacion-no-img.png" alt="justificacion">
                                                @else
                                                    <img src="{{asset("storage/".$justificacion['adjunto'])}}" alt="justificacion">
                                                @endif
                                            </div>
                                            <form method="POST" action="{{ route('justificacion-editar') }}" enctype="multipart/form-data" id="form-just-ta{{$justificacion['id']}}">
                                                @csrf

                                                <div class="input-mg-boton">
                                                    <label for="titulo">Titulo</label>
                                                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" placeholder="Opcional" id="tituloR{{$justificacion['id']}}" name="titulo" autocomplete="titulo" autofocus>
                                                    @error('titulo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="input-mg-boton">
                                                    <label for="mensaje">Respuesta :</label>
                                                    <input type="text" class="form-control @error('mensaje') is-invalid @enderror" placeholder="Opcional" id="mensajeR{{$justificacion['id']}}" name="mensaje" rows="4" autocomplete="mensaje" autofocus>

                                                    @error('mensaje')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" form="form-just-ta{{$justificacion['id']}}" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        @endif
    </div>
@endsection
