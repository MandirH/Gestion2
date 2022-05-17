@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categoria') }}</div>

                <div class="card-body">
                    <form method="POST" action="/cargo">
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
        </div>
    </div>
</div>
                        
@endsection
