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
                <div class="hero-content pb-5 text-center"><h1 class="mb-5">Carrito de compras</h1>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="mb-5 row">
                <div class="col-lg-8">
                    <ul class="custom-nav nav nav-pills mb-5">
                        <li class="nav-item w-25">
                            <a class="nav-link text-sm active">
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
                        <a class="nav-link text-sm">
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
                    <div class="cart">
                        <div class="cart-header text-center">
                            <div class="row">
                                <div class="col-md-5">Producto</div>
                                <div class="d-none d-md-block col">
                                    <div class="row">
                                        <div class="col-md-3">Precio</div>
                                        <div class="col-md-4">Cantidad</div>
                                        <div class="col-md-3">Total</div>
                                        <div class="col-md-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-body">
                          <div class="d-flex justify-content-center spinner hiden" style="display:none !important">
                            <div class="spinner-border mt-3" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </div>
                            @if(!empty(Cart::getContent()->count() > 0))
                                @foreach(Cart::getContent() as $car)
                                    <div class="cart-item">
                                        <div class=" d-flex align-items-center text-left text-md-center row">
                                            <div class="col-12 col-md-5">
                                                <a class="cart-remove close mt-3 d-md-none" href="#">
                                                    <i class="fa fa-times"> </i>
                                                </a>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('front.productoDetalle',[$car->id, $car->attributes->url])}}">
                                                        <img class="cart-item-img"
                                                             src="{{$car->attributes->fotos['urlCompleta']}}" alt="...">
                                                    </a>
                                                    <div class="cart-title text-left">
                                                        <a class="text-uppercase text-dark"
                                                           href="{{route('front.productoDetalle',[$car->id, $car->attributes->url])}}"><strong>{{$car->name}}</strong></a>
                                                        <div class="text-muted text-sm">Talla: {{$car->attributes->talla}}</div>
                                                        <div class="text-muted text-sm">Color: {{$car->attributes->color}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mt-md-0 col-12 col-md-7">
                                                <div class="align-items-center row">
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="d-md-none text-muted col-6">Precio por producto</div>
                                                            <div class="text-right text-md-center col-6 col-md-12">
                                                               S/. {{ number_format($car->price, 2) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="align-items-center row">
                                                            <div class="d-md-none text-muted col-7 col-sm-9">Cantidad </div>
                                                            <div class="col-5 col-sm-3 col-md-12">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="btn btn-items btn-items-decrease updateCantidad" data-id="{{$car->id}}" data-status="restart"><i class="icofont-minus"></i>
                                                                    </div>
                                                                    <input
                                                                        class="form-control text-center border-0 border-md input-items"
                                                                        type="text" value="{{$car->quantity}}">
                                                                    <div class="btn btn-items btn-items-increase updateCantidad" data-id="{{$car->id}}" data-status="sumar"><i class="icofont-plus"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="d-md-none text-muted col-6">Total price</div>
                                                            <div class="text-right text-md-center col-6 col-md-12">
                                                              S/. {{  number_format(Cart::get($car->id)->getPriceSum(),2) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-none d-md-block text-center col-2">
                                                        <a class="cart-remove quitarProducto" data-id="{{$car->id}}"  href="javascript:void(0)">
                                                            <i  class="delete icofont-close"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class=" d-flex align-items-center text-left text-md-center row">
                                    <h4 class="mt-3">No se agregaron productos</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">
                        <a class="btn btn-link text-muted" href="{{route('front.productos')}}"><i class="icofont-simple-left"></i> Seguir comprando</a>
                        <a class="btn btn-dark {{(Cart::getContent()->count() == 0) ? 'disabled' : ''}}" href="{{route('cart.pagar')}}" >Continuar <i class="icofont-simple-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block mb-5">
                        <div class="block-header"><h6 class="text-uppercase mb-0">Resumen de tu orden</h6></div>
                        <div class="block-body bg-light pt-1"><p class="text-sm">Los costos de envío y adicionales se calculan en función de los productos que agregó</p>
                            <ul class="order-summary mb-0 list-unstyled">
                                <li class="order-summary-item"><span>Subtotal </span><span>S/. {{ number_format(Cart::getSubtotal(), 2) }}</span></li>
                                <li class="order-summary-item border-0"><span>Total a pagar</span><strong class="order-summary-total">S/. {{number_format(Cart::getTotal(),2)}}</strong></li>
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
    <script type="text/javascript">

    </script>
@endsection
