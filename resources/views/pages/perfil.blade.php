@extends('layouts.app')
@section('header')
    {!! $header !!}
@endsection
@section('content')

    <main>
        <section class="hero">
            <div class="container">
                <nav class="" aria-label="migaja de pan">
                    <ol class="breadcrumb justify-content-center no-border mb-0">
                        <li class="breadcrumb-item"><a class="" href="/"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Hogar</font></font></a></li>
                        <li class="active breadcrumb-item" aria-current="page"><span class=""><font
                                    style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Mi perfil</font></font></span></li>
                    </ol>
                </nav>
                <div class="hero-content pb-5 text-center"><h1 class="mb-5"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Mi perfil</font></font></h1>

                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                @foreach($errors->all() as $error)
                    <div class="col-md-12 col-lg-10">
                        <div class="alert alert-danger" role="alert">{{$error}}</div>
                    </div>
                @endforeach
                <div class="col-lg-8 col-xl-9">
                    @if (Session::get('success'))
                        <div class="col-md-12 col-lg-10">
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        </div>
                    @endif
                    <div class="block mb-5">
                        <div class="block-header"><strong class="text-uppercase"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">cambia tu contraseña</font></font></strong>
                        </div>
                        <div class="block-body">
                            <form class="" method="POST" action="{{route('panel.cambiarPassword')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group"><label for="password_1" class="form-label"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Nueva contraseña</font></font></label><input
                                                id="password_1" name="password" type="password" class="form-control"
                                                required></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group"><label for="password_2" class="form-label"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Confirme nueva
                                                        contraseña</font></font></label>
                                            <input id="password_2" type="password"
                                                   name="password_confirmation" class="form-control" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn-dark"><i class="far fa-save mr-2"></i><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cambiar
                                                la contraseña</font></font></button>
                                </div>


                            </form>
                        </div>
                    </div>
                    <div class="block mb-5">
                        <div class="block-header"><strong class="text-uppercase"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Detalles personales</font></font></strong>
                        </div>
                        <div class="block-body">
                            <form class="" method="POST" action="{{route('panel.actualizarDatos')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="firstname" class="form-label"> Nombres y Apellidos</label>
                                            <input type="text" value="{{$usuario->name}}"
                                                   name="name" id="firstname"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="company" class="form-label">Dirección</label>
                                            <input type="text" value="{{$usuario->direccion}}" name="direccion" id="calle" class="form-control"
                                                   required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group"><label for="state"
                                                                       class="form-label">DEPARTAMENTO</label>
                                            <select class="form-control" name="departamento" id="departamento" required>
                                                <option value="0">[Seleccionar]</option>
                                                @if(!empty($departamentos))
                                                    @foreach($departamentos as $dep)
                                                        <option
                                                            value="{{ $dep->coddep }}" {{ (isset($ubigeo) && ($dep->coddep == $ubigeo[0]->coddep)) ? 'selected' : ''}}>{{ $dep->nmbubigeo }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group"><label for="country"
                                                                       class="form-label">PROVINCIA</label>
                                            <select id="provincia" name="provincia" class="form-control" required>
                                                @if(isset($ubigeo))
                                                    @foreach(\DB::table('ubigeo')->where(['flag' => 'P','coddep' => $ubigeo[0]->coddep])->get() as $dep)
                                                        <option value="{{ $dep->codprov }}"
                                                                {{ ($dep->codprov == $ubigeo[1]->codprov) ? 'selected' : ''}} data-depa="{{ $dep->coddep }}">{{ $dep->nmbubigeo }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group"><label for="phone" class="form-label">DISTRITO</label>
                                            <select id="distrito" name="distrito" class="form-control" required>
                                                @if(isset($ubigeo))
                                                    @foreach(\DB::table('ubigeo')->where(['flag' => 'T','coddep' => $ubigeo[0]->coddep, 'codprov' => $ubigeo[1]->codprov])->get() as $dep)
                                                        <option value="{{ $dep->coddist }}"
                                                                {{ ($dep->coddist == $ubigeo[2]->coddist) ? 'selected' : ''}} data-ubigeo="{{ $dep->codubigeo }}">{{ $dep->nmbubigeo }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group"><label for="phone" class="form-label">Teléfono</label>
                                            <input type="text" value="{{$usuario->telefono}}" name="telefono" id="phone" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="text" id="email" required name="email"
                                                   value="{{$usuario->email}}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-outline-dark" type="submit"><i
                                            class="far fa-save mr-2"></i><font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit;">Guardar cambios</font></font></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-5 col-lg-4 col-xl-3">
                    @include('pages.customer')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('footer')
    {!! $footer !!}
@endsection
