@extends('admin.app')
@section('content')
<div class="layout layout-nav-side">
    {!! $header !!}
    <div class="main-container">
        <div class="breadcrumb-bar navbar bg-white sticky-top">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Aplicaciones</li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-9">
                    <section class="py-4 py-lg-5">
                        <div class="mb-3 d-flex">
                            <div>
                                <span class="badge badge-success">Version 1.0</span>
                            </div>
                        </div>
                        <h1 class="display-4 mb-3">Examen UTP</h1>
                        <p class="lead">
                            Lista de aplicaciones DOMIMAN.
                        </p>
                    </section>
                    <section>
                        <div class="row">

{{--                            <div class="col-md-4">--}}
{{--                                <div class="card mb-3">--}}
{{--                                    <a href="{{ route('neworden')}}" class="card-img-top card-header text-center">--}}
{{--                                        <i class="material-icons display-3">touch_app</i>--}}
{{--                                    </a>--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a class="card-title h6 text-center" href="{{ route('neworden')}}">ORDENES DE SERVICIO</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="col-md-4">--}}
{{--                                <div class="card mb-3">--}}
{{--                                    <a href="{{ route('allclientes')}}"class="card-img-top card-header text-center">--}}
{{--                                    <i class="material-icons display-3">touch_app</i>--}}
{{--                                    </a>--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a class="card-title h6 text-center" href="{{ route('allclientes')}}">CLIENTES</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-4">--}}
{{--                                <div class="card mb-3">--}}
{{--                                    <a href="nav-side-team.html" class="card-img-top card-header text-center">--}}
{{--                                    <i class="material-icons display-3">touch_app</i>--}}
{{--                                    </a>--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a class="card-title h6" href="nav-side-team.html">REPORTES</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection
