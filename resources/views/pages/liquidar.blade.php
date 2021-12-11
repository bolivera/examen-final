@extends('layouts.app')
@section('header')
    {!! $header !!}
    <!-- theme and plugins. should be loaded after the javascript library -->
    <!-- not mandatory but helps to have a nice payment form out of the box -->
    <link rel="stylesheet" 
    href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.css">
    <script 
    src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js">
    </script>
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
                    <h1 class="mb-5">Carrito de compras</h1>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="mb-5 row">
                <div class="col-lg-8">
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
                            <ul class="custom-nav nav nav-pills mb-5">
                            <li class="nav-item w-25">
                                <a class="nav-link text-sm">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Pedido</font>
                                    </font>
                                </a>
                            </li>
                            <li class="nav-item w-25">
                            <a class="nav-link text-sm">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Datos</font>
                                    </font>
                                </a>
                            </li>
                            <li class="nav-item w-25">
                            <a class="nav-link text-sm active">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Pago</font>
                                    </font>
                                </a>
                            </li>
                            <li class="nav-item w-25">
                            <a class="nav-link text-sm">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Fín</font>
                                    </font>
                                </a>
                            </li>
                        </ul>
                        <div class="collapse show" role="tabpanel" aria-labelledby="home-tab">
                            
                            <div class="block-header mb-5">
                                <h6 class="text-uppercase">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Ingrese  datos de su tarjeta, pago 100% seguro</font>
                                    </font>
                                </h6>
                            </div>

                            <div class="row justify-content-center">                                
                                <div class="border border-secondary bg-light">
                             
                                    <img alt="Image" class="border border-1" width="300 px" src="/assets/img/formas-pago.png"/>
                                    <div class="col-5 mt-4">
                                        @if(isset($token))
                                            <!-- payment form -->
                                            <div class="kr-embedded"  kr-form-token="{{$token}}">
                                            <!-- payment form fields -->
                                            <div class="kr-pan"></div>
                                            <div class="kr-expiry"></div>
                                            <div class="kr-security-code"></div>  

                                            <!-- payment form submit button -->
                                            <button class="kr-payment-button"></button>
                                            <!-- error zone -->
                                            <div class="kr-form-error"></div>
                                            

                                            </div>
                                        @else
                                            <h3>Error</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">
                            <a class="btn btn-link text-muted" href="{{route('cart.pagar')}}">
                                    <i class="icofont-simple-left"></i>
                                    Atrás
                            </a>        
                        </div>
                </div>

                <div class="col-lg-4">
                    <div class="block mb-5">
                        <div class="block-header">
                            <h6 class="text-uppercase mb-0">Resumen de tu orden</h6>
                        </div>
                        <div class="block-body bg-light pt-1">
                            <p class="text-sm">Los costos de envío y adicionales se
                                calculan en función de los productos que agregó</p>
                            <ul class="order-summary mb-0 list-unstyled">
                                
                                <li class="order-summary-item" id="unit-price">
                                    <span>Subtotal </span>
                                    <strong>S/.<span id="quantity">{{number_format(Cart::getSubtotal(), 2)}}</span></strong>
                                </li>

                                <li class="order-summary-item" id="envioDeliverys">
                                    <span>Costo de envio</span>
                                    <strong>S/.<span id="envioDelivery">{{$envio}}.00</span></strong>
                                </li> 

                                  <li class="order-summary-item border-0" id="product-description">
                                    <span>Total a pagar</span>
                                    <strong class="order-summary-total">S/.<span id="quantity-total">{{$total}}.00</span></strong>
                                </li>
                                
                            </ul>
                            <div class=" d-flex align-items-center text-left text-md-center row mt-4">
                                <div class="col-12 col-md-4">
                                    <i class="icofont-unlock icofont-2x"></i><br>
                                    <small>Pago Seguro</small>
                                </div>
                                <div class="col-12 col-md-4">
                                    <i class="icofont-refresh icofont-2x"></i><br>
                                    <small>Cambios</small>
                                </div>
                                <div class="col-12 col-md-4">
                                    <i class="icofont-simple-smile icofont-2x"></i><br>
                                    <small>Clientes felices</small>
                                </div>
                            </div>
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

@section('scripts')
    <!-- Javascript library. Should be loaded in head section -->
    <script 
    src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js" 
    kr-public-key="87459722:testpublickey_ZDYRRiTKKaQZfqd8sGc1IRzwAVSX0T6XVnAqsQgvta4jA"
    kr-post-url-success="{{route('finalizar')}}?_token={{csrf_token()}}">
    </script>
@endsection
