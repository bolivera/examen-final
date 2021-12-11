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
                    <li class="breadcrumb-item"><a class="" href="/">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Hogar</font>
                            </font>
                        </a></li>
                    <li class="active breadcrumb-item" aria-current="page"><span class="">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Calzado</font>
                            </font>
                        </span>
                    </li>
                </ol>
            </nav>
            <div class="hero-content pb-5 text-center">

                <div class="col-md-9 mt-9">
                    <div class="breadcrumb-form container-filter">
                        <div class="filter-key">
                            @if(!empty($filtros))
                            @foreach($filtros as $filtro)
                            @if($filtro['value'] != null)
                            <div data-result="{!! $filtro['name'].'='.$filtro['value'] !!}">

                                @switch($filtro['name'])

                                @case("categoria")
                                @foreach($categorias as $cat)
                                @if(intval($filtro['value']) == $cat->id)
                                @php($tem_categoria = $cat->nombre )
                                @endif
                                @endforeach
                                @break


                                @case("coleccion")
                                @foreach($colecciones as $colec)
                                @if(intval($filtro['value']) == $colec->id)
                                @php($tem_coleccion = $colec->titulo )
                                @endif
                                @endforeach
                                @break

                                @case("talla")
                                @php($tem_talla = $filtro['value'] )
                                @php($talla = explode(",", $tem_talla))
                                @break

                                @case("color")
                                @php($aux_color = $filtro['value'] )
                                @php($color = explode(",", $aux_color))
                                @break

                                @case("despacho")
                                @php($aux_despacho = $filtro['value'] )
                                @php($despacho = $aux_despacho)
                                @break

                                @case("precio_min")
                                @php($tem_saldo_min = $filtro['value'] )
                                @break

                                @case("precio_max")
                                @php($tem_saldo_max = $filtro['value'] )
                                @break

                                @endswitch
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>

                    </div>
                </div>

                <h1 class="mb-3">
                    <font style="vertical-align: inherit;">
                        @if(isset($tem_categoria))
                        <font style="vertical-align: inherit;">{{$tem_categoria}}</font>
                        @else
                        @if(isset($tem_coleccion))
                        <font style="vertical-align: inherit;">{{$tem_coleccion}}</font>
                        @else
                        <font style="vertical-align: inherit;">Todos los productos</font>
                        @endif
                        @endif
                    </font>
                </h1>


            </div>
            <div class="row justify-content-between mb-3">
                <div class="col-xl-3 col-sm-12 col-lg-12">
                    <select id="orden-dep" class="form-control" onchange="changeCriteria(event, {!! $current_page !!})"
                        data-name="orden">
                        <option value="" selected>Ordenar por</option>
                        <option value="1">Precio de menor a mayor</option>
                        <option value="2">Precio de mayor a menor</option>
                        <option value="3">A-Z</option>
                        <option value="4">Z-A</option>

                    </select>
                </div>
            </div>
        </div>

    </section>
    <div class="container">
        <div class="row">
            <div class="products-grid order-lg-2 col-lg-8 col-xl-9">
                <div class="row">
                    @foreach($productos as $producto)
                    <div class="col-sm-6 col-xl-4 col-6">
                        <div class="product">
                            <div class="product-image">
                                <div class="ribbon ribbon-primary">DISPONIBLE</div>
                                <div
                                    style="display: block; overflow: hidden; position: relative; box-sizing: border-box; margin: 0px;">
                                    <div style="display: block; box-sizing: border-box; padding-top: 150%;"></div>
                                    <img alt="Camiseta blanca" src="{{$producto->photos[0]['urlCompleta']}}"
                                        decoding="async" class="img-fluid"
                                        style="visibility: inherit; position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                                </div>
                                <div class="product-hover-overlay">
                                    <a class="product-hover-overlay-link"
                                        href="{{route('front.productoDetalle',[$producto->id, $producto->slug])}}"></a>
                                    <div class="product-hover-overlay-buttons">
                                        <!-- <a class="btn btn-outline-dark btn-product-left add-cart"
                                                   data-list="true" data-id="{{$producto->id}}"
                                                   href="javascript:void(0)">
                                                    <i class="fa icofont-ui-cart"></i>
                                                </a> -->
                                        <a class="btn btn-dark btn-buy"
                                            href="{{route('front.productoDetalle',[$producto->id, $producto->slug])}}">
                                            <i class="icofont-ui-search"></i>
                                            <span class="btn-buy-label ml-2">Ver</span>
                                        </a>
                                        <a class="btn btn-outline-dark btn-product-right" data-toggle="modal"
                                            data-target="#modal-{{$producto->id}}" data-backdrop="static">
                                            <i class="icofont-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2">
                                <p class="text-muted text-sm mb-1">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">{{$producto->categoria->nombre}} </font>
                                    </font>
                                </p>
                                <h3 class="h6 text-uppercase mb-1"><a class="text-dark"
                                        href="{{route('front.productoDetalle',[$producto->id, $producto->slug])}}">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">{{$producto->titulo}}</font>
                                        </font>
                                    </a>
                                </h3><span class="text-muted">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">S/ </font>
                                    </font>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">{{ number_format($producto->precio,2)}}
                                        </font>
                                    </font>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade quickview" id="modal-{{$producto->id}}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <button class="close modal-close" type="button" data-dismiss="modal" aria-label="Close">
                                    <svg class="svg-icon w-100 h-100 svg-icon-light align-middle">
                                        <use xlink:href="#close-1">
                                            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="close-1">
                                                <title>Close</title>
                                                <desc>A line styled icon from Orion Icon Library.</desc>
                                                <path data-name="layer1" fill="none" stroke="#202020"
                                                    stroke-miterlimit="10" d="M41.999 20.002l-22 22m22 0L20 20"
                                                    stroke-linejoin="round" stroke-linecap="round"
                                                    style="stroke:var(--layer1, #202020)"></path>
                                            </symbol>
                                        </use>
                                    </svg>
                                </button>
                                <div class="modal-body">
                                    <div class="ribbon ribbon-primary">DISPONIBLE</div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="owl-carousel owl-theme owl-dots-modern detail-full"
                                                data-slider-id="1">
                                                @foreach($producto->photos as $foto)
                                                <div class="detail-full-item-modal"
                                                    style="background: center center url('{{$foto['urlCompleta']}}') no-repeat; background-size: cover;">
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="col-lg-6 d-flex align-items-center">
                                            <div>
                                                <h2 class="mb-4 mt-4 mt-lg-1">{{$producto->titulo}}</h2>
                                                <div
                                                    class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                                                    <ul class="list-inline mb-2 mb-sm-0">
                                                        <li class="list-inline-item h4 font-weight-light mb-0">S/.
                                                            {{ number_format($producto->precio, 2) }} (Oferta)
                                                        </li>
                                                        <li class="list-inline-item text-muted font-weight-light">
                                                            <del>S/
                                                                {{ number_format($producto->precio + ($producto->precio)*0.20, 2) }}</del>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="mb-4 text-muted">{{$producto->Descripcion}}</p>
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-12 detail-option mb-1">
                                                            <h6 class="detail-option-heading">Selecciona Talla </h6>
                                                            <p class="text-muted font-weight-light text-sm ">
                                                                <span role="button" tabindex="0" data-toggle="modal" data-target="#tallas"
                                                                    class="jsx-1736324396 sizechart-link fa--size-chart-link"><i
                                                                        class="jsx-1736324396 talla-pie">
                                                                    </i>
                                                                    <span class="jsx-1736324396">Tabla de tallas</span>
                                                                </span>
                                                            </p>
                                                            <?php $talls = explode('|', $producto->tallas);?>
                                                            <?php foreach ($talls as $key => $item): ?>
                                                            <?php if (!empty($item)): $tal = CodebelHelpers::getTallasBD($item)?>

                                                            <span class="">
                                                                <label for="tallas_{{$producto->id.'_'.$key}}"
                                                                    class="option size-button btn btn-sm btn-outline-secondary detail-option-btn-label mr-2">{{$tal->medida}}
                                                                    <input type="radio" name="talla"
                                                                        id="tallas_{{$producto->id.'_'.$key}}"
                                                                        value="{{$tal->medida}}"
                                                                        class="input-invisible form-check-input checkbox-radio" />
                                                                </label>
                                                            </span>

                                                            <?php endif;?>
                                                            <?php endforeach;?>

                                                        </div>

                                                        <div class="detail-option mb-4 col-sm-12 col-lg-12 col-xl-12 ">
                                                            <h6 class="detail-option-heading">Selecciona un color </h6>
                                                            <ul class="list-inline mb-0 colours-wrapper">
                                                                <?php $coloresPro = explode('|', $producto->colores);?>
                                                                <?php foreach ($coloresPro as $key => $value): ?>
                                                                <?php if (!empty($value)): $colors = CodebelHelpers::getColoresDB($value)?>
                                                                <li class="list-inline-item text-center">
                                                                    <label class="btn-colour"
                                                                        for="color_{{$producto->id.'_'.$key}}"
                                                                        style="background-color: {{$colors->codigo_hexa}}">
                                                                    </label>
                                                                    <input class="input-invisible" type="radio"
                                                                        name="color"
                                                                        id="color_{{$producto->id.'_'.$key}}"
                                                                        value="{{$colors->nombre}}" />
                                                                    <p><span
                                                                            class="text-muted">{{$colors->nombre}}</span>
                                                                    </p>

                                                                </li>
                                                                <?php endif;?>
                                                                <?php endforeach;?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <button type="button"
                                                                class="mb-1 btn btn-dark rounded-3 add-cart"
                                                                data-id="{{$producto->id}}"><i
                                                                    class="icofont-ui-cart icofont-lg"></i>
                                                                Agregar al carrito
                                                            </button>
                                                        </li>

                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li><strong>Tags: </strong>
                                                            <?php $tags = explode(',', $producto->tags);?>
                                                            <?php foreach ($tags as $key => $value): ?>
                                                            <?php if (!empty($value)): ?>
                                                            <a class="text-muted"
                                                                href="{{route('front.buscar',[ Str::slug($value,'-')])}}">{{$value}},</a>
                                                            <?php endif;?>
                                                            <?php endforeach;?>
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                <input type="hidden" id="unidades" class="form-control detail-quantity" name="unidades" value="1"
                    min="1" pattern="^[0-9]+" />
                <div class="row">
                    <ul class="mx-auto pagination">
                        <div class="nav-links" style="display: flex;justify-content: center;">
                            <input type="hidden" id="stop_pagination" value="{!! $cantidad_productos !!}">
                            <li>
                                <button class="page-link" href="#" onclick="prevPage(event, {!! $current_page !!})"
                                    class="next page-numbers" id="prev_page">&lsaquo;</button>
                            </li>
                            @for ($i = 0; $i < $cantidad_productos; $i++) <li><a
                                    class="page-numbers page-item page-link" href=""
                                    onclick="chnagePageWitchCriteria(event)" data-page="{!! $i+1 !!}">{!! $i+1 !!}</a>
                                </li>
                                @endfor
                                <li>
                                    <button class="page-link" onclick="nextPage(event, {!! $current_page !!})"
                                        class="prev page-numbers" id="next_page">&rsaquo;</button>
                                </li>
                        </div>
                    </ul>
                </div>


            </div>


            <div class="sidebar col-lg-4 order-lg-1 col-xl-3">

                <div class="pt-3 pb-3 px-3 px-lg-0 mr-lg-4" style="border-bottom: 1px solid #e9ecef;">
                    <div data-id="job-type" class="job-filter job-type same-pad">
                        <h6 class="sidebar-heading d-none d-lg-block">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Precio</font>
                            </font>
                        </h6>

                        <div class="form-group row">
                            <div class="selector">
                                <div class="price-slider">
                                    <div id="slider-range" style="margin-left: none !important">
                                    </div>

                                    @if(isset($tem_saldo_min))
                                    <span id="min-price" data-currency="Desde S/"
                                        class="slider-price">{{$tem_saldo_min}}</span>
                                    @else
                                    <span id="min-price" data-currency="Desde S/" class="slider-price">0</span>
                                    @endif

                                    <span class="seperator"></span>

                                    @if(isset($tem_saldo_max))
                                    <span id="max-price" data-currency="Hasta S/" data-max="1000"
                                        class="slider-price">{{$tem_saldo_max}}</span>
                                    @else
                                    <span id="max-price" data-currency="Hasta S/" data-max="1000"
                                        class="slider-price">1000</span>
                                    @endif

                                </div>
                            </div>
                            <div class="btn-block ml-3 mr-3" data-name="salario"
                                onclick="changeCriteria_salario(event,{!! $current_page !!})" data-name="salario">
                                <a class="btn btn-outline-secondary btn-block">
                                    Buscar
                                </a>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="sidebar-block px-3 px-lg-0 mr-lg-4"><a class="d-lg-none block-toggler">Filter by brand</a>
                    <div class="expand-lg collapse">

                        <h6 class="sidebar-heading d-none d-lg-block">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">TALLAS</font>
                            </font>
                        </h6>

                        @foreach($tallas as $tall)
                        @if(isset($talla))
                        @foreach($talla as $tal_item)
                        @if($tal_item == $tall->id )
                        @php($bandera_talla = 1)

                        @break
                        @else
                        @php($bandera_talla = 0)
                        @endif
                        @endforeach

                        @if($bandera_talla == 1)
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="{{$tall->medida}}" type="checkbox"
                                data-name="{{$tall->id}}" onchange="changeTalla(event,{!! $current_page !!})" checked>
                            <label class="custom-control-label" for="{{$tall->medida}}">{{$tall->medida}}</label>
                        </div>
                        @else
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="{{$tall->medida}}" data-name="{{$tall->id}}"
                                type="checkbox" onchange="changeTalla(event,{!! $current_page !!})">
                            <label class="custom-control-label" for="{{$tall->medida}}">{{$tall->medida}}</label>
                        </div>
                        @endif
                        @else
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="{{$tall->medida}}" data-name="{{$tall->id}}"
                                type="checkbox" onchange="changeTalla(event,{!! $current_page !!})">
                            <label class="custom-control-label" for="{{$tall->medida}}">{{$tall->medida}} </label>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>


                <div class="sidebar-block px-3 px-lg-0 mr-lg-4"><a class="d-lg-none block-toggler">Filter by brand</a>
                    <div class="expand-lg collapse">
                        <h6 class="sidebar-heading d-none d-lg-block">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Color</font>
                            </font>
                        </h6>
                        @foreach($colores as $col)
                        @if(isset($color))
                        @foreach($color as $col_item)
                        @if($col_item == $col->id )
                        @php($bandera_color = 1)
                        @break
                        @else
                        @php($bandera_color = 0)
                        @endif
                        @endforeach

                        @if($bandera_color == 1 )
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="{{$col->nombre}}" type="checkbox"
                                data-name="{{$col->id}}" onchange="changeColor(event,{!! $current_page !!})" checked>
                            <label class="custom-control-label" for="{{$col->nombre}}">{{$col->nombre}}</label>
                        </div>
                        @else
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="{{$col->nombre}}" data-name="{{$col->id}}"
                                type="checkbox" onchange="changeColor(event,{!! $current_page !!})">
                            <label class="custom-control-label" for="{{$col->nombre}}">{{$col->nombre}} </label>
                        </div>
                        @endif

                        @else
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" id="{{$col->nombre}}" data-name="{{$col->id}}"
                                type="checkbox" onchange="changeColor(event,{!! $current_page !!})">
                            <label class="custom-control-label" for="{{$col->nombre}}">{{$col->nombre}} </label>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>


                <div class="sidebar-block px-3 px-lg-0 mr-lg-4"> <a class="d-lg-none block-toggler"
                        data-toggle="collapse" href="#sizeFilterMenu" aria-expanded="false"
                        aria-controls="sizeFilterMenu">Filter by size</a>
                    <!-- Size filter menu-->
                    <div class="expand-lg collapse" id="sizeFilterMenu">
                        <h6 class="sidebar-heading d-none d-lg-block">Despacho</h6>
                        <form class="mt-4 mt-lg-0" action="#">

                            <div class="form-group mb-1">
                                <div class="custom-control custom-radio">

                                    @if(isset($despacho))
                                    @if($despacho == 0 )
                                    <input class="custom-control-input" id="size0" type="radio" name="size"
                                        data-name="0" onchange="changeDespacho(event,{!! $current_page !!})" checked>
                                    @else
                                    <input class="custom-control-input" id="size0" type="radio" name="size"
                                        data-name="0" onchange="changeDespacho(event,{!! $current_page !!})">
                                    @endif
                                    @else
                                    <input class="custom-control-input" id="size0" type="radio" name="size"
                                        data-name="0" onchange="changeDespacho(event,{!! $current_page !!})">
                                    @endif

                                    <label class="custom-control-label" for="size0">Tienda</label>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <div class="custom-control custom-radio">
                                    @if(isset($despacho))
                                    @if($despacho == 1 )
                                    <input class="custom-control-input" id="size1" type="radio" name="size"
                                        data-name="1" onchange="changeDespacho(event,{!! $current_page !!})" checked>
                                    @else
                                    <input class="custom-control-input" id="size1" type="radio" name="size"
                                        data-name="1" onchange="changeDespacho(event,{!! $current_page !!})">
                                    @endif
                                    @else
                                    <input class="custom-control-input" id="size1" type="radio" name="size"
                                        data-name="1" onchange="changeDespacho(event,{!! $current_page !!})">
                                    @endif
                                    <label class="custom-control-label" for="size1">Domicilio</label>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <div class="custom-control custom-radio">
                                    @if(isset($despacho))
                                    @if($despacho == 2 )
                                    <input class="custom-control-input" id="size2" type="radio" name="size"
                                        data-name="2" onchange="changeDespacho(event,{!! $current_page !!})" checked>
                                    @else
                                    <input class="custom-control-input" id="size2" type="radio" name="size"
                                        data-name="2" onchange="changeDespacho(event,{!! $current_page !!})">
                                    @endif
                                    @else
                                    <input class="custom-control-input" id="size2" type="radio" name="size"
                                        data-name="2" onchange="changeDespacho(event,{!! $current_page !!})" checked>
                                    @endif
                                    <label class="custom-control-label" for="size2">Tienda & Domicilio</label>
                                </div>
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