@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->cargo == 'Administrador')
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
    @else

    @endif
</div>
@endsection
