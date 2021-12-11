@extends('layouts.app')
@section('header')
    {!! $header !!}
@endsection
@section('content')

    <section class="mh-full-screen">
        <!-- Circle Slider-->
        <div class="owl-carousel owl-theme circle-slider">
            @foreach($colecciones as $key => $coleccion)
                <div class="item d-flex align-items-end bg-gray-100 light-overlay light-overlay-md-0"
                     style="padding-top: 80px;">
                    <div class="container circle-slider-bg"
                         style="background: {{($key == 1  || $key  == 4) ? 'left' : 'right'}} bottom url({{$coleccion->urlCompleta}}) no-repeat; ">
                        <div class="w-100">
                            <div class="row py-5">
                                <div
                                    class="col-lg-6 py-md-5 py-lg-7 overlay-content {{($key == 1  || $key  == 4) ? 'ml-lg-auto text-md-right' : ''}}">
                                    <h5 class="text-uppercase text-danger mb-3 letter-spacing-5"> COLECCIÓN</h5>
                                    <h2 class="mb-3">{{$coleccion->titulo}}</h2>
                                    <p class="lead mb-4">{{$coleccion->descripcion}} </p>
                                   
                                    <p><a class="btn btn-outline-dark" onclick="addCriteria(event)" data-coleccion="{!! $coleccion->id !!}" data-name="coleccion">Ver colección</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!-- /Circle Slider-->
    </section>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            @foreach($colecciones as $key => $coleccion)
                @if($key == 0)
                    <div class="carousel-item active" style="background-image: url('{{$coleccion->urlCompleta}}')">
                        @else
                            <div class="carousel-item " style="background-image: url('{{$coleccion->urlCompleta}}')">
                                @endif
                                <div class="carousel-caption d-none d-md-block">
                                    <div data-swiper-parallax="-500"
                                         class="overlay-content h-100 align-items-center justify-content-center text-center text-white row">
                                        <div class="col-lg-6 mb-5">
                                            <h2 class="mb-5 display-2 font-weight-bold text-serif"
                                                style="line-height:1">{{$coleccion->titulo}}</h2>
                                            <p class="lead  mb-5">{{$coleccion->descripcion}} {{$key}}</p>

                                            
                                            <a class="btn btn-outline-dark" onclick="addCriteria(event)" data-coleccion="{!! $coleccion->id !!}" data-name="coleccion">Ver colección</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                               data-slide="prev">
                                <span class="swiper-button-prev swiper-button-white" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                               data-slide="next">
                                <span class="swiper-button-next swiper-button-white" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                    </div>
                    <section class=" pb-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-8 mx-auto text-center mb-5">
                                    <h2 class="text-uppercase">Lo más reciente</h2>
                                    <p class="lead text-muted">Inspirados en tu comodidad y gustos por el cuero de calidad con lo último en tendencia al mejor precio..</p>
                                </div>
                            </div>
                            <div class="row">
                            @foreach($productos as $key => $producto)
                                <!-- product-->
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product-image">
                                            {!! CodebelHelpers::getEtiquetas($producto); !!}
                                            <img class="img-fluid" src="{{$producto->urlCompleta}}" alt="product">
                                            <div class="product-hover-overlay">
                                                <a class="product-hover-overlay-link" href="{{route('front.productoDetalle',[$producto->id, $producto->slug])}}"></a>
                                                <div class="product-hover-overlay-buttons"><a class="btn btn-dark btn-buy" href="{{route('front.productoDetalle',[$producto->id, $producto->slug])}}">
                                                    <i class="fa-search fa"></i><span class="btn-buy-label ml-2">Ver</span></a>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="py-2">
                                            <p class="text-muted text-sm mb-1">{{$producto->categoria->nombre}}</p>
                                            <h3 class="h6 text-uppercase mb-1"><a class="text-dark" href="{{route('front.productoDetalle',[$producto->id, $producto->slug])}}">{{$producto->titulo}}</a></h3><span class="text-muted">S/ {{ number_format($producto->precio,2)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /product-->        
                            @endforeach
                            </div>
                        </div>
                    </section>

@endsection
@section('footer')
    {!! $footer !!}
@endsection
