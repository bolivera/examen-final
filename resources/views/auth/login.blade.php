@extends('admin.app')

@section('content')
    <div class="main-container fullscreen">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-7 card">
                    <div class="text-center card-body">
                        <h1 class="h2">Exámen final - UTP &#x1f44b;</h1>
                        <p class="lead">Debes iniciar sesión para continuar</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if (count($errors) > 0)
                                <div class="alert alert-danger text-left">
                                    <p>Corrige los siguientes errores:</p>
                                    <ul>
                                        @foreach ($errors->all() as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       placeholder="Email Address" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>  </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
{{--                             
                            <div class="text-right">
                                <small><a href="{{route('password.request')}}">Me olvidé mi contraseña</a></small>
                            </div> --}}

                            </div>

                            <button type="submit" class="btn btn-lg btn-block btn-primary">
                                {{ __('Iniciar') }}
                            </button>

                            <div class="alert alert-warning mt-3 text-left">
                                <strong>Datos para iniciar </strong>
                                <hr>
                                <p><strong>correo:</strong> u18303221@utp.edu.pe</p>
                                <p><strong>password:</strong> 123456789</p>
                            </div>

                                                    <!-- <small>¿Aún no tienes una cuenta? <a href="{{ route('register') }}">Crea uno</a>        </small> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
