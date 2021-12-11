<?php $version = '?v=311091.456';?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.5">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{isset($titulo) ? $titulo : 'Domiman  - Zapatos para hombres, zapatos de cuero'}} </title>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#0060ab">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#0060ab">

    <meta name="description"
        content="{{isset($descripcion) ? $descripcion : 'En Domiman nos preocupamos por tu comodidad y bienestar!' }}" />
    <meta name="keywords"
        content="{{isset($producto->tags)  ? $producto->tags : 'domiman,zapatos de hombre, zapatos de elegantes,zapatos de cuero,cazuales' }}" />
    <meta name="news_keywords"
        content="{{isset($producto->tags)  ? $producto->tags : 'domiman,zapatos de hombre, zapatos de elegantes,zapatos de cuero,cazuales' }}" />
    <meta name="revisit-after" content="1 day" />
    <link rel="dns-prefetch" href="//www.facebook.com/" />
    <link rel="dns-prefetch" href="//pixel.facebook.com/" />
    <link rel="dns-prefetch" href="//www.google-analytics.com/" />
    <link rel="dns-prefetch" href="//www.google.com/" />
    <link rel="dns-prefetch" href="//gstatic.com/" />
    <link rel="preconnect" href="//www.google-analytics.com/">
    <meta property="og:site_name" content="Domiman" />
    <meta property="og:type" content="{{isset($producto) ? 'article' : 'website' }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:title"
        content="{{isset($titulo) ? $titulo : 'Domiman  - Zapatos para hombres, zapatos de cuero'}}" />
    <meta property="og:description"
        content="{{isset($descripcion) ? $descripcion : 'En Domiman nos preocupamos por tu comodidad y bienestar!' }}" />
    <meta property="og:image" content="{{ isset($image) ? $image : asset('img/default.png') }}" />
    <meta property="fb:admins" content="102063944560605" />
    @if(isset($producto))
    <meta property="article:published_time" content="{{  gmdate('Y-m-d\TH:i:s', strtotime($producto->created_at))}}" />
    <meta property="article:modified_time" content="{{  gmdate('Y-m-d\TH:i:s', strtotime($producto->created_at))}}" />
    <meta property="article:author" content="Domiman" />
    <meta property="article:section"
        content="{{ isset($producto->categoria->nombre) ? $producto->categoria->nombre : ''  }}" />
    <?php $tags = explode(',', $producto->tags);?>
    <?php foreach ($tags as $key => $value): ?>
    <?php if (!empty($value)): ?>
    <meta property="article:tag" content="{{$value}}" />
    <?php endif;?>
    <?php endforeach;?>
    @endif
    <meta name="googlebot" content="index,follow" />
    <meta name="robots" content="max-image-preview:large">
    <meta http-equiv="Content-Language" name="language" content="es" />
    <meta name="distribution" content="Global" />
    <meta property="fb:app_id" content="504982690660983" />
    <meta name="lang" content="es" itemprop="inLanguage" />
    <link type="text/css" href="{{ asset('css/carrusel.css'.$version) }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/range.css'.$version) }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/app.css'.$version) }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/modal.css'.$version) }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/progressbar.css'.$version) }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" rel="stylesheet" href="{{asset('/css/tag.css?v=10.3')}}">

</head>

<body>
    @yield('header')
    @yield('content')
    @yield('footer')
    <div class="sold_sale_popup sold_sale_popup_bl">
        <div class="sold_sale_product_image">
            <img src="">
        </div>
        <div class="sold_sale_info">
            <div class="close-noti" id="salsepop_close">
                <svg viewBox="0 0 20 20">
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z"
                        fill="#82869e"></path>
                </svg>
            </div>
            <div class="noti-body">
                <a href="javascript:void(0)" style="color: rgb(85, 88, 108);"></a>
            </div>
            <div class="noti-title">
                <span style="color: rgb(85, 88, 108);"></span>
            </div>
            <div class="noti-time" style="color: rgb(85, 88, 108);"></div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal right fade" id="tallas" tabindex="-1" role="dialog" aria-labelledby="tallas" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content  p-0 m-0">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title " id="tallas ">Tabla de tallas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <div class="col-12 p-2 mb-3 text-center">
                        <img src="{{asset('assets/img/logo.svg')}}" width="180">
                    </div>
                    <h3 class="text-center">HOMBRES</h3>
                    <table class="table table-sm text-center ">
                        <thead>
                            <tr>
                                <th scope="col">PERÚ</th>
                                <th scope="col">US</th>
                                <th scope="col">UK</th>
                                <th scope="col">CM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>38</td>
                                <td>6</td>
                                <td>51/2</td>
                                <td>25.7</td>
                            </tr>
                            <tr>
                                <td>39</td>
                                <td>61/2</td>
                                <td>6</td>
                                <td>26.2</td>
                            </tr>
                            <tr>
                                <td>40</td>
                                <td>7</td>
                                <td>61/2</td>
                                <td>26.6</td>
                            </tr>
                            <tr>
                                <td>41</td>
                                <td>8</td>
                                <td>71/2</td>
                                <td>27.5</td>
                            </tr>
                            <tr>
                                <td>42</td>
                                <td>81</td>
                                <td>8</td>
                                <td>27.9</td>
                            </tr>
                            <tr>
                                <td>43</td>
                                <td>9</td>
                                <td>9</td>
                                <td>28.8</td>
                            </tr>
                            <tr>
                                <td>44</td>
                                <td>91/2</td>
                                <td>91/2</td>
                                <td>29.1</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="text-center">MUJERES</h3>
                    <table class="table table-sm text-center ">
                        <thead>
                            <tr>
                                <th scope="col">PERÚ</th>
                                <th scope="col">CMS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>35</td>
                                <td>22,5</td>
                            </tr>
                            <tr>
                                <td>36</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>37</td>
                                <td>23.7</td>
                            </tr>
                            <tr>
                                <td>38</td>
                                <td>24.4</td>
                            </tr>
                            <tr>
                                <td>39</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>40</td>
                                <td>26.5</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <p style="font-size:0.8rem">¿Estás entre dos tallas?
                        Te recomendamos que elijas la talla más grande y te los pruebes al recibirlos. Si no te quedaron
                        , descuida!. Con nuestra atención al cliente para tu satisfación de garantizamos tener 30 días
                        para cambiar de talle en la tienda física o en línea a través del whatsapp 955362625.</p>
                    <div class="col-12 text-center row">
                        <div class=" col">
                            <img src="{{ asset('svg/talla.svg') }}">
                            <a href="{{ asset('assets/tabla-tallas-domiman.pdf') }}" class="text-gray-900"
                                target="_blank">Descarga nuestra plantilla hombres para medir tu pie</a>
                        </div>
                        <div class="col">
                            <img src="{{ asset('svg/talla.svg') }}">
                            <a href="{{ asset('assets/tabla-tallas-domiman.pdf') }}" class="text-gray-900"
                                target="_blank">Descarga nuestra plantilla mujeres para medir tu pie</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Messenger plugin de chat Code -->
    <div id="fb-root"></div>

    <!-- Your plugin de chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "102063944560605");
    chatbox.setAttribute("attribution", "biz_inbox");
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v11.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>


    <link href="{{ asset('css/iconos.css') }}" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('front/js/main.js'.$version) }}"></script>
    <script src="{{ asset('front/js/app.js'.$version) }}"></script>
    <script src="{{ asset('front/js/formulario.js'.$version) }}"></script>
    <script src="{{ asset('front/js/filtros.js'.$version) }}"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="{{ asset('front/js/range.js'.$version) }}"></script>
    <script src="{{ asset('front/js/paginacion.js'.$version) }}"></script>

    <script>
    var basePath = ''
    </script>
    @yield('scripts')
</body>

</html>