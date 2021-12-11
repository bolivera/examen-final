@extends('layouts.app')
@section('header')
    {!! $header !!}
@endsection
@section('content')
    <main>
        <section class="hero">
            <div class="container">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center no-border mb-0">
                        <li class="breadcrumb-item"><a class="" href="/">Inicio</a></li>
                        <li class="active breadcrumb-item" aria-current="page"><span class="">Zona de clientes</span>
                        </li>
                    </ol>
                </nav>
                <div class="hero-content pb-5 text-center"><h1 class="mb-5">Zona de clientes</h1></div>
            </div>
        </section>
        <div class="container lm ">
            <div class="justify-content-center row">
                @if (Session::get('mensaje_error'))
                    <div class="col-md-12 col-lg-10">
                        <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
                    </div>
                @endif

                <div class="col-lg-5">
                    <div class="block">
                        <div class="block-header"><h6 class="text-uppercase mb-0">Iniciar sesión</h6></div>
                        <div class="block-body">
                            <p class="lead">¿Ya es nuestro cliente? </p>
                            <p class="text-muted">También puedes inciar sesión con tus redes sociales.</p>
                            <hr>
                            <form class="" method="POST" action="{{route('loginPost')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="email_1" class="form-label">Email</label>
                                    <input id="email_1" name="email" type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_1" class="form-label">Contraseña</label>
                                    <input id="password" name="password" type="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-dark">
                                        <i class="fa fa-sign-in-alt mr-2"></i> Iniciar sesión
                                    </button>
                                </div>
                            </form>
                            <div class="login-separator">
                                <span class="line"></span>
                                <span class="or-text">o</span>
                            </div>
                            <a rel="fb-login" href="{{ route('social.auth', 'facebook') }}"
                               class="login__button  facebook mt-3">Iniciar sesión con
                                &nbsp;<b>
                                    Facebook</b></a>
                            <button rel="g-login" class="login__button google">Iniciar sesión con &nbsp;<b>Google</b>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="block">
                        <div class="block-header"><h6 class="text-uppercase mb-0">Crear cuenta</h6></div>
                        <div class="block-body"><p class="lead">¿Aún no es nuestro cliente registrado?</p>
                            <p class="text-muted">¡Con el registro con nosotros se abre un nuevo mundo de la moda,
                                fantásticos descuentos y mucho más! ¡Todo el proceso no te llevará más de un minuto!

                            </p>

                            <hr>
                            <form class="">
                                <div class="form-group"><label for="name" class="form-label">Nombres y Apellidos</label><input
                                        id="name" type="text" class="form-control"></div>
                                <div class="form-group"><label for="email" class="form-label">Correo</label><input
                                        id="email" type="text" class="form-control"></div>
                                <div class="form-group"><label for="password"
                                                               class="form-label">Contreseña</label><input
                                        id="password" type="password" class="form-control"></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-dark"><i class="far fa-user mr-2"></i>Crear
                                        cuenta
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('footer')
    {!! $footer !!}
@endsection
