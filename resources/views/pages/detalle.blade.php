@extends('layouts.app')
@section('header')
{!! $header !!}
<style>
.magnifier-lens {
    position: absolute;
    z-index: 1;
    background: #e5e5e5 no-repeat;
    border: solid #ebebeb;
    box-shadow: 2px 2px 3px rgb(0 0 0 / 30%);
    opacity: 0;
    transition: opacity 0.3s;
    pointer-events: none;
}
</style>
@endsection
@section('content')
<main>
    <section class="product-details page-product">
        <div class="container">
            <div class="row">
                <div class="pt-4 col-12 order-1 col-lg-7 order-lg-1">
                    <div class="row">
                        <div class="detail-carousel order-md-2 col-12 col-md-10">
                            <div class="ribbon ribbon-primary">DISPONIBLE</div>
                            {!! CodebelHelpers::getEtiquetas($producto); !!}
                            <div class="swiper-container">
                                <div class="swiper-wrapper img-magnifier-container">
                                    <div class="large"></div>
                                    @foreach($fotos as $foto)
                                    <div class="swiper-slide">
                                        <div class="img-fluid " style="width:100%;height:auto;overflow:hidden"><img
                                                class="magnifier-image small" id="img-{{$foto['id']}}"
                                                data-toggle="magnify" src="{{$foto['urlCompleta']}}" width="100%"
                                                height="100%" alt="Modern Jacket 1" />
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-md-block pr-0 order-md-1 col-md-2 swiper-thumbnails">
                            @foreach($fotos as $foto)
                            <button class="detail-thumb-item mb-3 thumbnails ">
                                <img class="img-fluid" src="{{$foto['urlCompleta']}}" alt="Modern Jacket 1" />
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pl-lg-4 col-12 order-2 col-lg-5 order-lg-2">
                    <nav class="" aria-label="breadcrumb">
                        <ol class="breadcrumb no-border mb-0 pb-0">
                            <li class="active breadcrumb-item " aria-current="page"><span class=""><a
                                        href="{{route('front.categoria',[$producto->categoria->id, $producto->categoria->alias])}}">{{$producto->categoria->nombre}}</a></span>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mb-4 mt-3">{{$producto->titulo}}</h1>
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                        <ul class="list-inline mb-2 mb-sm-0">
                            <li class="list-inline-item h4 font-weight-bold mb-0 jsx-3736277290">
                                S/. {{ number_format($producto->precio, 2) }} (Oferta)
                            </li>
                            <li class="list-inline-item text-muted font-weight-light">
                                <del>S/ {{ number_format($producto->precio + ($producto->precio)*0.20, 2) }} </del>
                            </li>
                        </ul>

                    </div>
                    <p class="mb-4 text-muted">{{$producto->Descripcion}}</p>
                    <form class="">
                        @csrf
                        <div class="row">
                            <div class="detail-option mb-4 col-sm-12 col-lg-12 col-xl-12">
                                <h6 class="detail-option-heading">Selecciona Talla </h6>
                                <p class="text-muted font-weight-light text-sm ">
                                    <span role="button" tabindex="0" data-toggle="modal" data-target="#tallas"
                                        class="jsx-1736324396 sizechart-link fa--size-chart-link"><i
                                            class="jsx-1736324396 talla-pie">
                                        </i>
                                        <span class="jsx-1736324396">Tabla de tallas</span>
                                    </span>
                                </p>

                                <?php $tallas = explode('|', $producto->tallas);?>
                                <?php foreach ($tallas as $key => $item): ?>
                                <?php if (!empty($item)): $talla = CodebelHelpers::getTallasBD($item)?>

                                <span class="">
                                    <label for="tallas__{{$key}}"
                                        class="option size-button btn btn-sm btn-outline-secondary detail-option-btn-label mr-2 ">{{$talla->medida}}
                                        <input type="radio" name="talla" id="tallas__{{$key}}"
                                            value="{{$talla->medida}}"
                                            class="input-invisible form-check-input checkbox-radio" />
                                    </label>
                                </span>

                                <!-- <input type="radio" id="male" name="gender" value="{{$talla->id}}">
		                                    <label for="male">{{$talla->medida}}</label> -->

                                <?php endif;?>
                                <?php endforeach;?>
                            </div>

                            <div class="detail-option mb-4 col-sm-12 col-lg-12 col-xl-12 ">
                                <h6 class="detail-option-heading">Selecciona un color </h6>
                                <ul class="list-inline mb-0 colours-wrapper">
                                    <?php $colores = explode('|', $producto->colores);?>
                                    <?php foreach ($colores as $key => $value): ?>
                                    <?php if (!empty($value)): $color = CodebelHelpers::getColoresDB($value)?>
                                    <li class="list-inline-item text-center">
                                        <label class="btn-colour" for="colores__{{$key}}"
                                            style="background-color: {{$color->codigo_hexa}}"> </label>
                                        <input class="input-invisible" type="radio" name="color" id="colores__{{$key}}"
                                            value="{{$color->nombre}}" />
                                        <p><span class="text-muted">{{$color->nombre}}</span></p>
                                    </li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>

                            </div>

                            <div class="detail-option  col-12 col-lg-6 mb-3">
                                <!-- <label class="detail-option-heading font-weight-bold hiden">Cantidad</label> -->
                                <input type="hidden" id="unidades" class="form-control detail-quantity" name="unidades"
                                    value="1" min="1" pattern="^[0-9]+" />
                            </div>
                            <!-- <div class="detail-option  col-12 col-lg-6 mb-3">
                                <label class="detail-option-heading font-weight-bold">Cantidad</label>
                                <input type="hidden" id="unidades" class="form-control detail-quantity" name="unidades"
                                    value="1" min="1" pattern="^[0-9]+" />
                            </div> -->
                        </div>
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item">
                                <button type="button" class="mb-1 btn btn-dark rounded-3 add-cart"
                                    data-id="{{$producto->id}}"><i class="icofont-ui-cart icofont-lg"></i>
                                    Agregar al carrito
                                </button>
                            </li>
                            <li class="list-inline-item"></li>
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

                    <div class="sharethis-inline-share-buttons"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5">
        <div class="container">
            <ul class="nav nav-tabs flex-column flex-sm-row" role="tablist">
                <li class="nav-item"><a class="nav-link detail-nav-link active" data-toggle="tab" href="#description"
                        role="tab">Información adicional</a></li>

            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active px-3" id="description" role="tabpanel">
                    {!! $producto->descripcionCompleta !!}
                </div>

            </div>
        </div>
    </section>
    @if(count($sugerencias) > 0)
    <section class="my-5">
        <div class="container">
            <header class="text-center">
                <h6 class="text-uppercase mb-5">TAMBIÉN PODRÍA GUSTARTE</h6>
            </header>
            <div class="row">

                @foreach($sugerencias as $sugerencia)
                <!-- product-->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="product">
                        <div class="product-image">
                            {!! CodebelHelpers::getEtiquetas($sugerencia); !!}

                            <img class="img-fluid" src="{{$sugerencia->photo[0]['urlCompleta']}}" alt="product">
                            <div class="product-hover-overlay">
                                <a class="product-hover-overlay-link"
                                    href="{{route('front.productoDetalle',[$sugerencia->id, $sugerencia->slug])}}"></a>
                                <div class="product-hover-overlay-buttons">
                                    <a class="btn btn-dark btn-buy"
                                        href="{{route('front.productoDetalle',[$sugerencia->id, $sugerencia->slug])}}">
                                        <i class="icofont-ui-search"></i>
                                        <span class="btn-buy-label ml-2">Ver</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <p class="text-muted text-sm mb-1">{{$sugerencia->categoria->nombre}}</p>
                            <h3 class="h6 text-uppercase mb-1"><a class="text-dark"
                                    href="{{route('front.productoDetalle',[$sugerencia->id, $sugerencia->slug])}}">{{$sugerencia->titulo}}</a>
                            </h3><span class="text-muted">S/ {{ number_format($sugerencia->precio,2)}} </span>
                        </div>
                    </div>
                </div>
                <!-- /product-->
                @endforeach
            </div>
        </div>
    </section>
    @endif


</main>
@endsection
@section('footer')
{!! $footer !!}
@endsection

@section('scripts')
<script type="text/javascript"
    src="https://platform-api.sharethis.com/js/sharethis.js#property=60b3af0e2a32fe0011bf9d1c&product=inline-share-buttons"
    async="async"></script>
<script type="text/javascript">


</script>
@endsection