<div class="nav-item dropdown"><a class="navbar-icon-link d-lg-none" href="cart.html">
        <svg class="svg-icon">
            <use xlink:href="/icons/orion-svg-sprite.svg#cart-1"></use>
        </svg>

        <span class="text-sm ml-2 ml-lg-0 text-uppercase text-sm font-weight-bold d-none d-sm-inline d-lg-none">View
            cart</span></a>
    <div class="d-none d-lg-block">
        <a class="navbar-icon-link dropdown-toggle" id="cartdetails" href="cart.html" data-target="#"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg class="svg-icon">
                <use xlink:href="/icons/orion-svg-sprite.svg#cart-1"></use>
            </svg>
            <div class="navbar-icon-link-badge" id="cantidad">{{Cart::getContent()->count()}}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-4 sb-menu-right" aria-labelledby="cartdetails">
            <div class="navbar-cart-product-wrapper" id="listCart">
                @if(count(Cart::getContent()) > 0)
                @foreach(Cart::getContent() as $car)
                <div class="navbar-cart-product" id="list_{{$car->id}}">
                    <div class="d-flex align-items-center">
                        <a href="{{route('cart')}}">
                            <img class="img-fluid navbar-cart-product-image"
                                src="{{$car->attributes->fotos['urlCompleta']}}"></a>
                        <div class="w-100">
                            <a data-id="{{$car->id}}" class="close text-sm mr-2 quitarProducto"
                                href="javascript:void(0)">
                                <i class="icofont-close-line"></i>
                            </a>
                            <div class="pl-3">
                                <a class="navbar-cart-product-link" href="/detail-1">{{ $car->name}}</a>
                                <small class="d-block text-muted">Unidades:
                                    {{$car->quantity}}</small><strong class="d-block text-sm">S/.
                                    {{ number_format($car->price,2)}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <h5>No tienes productos agregados</h5>
                @endif
            </div>
            <!-- total price-->
            <div class="navbar-cart-total">
                <span class="text-uppercase text-muted">Total</span>
                <strong class="text-uppercase" id="totalCart">S/. {{number_format(Cart::getSubTotal(),2)}}</strong>
            </div>
            <!-- buttons-->
            <div class="d-flex justify-content-between">
                <a class="btn btn-link text-dark mr-3 {{(count(Cart::getContent()) > 0) ? '' : 'disabled'}}"
                    href="{{route('cart')}}">Ver carrito <i class="icofont-arrow-right"></i></a>
                <a class="btn btn-outline-dark {{(count(Cart::getContent()) > 0) ? '' : 'disabled'}}"
                    href="{{route('cart.pagar')}}">Pagar</a>
            </div>
        </div>
    </div>
</div>