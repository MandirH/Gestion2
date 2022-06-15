@extends('layouts.app')

@section('content')
<div class="container"><h1 id="temperature" class="display-none"></h1>
    <div class="row justify-content-center">
        <div class="cont-head-prin">
            <div class="cont-head-box">
                <span class="icon-nav"><ion-icon name="person"></ion-icon></span>Perfil
            </div>
        </div>

        @if(session('status'))
            @if(session('status')=='Usuario Actualizado!')
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZADO!</strong> Usuario Actualizado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('status')=='Contraseña Actualizada!')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="icon-nav"><ion-icon name="checkmark-circle"></ion-icon></span><strong class="icon-nav">ACTUALIZADO!</strong> Contraseña Actualizada.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        @endif

        <div class="cont-body-prin">
            <div class="card-body">
                <form method="POST" action="{{ route('perfil-actualizar') }}" enctype="multipart/form-data">
                    @csrf

                    <input type='hidden' name='id' value='{{Auth::user()->id}}'>

                    <div class="row mb-3">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{Auth::user()->nombre}}" required autocomplete="nombre" autofocus>

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
                            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{Auth::user()->apellido}}" required autocomplete="apellido" autofocus>

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
                            <input id="dni" type="number" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{Auth::user()->dni}}" required autocomplete="dni" autofocus>

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
                            <input id="celular" type="number" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{Auth::user()->celular}}" required autocomplete="celular" autofocus>

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
                            <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{Auth::user()->direccion}}" required autocomplete="direccion" autofocus>

                            @error('direccion')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    @if(Auth::user()->cargo == 'Administrador')
                        <div class="row mb-3">
                            <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                            <div class="col-md-6">
                                <select id="nombre_cargo" aria-label="Default select example" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{ old('nombre_cargo') }}" required autocomplete="producto_categoria" autofocus>
                                    @foreach ($rcargo as $cargo)
                                        @if(Auth::user()->cargo == $cargo['nombre_cargo'])
                                            <option value={{$cargo->nombre_cargo}} selected>{{$cargo->nombre_cargo}}</option>
                                        @else
                                            <option value={{$cargo->nombre_cargo}}>{{$cargo->nombre_cargo}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="row mb-3">
                            <label for="nombre_cargo" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                            <div class="col-md-6">
                                <select id="nombre_cargo" aria-label="Default select example" class="form-control @error('nombre_cargo') is-invalid @enderror" name="nombre_cargo" value="{{ old('nombre_cargo') }}" required autocomplete="producto_categoria" disabled>
                                    @foreach ($rcargo as $cargo)
                                        @if(Auth::user()->cargo == $cargo['nombre_cargo'])
                                            <option value={{$cargo->nombre_cargo}} selected>{{$cargo->nombre_cargo}}</option>
                                        @else
                                            <option value={{$cargo->nombre_cargo}}>{{$cargo->nombre_cargo}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif


                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" required autocomplete="email" disabled>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </div>
                </form>

                <div class="form-mid">Actualizar Contraseña</div>

                <form method="POST" action="{{ route('perfil-actualizar-contraseña') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                        <div class="col-md-6">
                            <input type='text' name='id' value='{{Auth::user()->id}}' autocomplete="username email" style="display: none;">
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
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="cont-sub-prin-img-pag">
            <div class="sub-background-img image-rotate">
                <div class="sub-background-img image-rotate-second">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
