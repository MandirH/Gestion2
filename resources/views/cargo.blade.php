@extends('layouts.app')

@section('content')
<div class="container">
    <div class="contenedor-home justify-content-center">
        <div class="box-home box-home-left">
            <div class="cont-form-cargo">
                @if(session('status'))
                    @if(session('status')=='Cargo Creado!')
                        <div class="alert alert-esp alert-primary alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">CREADO!</strong> Cargo creado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('status')=='Cargo Actualizado!')
                        <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZDO!</strong> Cargo actualizado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('status')=='Cargo Activado!')
                        <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTIVADO!</strong> Cargo activado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('status')=='Cargo Inactivo!')
                        <div class="alert alert-esp alert-danger alert-dismissible fade show" role="alert">
                            <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">INACTIVO!</strong> Cargo inactivo.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endif
                <div class="cont-body-prin">
                    <div class="card-header card-header-mod">
                        {{ __('CARGOS') }}
                        <img src="/img/02.jpg" alt="Register" class="login-img">
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cargos-crear') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del Cargo') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre_cargo" type="text" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{ old('nombre_cargo') }}" required autocomplete="nombre_cargo" autofocus>

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
                                    <input id="horas_cargo" type="number" placeholder="maximo 12 horas" class="form-control @error('horas_cargo') is-invalid @enderror" name="horas_cargo" value="{{ old('horas_cargo') }}" required autocomplete="horas_cargo" autofocus>

                                    @error('horas_cargo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
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
                <div class="card card-margin">
                    <div class="card-header card-header-mod title-card card-aviso">
                        <span class="icon-nav"><ion-icon name="alert-circle-outline"></ion-icon></span>{{ __('OJO') }}
                    </div>
                    <div class="body-card">
                        {{'El cargo "Administrador" esta creado con la finalidad única y exclusiva de gestionar a los demás usuarios, cualquier usuario que tenga este cargo tendrá acceso a todas las herramientas principales para el uso del administrador.'}}
                    </div>
                </div>
            </div>
        </div>
        <div class="box-home box-home-right">
            <div class="cont-body-prin mr-20px">
                <div class="cont-body-box-table">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" class="cell-align"><span class="icon-nav-table"><ion-icon name="git-merge-outline"></ion-icon></span></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Horas</th>
                            <th scope="col" class="display-off">Fecha</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rcargo as $cargo)
                            <tr>
                                <th scope="row" class="cell-align">{{$cargo['id']}}</th>
                                <td class="cell-align">{{$cargo['nombre_cargo']}}</td>
                                <td class="cell-align">{{$cargo['horas_cargo']}} Horas</td>
                                <td class="cell-align display-off">{{$cargo['created_at']}}</td>
                                <td class="cell-align">
                                    <button type="submit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#ModalPlanta{{$cargo['id']}}">
                                        <span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>{{ __('Editar') }}
                                    </button>
                                </td>
                                <td class="cell-align">
                                    @if($cargo["estado"] == 'Activo')
                                        <div class="form-check form-switch">
                                            <form method='post' action='{{ route('cargo-desactivar') }}' id="formActivate{{$cargo['id']}}">
                                                @csrf
                                                <input type='hidden' name='id' value='{{$cargo['id']}}'>
                                                <input class="form-check-input" type="checkbox" value="{{$cargo['id']}}" id="{{$cargo['id']}}" onchange="document.getElementById('formActivate{{$cargo['id']}}').submit()" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                                            </form>
                                        </div>
                                    @else
                                        <div class="form-check form-switch">
                                            <form method='post' action='{{ route('cargo-activar') }}' id="formActivate{{$cargo['id']}}">
                                                @csrf
                                                <input type='hidden' name='id' value='{{$cargo['id']}}'>
                                                <input class="form-check-input" type="checkbox" value="" id="{{$cargo['id']}}" onchange="document.getElementById('formActivate{{$cargo['id']}}').submit()">
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

        <!-- Modal -->
        @foreach($rcargo as $cargo)
            <div class="modal fade" id="ModalPlanta{{$cargo['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <form method="POST" action="{{ route('cargo-editar') }}" enctype="multipart/form-data" id="FormPl{{$cargo["id"]}}">
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="FormPl{{$cargo["id"]}}">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
