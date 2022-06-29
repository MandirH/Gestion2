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
                            <img src="/img/entrada.png" alt="Register" class="login-img">
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
    <div class="contenedor-EnSaJusti">
    <div class="contenedor-home justify-content-center">
            <div class="box-home box-home-left">
                <div class="cont-form-cargo">
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
                            {{ __('ENTRADAS') }}
                            <img src="/img/entrada.png" alt="Register" class="login-img">
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('entrada-crear') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{Auth::user()->id}}">

                                <?php $cont = 0 ?>
                                @foreach($rentrada as $entrada)
                                    @if($entrada['id_user'] == Auth::user()->id)
                                        <?php $hoy = date("Y-m-d");?>
                                        @if(date("Y-m-d", strtotime($entrada['created_at'])) == $hoy)
                                            <?php $cont++ ?>
                                            <button type="submit" class="btn btn-primary w-100 display-flex" disabled>
                                                <span class="icon-nav"><ion-icon name="time"></ion-icon></span>{{ __('Asistencia Marcada') }}
                                            </button>
                                        @endif
                                    @endif
                                @endforeach
                                @if($cont == 0)
                                    <button type="submit" class="btn btn-primary w-100 display-flex">
                                        <span class="icon-nav"><ion-icon name="time"></ion-icon></span>{{ __('Marcar Asistencia') }}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-home box-home-right">
                <div class="cont-form-cargo">
                    @if(session('status'))
                        @if(session('status')=='Salida Creada!')
                            <div class="alert alert-esp alert-primary alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">REGISTRADO!</strong> Salida registrada.
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
                            <form method="POST" action="{{ route('salida-crear') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{Auth::user()->id}}">

                                <?php $cont = 0 ?>
                                @foreach($rsalida as $salida)
                                    @if($salida['id_user'] == Auth::user()->id)
                                        <?php $hoy = date("Y-m-d");?>
                                        @if(date("Y-m-d", strtotime($salida['created_at'])) == $hoy)
                                            <?php $cont++ ?>
                                            <button type="submit" class="btn btn-primary w-100 display-flex" disabled>
                                                <span class="icon-nav"><ion-icon name="time"></ion-icon></span>{{ __('Salida Marcada') }}
                                            </button>
                                        @endif
                                    @endif
                                @endforeach
                                @if($cont == 0)
                                    <button type="submit" class="btn btn-primary w-100 display-flex">
                                        <span class="icon-nav"><ion-icon name="time"></ion-icon></span>{{ __('Marcar Salida') }}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenedor-home justify-content-center">
            <div class="box-home box-home-left">
                <div class="cont-form-cargo">
                    @if(session('status'))
                        @if(session('status')=='Justificación Creada!')
                            <div class="alert alert-esp alert-primary alert-dismissible fade show mr-auto-j" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">REGISTRADA!</strong> justificación registrada.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Justificación Actualizada!')
                            <div class="alert alert-esp alert-success alert-dismissible fade show mr-auto-j" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZADA!</strong> justificación actualizada.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Justificación Eliminada!')
                            <div class="alert alert-esp alert-danger alert-dismissible fade show mr-auto-j" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ELIMINADO!</strong> justificación eliminada.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    @endif
                    <div class="cont-body-prin mr-20px">
                        <div class="card-header card-header-mod pd-20px">
                            JUSTIFICACIONES
                            <img src="/img/justificacion.png" alt="Register" class="login-img">
                        </div>

                        <div class="card-body bg-white">
                            <div class="d-flex justify-content-md-around">
                                <button type="button" class="btn btn-primary display-flex w-50 mr-buton-left" data-toggle="modal" data-target="#JustificarInasistencia">
                                    <span class="icon-nav"><ion-icon name="reader"></ion-icon></span>Inacistencia
                                </button>

                                <button type="button" class="btn btn-primary display-flex w-50 mr-buton-right" data-toggle="modal" data-target="#JustificarTardanza">
                                    <span class="icon-nav"><ion-icon name="reader"></ion-icon></span>Tardanza
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-home box-home-right">
                <div class="cont-form-cargo">
                    <div class="cont-body-prin mr-20px cont-body-prin-j">
                        @foreach($rjust as $justificacion)
                            @if($justificacion['id_user'] == Auth::user()->id)
                                <div class="cont-box-j">
                                    <div class="title-j">
                                        <span class="icon-nav"><ion-icon name="mail"></ion-icon></span>{{$justificacion['tipo']}}
                                        <div class="badge-j">
                                            {{date('Y-m-d', strtotime($justificacion['created_at']))}}
                                        </div>
                                    </div>
                                    <div class="cont-j">
                                    <?php $validacion = 0; ?>
                                        @foreach($rresp as $respuesta)
                                            @if($respuesta['id_justificacion']==$justificacion['id'])
                                                <?php $validacion = 1; ?>
                                            @endif
                                        @endforeach
                                            @if($validacion==0)
                                                <button type="button" class="btn btn-primary display-flex" data-toggle="modal" data-target="#Justificar{{$justificacion['id']}}">
                                                    <span class="icon-nav-button"><ion-icon name="pencil"></ion-icon></span>
                                                </button>
                                                <button type="button" class="btn btn-danger mr-10px-left display-flex" data-toggle="modal" data-target="#JustificarE{{$justificacion['id']}}">
                                                    <span class="icon-nav-button"><ion-icon name="trash"></ion-icon></span>
                                                </button>
                                            @endif
                                        @foreach($rresp as $respuesta)
                                            @if($validacion==1)
                                                @if($respuesta['id_justificacion']==$justificacion['id'])
                                                    @if($respuesta['aceptacion']=='aceptado')
                                                    <button type="button" class="btn btn-success display-flex" data-toggle="modal" data-target="#JustificarR{{$justificacion['id']}}" disabled>
                                                        <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span>ACEPTADO!
                                                    </button>
                                                    @else
                                                    <button type="button" class="btn btn-danger display-flex" data-toggle="modal" data-target="#JustificarR{{$justificacion['id']}}" disabled>
                                                        <span class="icon-nav"><ion-icon name="close-circle"></ion-icon></span>DENEGADO!
                                                    </button>
                                                    @endif                                                         
                                                @endif                                                                    
                                            @endif
                                        @endforeach
                                        
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body">
            <div class="modal fade" id="JustificarInasistencia" tabindex="-1" role="dialog" aria-labelledby="JustificarInasistenciaTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Inasistencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <div class="card-body ">
                                <form method="POST" action="{{ route('justificacion-crear') }}" enctype="multipart/form-data" id="form-just-in">
                                    @csrf

                                    <div class="input-mg-boton">
                                        <label for="titulo">Titulo</label>
                                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" required autocomplete="titulo" autofocus>
                                        <input type='hidden' name='id' value='{{Auth::user()->id}}'>
                                        <input type='hidden' name='tipo' value='Inasistencia'>
                                        @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-mg-boton">
                                        <label for="mensaje">Motivo :</label>
                                        <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="4" required autocomplete="mensaje" autofocus></textarea>

                                        @error('mensaje')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <label for="adjunto">Adjuntar Comprobante :</label>
                                    <input type="file" class="form-control-file @error('adjunto') is-invalid @enderror" name="adjunto"  id="adjunto" autocomplete="adjunto" autofocus>
                                    @error('adjunto')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" form="form-just-in" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="modal fade" id="JustificarTardanza" tabindex="-1" role="dialog" aria-labelledby="JustificarTardanzaTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tardanza</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <div class="card-body ">
                                <form method="POST" action="{{ route('justificacion-crear') }}" enctype="multipart/form-data" id="form-just-ta">
                                    @csrf

                                    <div class="input-mg-boton">
                                        <label for="titulo">Titulo</label>
                                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" required autocomplete="titulo" autofocus>
                                        <input type='hidden' name='id' value='{{Auth::user()->id}}'>
                                        <input type='hidden' name='tipo' value='Tardanza'>
                                        @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-mg-boton">
                                        <label for="mensaje">Motivo :</label>
                                        <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="4" required autocomplete="mensaje" autofocus></textarea>

                                        @error('mensaje')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <label for="adjunto">Adjuntar Comprobante :</label>
                                    <input type="file" class="form-control-file @error('adjunto') is-invalid @enderror" name="adjunto"  id="adjunto" autocomplete="adjunto" autofocus>
                                    @error('adjunto')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" form="form-just-ta" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL JUSTIFICACION EDITAR -->

        @foreach($rjust as $justificacion)
            @if($justificacion['id_user'] == Auth::user()->id)
                <div class="modal fade" id="Justificar{{$justificacion['id']}}" tabindex="-1" role="dialog" aria-labelledby="JustificarTardanzaTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$justificacion['tipo']}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <div class="card-body ">
                                    <div class="img-modal-j">
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
                                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" value="{{$justificacion['titulo']}}" id="titulo{{$justificacion['id']}}" name="titulo" required autocomplete="titulo" autofocus>
                                            <input type='hidden' name='id' value='{{Auth::user()->id}}'>
                                            <input type='hidden' name='id_justificacion' value='{{$justificacion['id']}}'>
                                            <input type='hidden' name='tipo' value='{{$justificacion['tipo']}}'>
                                            @error('titulo')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="input-mg-boton">
                                            <label for="mensaje">Motivo :</label>
                                            <input type="text" class="form-control @error('mensaje') is-invalid @enderror" id="mensaje{{$justificacion['id']}}" value="{{$justificacion['mensaje']}}" name="mensaje" rows="4" required autocomplete="mensaje" autofocus>

                                            @error('mensaje')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <label for="adjunto">Adjuntar Comprobante :</label>
                                        <input type="file" class="form-control-file @error('adjunto') is-invalid @enderror" name="adjunto"  id="adjunto" autocomplete="adjunto" autofocus>
                                        @error('adjunto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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

    <!-- MODAL JUSTIFICACION ELIMINAR -->

        @foreach($rjust as $justificacion)
            @if($justificacion['id_user'] == Auth::user()->id)
                <div class="modal fade" id="JustificarE{{$justificacion['id']}}" tabindex="-1" role="dialog" aria-labelledby="JustificarTardanzaTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Borrar justificación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <div class="card-body ">
                                    <div class="title-modal-j">¿Esta seguro?</div>
                                    <div class="img-modal-j">
                                        <img src="/img/03.jpg" alt="justificacion-eliminar">
                                    </div>
                                    <form method="POST" action="{{ route('justificacion-eliminar') }}" enctype="multipart/form-data" id="form-just-ta-E{{$justificacion['id']}}">
                                        @csrf

                                        <input type='hidden' name='id_justificacion' value='{{$justificacion['id']}}'>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" form="form-just-ta-E{{$justificacion['id']}}" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
        <!-- Usuario -->
    @endif
</div>
@endsection
