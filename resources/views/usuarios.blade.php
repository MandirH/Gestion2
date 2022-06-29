@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="contenedor-home justify-content-center">
            <div class="box-home box-home-left">
                <div class="cont-form-cargo">
                    @if(session('status'))
                        @if(session('status')=='Usuario Creado!')
                            <div class="alert alert-esp alert-primary alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">CREADO!</strong> Usuario creado.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Usuario Actualizado!')
                            <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZDO!</strong> Usuario actualizado.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Usuario Activado!')
                            <div class="alert alert-esp alert-success alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTIVADO!</strong> Usuario activado.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session('status')=='Usuario Inactivo!')
                            <div class="alert alert-esp alert-danger alert-dismissible fade show" role="alert">
                                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">INACTIVO!</strong> Usuario inactivo.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    @endif
                    <div class="cont-body-prin">
                        <div class="card-header card-header-mod">
                            {{ __('Usuarios') }}
                            <img src="/img/01.jpg" alt="Register" class="login-img">
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('usuarios-crear') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                        @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="apellido" class="col-md-4 col-form-label text-md-end">{{ __('Apellido') }}</label>

                                    <div class="col-md-6">
                                        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

                                        @error('apellido')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="dni" class="col-md-4 col-form-label text-md-end">{{ __('DNI') }}</label>

                                    <div class="col-md-6">
                                        <input id="dni" type="number" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni" autofocus>

                                        @error('dni')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="celular" class="col-md-4 col-form-label text-md-end">{{ __('Celular') }}</label>

                                    <div class="col-md-6">
                                        <input id="celular" type="number" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" required autocomplete="celular" autofocus>

                                        @error('celular')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="direccion" class="col-md-4 col-form-label text-md-end">{{ __('Direccion') }}</label>

                                    <div class="col-md-6">
                                        <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" autofocus>

                                        @error('direccion')
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
                                                <option value={{$cargo['id']}}>{{$cargo['nombre_cargo']}}</option>
                                            @endforeach
                                        </select>

                                        @error('producto_categoria')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                                <th scope="col">Apellido</th>
                                <th scope="col" class="display-off">Cargo</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($resUser as $usuario)
                                <tr>
                                    <th scope="row" class="cell-align">{{$usuario['id']}}</th>
                                    <td class="cell-align">{{$usuario['nombre']}}</td>
                                    <td class="cell-align">{{$usuario['apellido']}}</td>
                                    <td class="cell-align display-off">
                                        @foreach($rcargo as $cargo)
                                            @if($cargo['id'] == $usuario['cargo'])
                                                {{$cargo['nombre_cargo']}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="cell-align">
                                        <button type="submit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#ModalPlanta{{$usuario['id']}}">
                                            <span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>{{ __('Editar') }}
                                        </button>
                                    </td>
                                    <td class="cell-align">
                                        @if($usuario["estado"] == 'Activo')
                                            <div class="form-check form-switch">
                                                <form method='post' action='{{ route('usuarios-desactivar') }}' id="formActivate{{$usuario['id']}}">
                                                    @csrf
                                                    <input type='hidden' name='id' value='{{$usuario['id']}}'>
                                                    <input class="form-check-input" type="checkbox" value="{{$usuario['id']}}" id="{{$usuario['id']}}" onchange="document.getElementById('formActivate{{$usuario['id']}}').submit()" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                                                </form>
                                            </div>
                                        @else
                                            <div class="form-check form-switch">
                                                <form method='post' action='{{ route('usuarios-activar') }}' id="formActivate{{$usuario['id']}}">
                                                    @csrf
                                                    <input type='hidden' name='id' value='{{$usuario['id']}}'>
                                                    <input class="form-check-input" type="checkbox" value="" id="{{$usuario['id']}}" onchange="document.getElementById('formActivate{{$usuario['id']}}').submit()">
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
            @foreach($resUser as $usuario)
                <div class="modal fade" id="ModalPlanta{{$usuario['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    <img src="/img/02.gif" alt="gif-house">
                                </div>
                                <form method="POST" action="{{ route('usuarios-editar') }}" enctype="multipart/form-data" id="FormPl{{$usuario["id"]}}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="nombre{{$usuario["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                        <div class="col-md-6">
                                            <input id="nombre{{$usuario["id"]}}" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$usuario["nombre"]}}" required autocomplete="nombre" autofocus>
                                            <input type='hidden' name='id' value='{{$usuario["id"]}}'>

                                            @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="apellido{{$usuario["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Apellido') }}</label>

                                        <div class="col-md-6">
                                            <input id="apellido{{$usuario["id"]}}" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{$usuario["apellido"]}}" required autocomplete="apellido" autofocus>

                                            @error('apellido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="dni{{$usuario["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('DNI') }}</label>

                                        <div class="col-md-6">
                                            <input id="dni{{$usuario["id"]}}" type="number" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{$usuario["dni"]}}" required autocomplete="dni" autofocus>

                                            @error('dni')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="celular{{$usuario["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Celular') }}</label>

                                        <div class="col-md-6">
                                            <input id="celular{{$usuario["id"]}}" type="number" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{$usuario["celular"]}}" required autocomplete="celular" autofocus>

                                            @error('celular')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="direccion{{$usuario["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Direccion') }}</label>

                                        <div class="col-md-6">
                                            <input id="direccion{{$usuario["id"]}}" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{$usuario["direccion"]}}" required autocomplete="direccion" autofocus>

                                            @error('direccion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nombre_cargo{{$usuario["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                                        <div class="col-md-6">
                                            <select id="nombre_cargo{{$usuario["id"]}}" aria-label="Default select example" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" required autofocus>
                                                @foreach($rcargo as $cargo)
                                                    @if($cargo['nombre_cargo'] == $usuario['cargo'])
                                                        <option value={{$cargo['id']}} selected>{{$cargo['nombre_cargo']}}</option>
                                                    @else
                                                        <option value={{$cargo['id']}}>{{$cargo['nombre_cargo']}}</option>
                                                    @endif

                                                @endforeach
                                            </select>

                                            @error('producto_categoria')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="alert-form">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email{{$usuario["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                        <div class="col-md-6">
                                            <input id="email{{$usuario["id"]}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$usuario['email']}}" required autocomplete="email">

                                            @error('email')
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
                                <button type="submit" class="btn btn-primary" form="FormPl{{$usuario["id"]}}">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

