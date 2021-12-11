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
                        <li class="active breadcrumb-item" aria-current="page"><span class="">Carrito de compras</span>
                        </li>
                    </ol>
                </nav>
                <div class="hero-content pb-5 text-center">

                    <h1 class="hero-heading">ORDEN RECHAZADA</h1>

                </div>
            </div>
        </section>
        <div class="container">
            <div class="mb-5 row">
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    
                    <div class="row justify-content-center">
                        <div class="col-6 text-center">
                        
                            <!-- <i class="icofont-check-circled icofont-5x"></i><br> -->
            

                            <div class="icon-rounded mb-3 mx-auto text-white" style="background-color: #FF0000 !important;">
                             <i class="icofont-close-line icofont-4x"></i><br>
                            </div>
                            <h4 class="text-center mt-3 ff-base">¡Lo sentimos mucho!</h4>
                            <p class="text-muted mb-5">Ocurrio un error en la compra. Por favor intente más tarde.</p>
                            
                            <a href="{{route('home')}}" class="btn btn-outline-dark">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Página Inicio</font>
                                    </font>
                                    <i class="fa fa-angle-right ml-2"></i>
                            </a>
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


