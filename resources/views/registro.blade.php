@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->cargo == 1)
        <div class="contenedor-home justify-content-center">
            <div class="box-home box-home-left">
                <div class="cont-form-cargo">
                    @if(session('status'))
                        @if(session('status')=='Entrada Creada!')
                            <div class="alert alert-esp alert-primary alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">CREADO!</strong> Entrada creada.
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
                    <div class="cont-body-prin">
                        <div class="card-header card-header-mod">
                            {{ __('ENTRADAS') }}
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('entrada-cargo-crear') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="horas" class="col-md-4 col-form-label text-md-end">{{ __('Hora') }}</label>

                                    <div class="col-md-6">
                                        <input id="horas" type="number" placeholder="maximo 12 horas" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{ old('horas') }}" required autocomplete="horas" autofocus>

                                        @error('horas')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                                    <div class="col-md-6">
                                        <select id="nombre_cargo" aria-label="Default select example" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{ old('nombre_cargo') }}" required autocomplete="producto_categoria" autofocus>
                                            @foreach ($rcargo as $cargo)
                                                <option value={{$cargo->id}}>{{$cargo->nombre_cargo}}</option>
                                            @endforeach
                                        </select>

                                        @error('cargp')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="cont-body-prin mr-20px">
                        <div class="cont-body-box-table">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="cell-align"><span class="icon-nav-table"><ion-icon name="git-merge-outline"></ion-icon></span></th>
                                    <th scope="col">Cargo</th>
                                    <th scope="col">Horas</th>
                                    <th scope="col" class="display-off">Fecha</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rentradac as $entrada)
                                    <tr>
                                        <th scope="row" class="cell-align">{{$entrada['id']}}</th>
                                        <td class="cell-align">
                                            @foreach($rcargo as $cargo)
                                                @if($entrada['id_cargo'] == $cargo['id'])
                                                    {{$cargo['nombre_cargo']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="cell-align">{{$entrada['horas']}} horas</td>
                                        <td class="cell-align display-off">{{$entrada['created_at']}}</td>
                                        <td class="cell-align">
                                            <button type="submit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#ModalPlanta{{$entrada['id']}}">
                                                <span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>{{ __('Editar') }}
                                            </button>
                                        </td>
                                        <td class="cell-align">
                                            @if($entrada["estado"] == 'Activo')
                                                <div class="form-check form-switch">
                                                    <form method='post' action='{{ route('entrada-cargo-desactivar') }}' id="formActivate{{$entrada['id']}}">
                                                        @csrf
                                                        <input type='hidden' name='id' value='{{$entrada['id']}}'>
                                                        <input class="form-check-input" type="checkbox" value="{{$entrada['id']}}" id="{{$entrada['id']}}" onchange="document.getElementById('formActivate{{$entrada['id']}}').submit()" checked>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="form-check form-switch">
                                                    <form method='post' action='{{ route('entrada-cargo-activar') }}' id="formActivate{{$entrada['id']}}">
                                                        @csrf
                                                        <input type='hidden' name='id' value='{{$entrada['id']}}'>
                                                        <input class="form-check-input" type="checkbox" value="" id="{{$entrada['id']}}" onchange="document.getElementById('formActivate{{$entrada['id']}}').submit()">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Inactivo</label>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-home box-home-right">
                <div class="cont-form-cargo">
                    @if(session('status'))
                        @if(session('status')=='Salida Creada!')
                            <div class="alert alert-esp alert-primary alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">CREADO!</strong> Salida creada.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Salida Actualizada!')
                            <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZDO!</strong> Salida actualizada.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Salida Activada!')
                            <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTIVADO!</strong> Salida activada.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Salida Inactiva!')
                            <div class="alert alert-esp alert-danger alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">INACTIVO!</strong> Salida inactiva.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    @endif
                    <div class="cont-body-prin mr-20px-activate">
                        <div class="card-header card-header-mod">
                            {{ __('SALIDAS') }}
                            <img src="/img/salida.png" alt="Register" class="login-img">
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('salida-cargo-crear') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="horas" class="col-md-4 col-form-label text-md-end">{{ __('Hora') }}</label>

                                    <div class="col-md-6">
                                        <input id="horas" type="number" placeholder="maximo 12 horas" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{ old('horas') }}" required autocomplete="horas" autofocus>

                                        @error('horas')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                                    <div class="col-md-6">
                                        <select id="nombre_cargo" aria-label="Default select example" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{ old('nombre_cargo') }}" required autocomplete="producto_categoria" autofocus>
                                            @foreach ($rcargo as $cargo)
                                                <option value={{$cargo->id}}>{{$cargo->nombre_cargo}}</option>
                                            @endforeach
                                        </select>

                                        @error('cargp')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="cont-body-prin mr-20px">
                        <div class="cont-body-box-table">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="cell-align"><span class="icon-nav-table"><ion-icon name="git-merge-outline"></ion-icon></span></th>
                                    <th scope="col">Cargo</th>
                                    <th scope="col">Horas</th>
                                    <th scope="col" class="display-off">Fecha</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rsalidac as $salida)
                                    <tr>
                                        <th scope="row" class="cell-align">{{$salida['id']}}</th>
                                        <td class="cell-align">
                                            @foreach($rcargo as $cargo)
                                                @if($salida['id_cargo'] == $cargo['id'])
                                                    {{$cargo['nombre_cargo']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="cell-align">{{$salida['horas']}} horas</td>
                                        <td class="cell-align display-off">{{$salida['created_at']}}</td>
                                        <td class="cell-align">
                                            <button type="submit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#ModalPlantaS{{$salida['id']}}">
                                                <span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>{{ __('Editar') }}
                                            </button>
                                        </td>
                                        <td class="cell-align">
                                            @if($salida["estado"] == 'Activo')
                                                <div class="form-check form-switch">
                                                    <form method='post' action='{{ route('salida-cargo-desactivar') }}' id="formActivateS{{$salida['id']}}">
                                                        @csrf
                                                        <input type='hidden' name='id' value='{{$salida['id']}}'>
                                                        <input class="form-check-input" type="checkbox" value="{{$salida['id']}}" id="{{$salida['id']}}" onchange="document.getElementById('formActivateS{{$salida['id']}}').submit()" checked>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="form-check form-switch">
                                                    <form method='post' action='{{ route('salida-cargo-activar') }}' id="formActivateS{{$salida['id']}}">
                                                        @csrf
                                                        <input type='hidden' name='id' value='{{$salida['id']}}'>
                                                        <input class="form-check-input" type="checkbox" value="" id="{{$salida['id']}}" onchange="document.getElementById('formActivateS{{$salida['id']}}').submit()">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Inactivo</label>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-home-center">
            <div class="cont-form-cargo">
                <div class="cont-body-prin-e-s">
                    @if(session('status'))
                        @if(session('status')=='Cargo Activado!')
                            <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTIVADO!</strong> Cargo Activado.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Cargo Inactivo!')
                            <div class="alert alert-esp alert-danger alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">INACTIVO!</strong> Cargo Inactivo.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Cargo Actualizado!')
                            <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZDO!</strong> Cargo actualizado.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    @endif
                    <div class="cont-body-box-table">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="cell-align"><span class="icon-nav-table"><ion-icon name="git-merge-outline"></ion-icon></span></th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Salida</th>
                                <th scope="col">Horas</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rcargo as $cargo)
                                <tr>
                                    <th scope="row" class="cell-align">{{$cargo['id']}}</th>
                                    <td class="cell-align">{{$cargo['nombre_cargo']}}</td>
                                    <td class="cell-align">
                                        @foreach($rentradac as $entrada)
                                            @if($entrada['id_cargo'] == $cargo['id'])
                                                {{$entrada['horas']}} horas
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="cell-align">
                                        @foreach($rsalidac as $salida)
                                            @if($salida['id_cargo'] == $cargo['id'])
                                                {{$salida['horas']}} horas
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="cell-align">{{$cargo['horas_cargo']}} horas</td>
                                    <td class="cell-align">
                                        <button type="submit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#ModalPlantaC{{$cargo['id']}}">
                                            <span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>{{ __('Editar') }}
                                        </button>
                                    </td>
                                    <td class="cell-align">
                                        @if($cargo["estado"] == 'Activo')
                                            <div class="form-check form-switch">
                                                <form method='post' action='{{ route('cargo-desactivar-home') }}' id="formActivateC{{$cargo['id']}}">
                                                    @csrf
                                                    <input type='hidden' name='id' value='{{$cargo['id']}}'>
                                                    <input class="form-check-input" type="checkbox" value="{{$cargo['id']}}" id="{{$cargo['id']}}" onchange="document.getElementById('formActivateC{{$cargo['id']}}').submit()" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                                                </form>
                                            </div>
                                        @else
                                            <div class="form-check form-switch">
                                                <form method='post' action='{{ route('cargo-activar-home') }}' id="formActivateC{{$cargo['id']}}">
                                                    @csrf
                                                    <input type='hidden' name='id' value='{{$cargo['id']}}'>
                                                    <input class="form-check-input" type="checkbox" value="" id="{{$cargo['id']}}" onchange="document.getElementById('formActivateC{{$cargo['id']}}').submit()">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Inactivo</label>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        @foreach($rentradac as $entrada)
            <div class="modal fade" id="ModalPlanta{{$entrada['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-img">
                                <img src="/img/01.gif" alt="gif-house">
                            </div>
                            <form method="POST" action="{{ route('entrada-cargo-editar') }}" id="FormPl{{$entrada["id"]}}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="horas" class="col-md-4 col-form-label text-md-end">{{ __('Hora') }}</label>

                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="{{$entrada['id']}}">
                                        <input id="horas" type="number" placeholder="maximo 12 horas" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{$entrada['horas']}}" required autocomplete="horas" autofocus>

                                        @error('horas')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                                    <div class="col-md-6">
                                        <select id="nombre_cargo" aria-label="Default select example" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{ old('nombre_cargo') }}" required autocomplete="producto_categoria" autofocus>
                                            @foreach ($rcargo as $cargo)
                                                @if($cargo['id'] == $entrada['id_cargo'])
                                                    <option value={{$cargo->id}} selected>{{$cargo->nombre_cargo}}</option>
                                                @else
                                                    <option value={{$cargo->id}}>{{$cargo->nombre_cargo}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('cargp')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="FormPl{{$entrada["id"]}}">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @foreach($rsalidac as $salida)
            <div class="modal fade" id="ModalPlantaS{{$salida['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-img">
                                <img src="/img/01.gif" alt="gif-house">
                            </div>
                            <form method="POST" action="{{ route('salida-cargo-editar') }}" id="FormPlS{{$salida["id"]}}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="horas" class="col-md-4 col-form-label text-md-end">{{ __('Hora') }}</label>

                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="{{$salida['id']}}">
                                        <input id="horas" type="number" placeholder="maximo 12 horas" class="form-control @error('horas') is-invalid @enderror" name="horas" value="{{$salida["horas"]}}" required autocomplete="horas" autofocus>

                                        @error('horas')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                                    <div class="col-md-6">
                                        <select id="nombre_cargo" aria-label="Default select example" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{ old('nombre_cargo') }}" required autocomplete="producto_categoria" autofocus>
                                            @foreach ($rcargo as $cargo)
                                                @if($cargo['id'] == $salida['id_cargo'])
                                                    <option value={{$cargo->id}} selected>{{$cargo->nombre_cargo}}</option>
                                                @else
                                                    <option value={{$cargo->id}}>{{$cargo->nombre_cargo}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('cargp')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="FormPlS{{$salida["id"]}}">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    <!-- Modal Cargo Home -->

        @foreach($rcargo as $cargo)
            <div class="modal fade" id="ModalPlantaC{{$cargo['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-img">
                                <img src="/img/01.gif" alt="gif-house">
                            </div>
                            <form method="POST" action="{{ route('cargo-editar-home') }}" enctype="multipart/form-data" id="FormPlC{{$cargo["id"]}}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del Cargo') }}</label>

                                    <div class="col-md-6">
                                        <input id="nombre_cargo" type="text" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{$cargo["nombre_cargo"]}}" required autocomplete="nombre_cargo" autofocus>
                                        <input type="hidden" name="id" value="{{$cargo['id']}}">

                                        @error('nombre_cargo')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="horas_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Horas del Cargo') }}</label>

                                    <div class="col-md-6">
                                        <input id="horas_cargo" type="number" placeholder="maximo 12 horas" class="form-control @error('horas_cargo') is-invalid @enderror" name="horas_cargo" value="{{$cargo["horas_cargo"]}}" required autocomplete="horas_cargo" autofocus>

                                        @error('horas_cargo')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                @foreach($rentradac as $entrada)
                                    @if($entrada['id_cargo'] == $cargo['id'])
                                        <div class="row mb-3">
                                            <label for="horas_entrada" class="col-md-4 col-form-label text-md-end">{{ __('Entrada') }}</label>

                                            <div class="col-md-6">
                                                <input type="hidden" name="id_entrada" value="{{$entrada['id']}}">
                                                <input id="horas_entrada" type="number" placeholder="..." class="form-control @error('horas_entrada') is-invalid @enderror" name="horas_entrada" value="{{$entrada['horas']}}" required autocomplete="horas_entrada" autofocus>

                                                @error('horas_entrada')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                @foreach($rsalidac as $salida)
                                    @if($salida['id_cargo'] == $cargo['id'])
                                        <div class="row mb-3">
                                            <label for="horas_salida" class="col-md-4 col-form-label text-md-end">{{ __('Salida') }}</label>

                                            <div class="col-md-6">
                                                <input type="hidden" name="id_salida" value="{{$salida['id']}}">
                                                <input id="horas_salida" type="number" placeholder="..." class="form-control @error('horas_salida') is-invalid @enderror" name="horas_salida" value="{{$salida["horas"]}}" required autocomplete="horas_salida" autofocus>

                                                @error('horas_salida')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="FormPlC{{$cargo["id"]}}">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
                <div class="cont-body-prin">
                    <div class="card-header card-header-mod">
                        {{ __('REGISTRO') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('entrada-crear') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{Auth::user()->id}}">


                        </form>
                    </div>
                </div>
                <div class="cont-body-prin mr-20px ">
                    <div class="card-header card-header-mod title-date">
                        SELECCIONE UN RANGO DE FECHAS
                    </div>

                    <form action="{{ route('registro-date') }}" method="POST">
                        @csrf
                        <input type='hidden' name='id' value='{{Auth::user()->id}}'>

                        <div class="form-group cont-date-input">
                            <label for="date" class="col-form-label col-ms-2">Inicio</label>
                            <div class="col-sm-3 col-sm-3-off">
                                <input type="date" class="form-contrl input-sm input-date-r" id="fromDate" name="fromDate" required>
                            </div>
                            <label for="date" class="col-form-label col-ms-2">Fin</label>
                            <div class="col-sm-3 col-sm-3-off">
                                <input type="date" class="form-contrl input-sm input-date-r" id="toDate" name="toDate" required>
                            </div>
                            <div class="col-sm-2 col-sm-3-off">
                                <button type="submit" name="search" class="btn input-date-button" title="Search"><span class="icon-nav btn btn-primary"><ion-icon name="search-outline"></ion-icon></span></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="cont-body-prin mr-20px">
                    <div class="cont-body-box-table">
                        <table class="table table-striped">
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
    @endif
</div>
@endsection
