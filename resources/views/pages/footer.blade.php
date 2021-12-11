<footer class="main-footer">
    <div class="bg-gray-100 text-dark-700 py-6">
        <div class="container">
            <div class="row">
                <div class="service-column col-lg-4">
                    <svg class="svg-icon service-icon">
                        <use xlink:href="/icons/orion-svg-sprite.svg#delivery-time-1"></use>
                    </svg>
                    <div class="service-text">
                        <h6 class="text-uppercase">ENTREGA GRATIS</h6>
                        <p class="text-muted font-weight-light text-sm mb-0">A partir de S/ 300</p>
                    </div>
                </div>
                <div class="service-column col-lg-4">
                    <svg class="svg-icon service-icon">
                        <use xlink:href="/icons/orion-svg-sprite.svg#customer-support-1"></use>
                    </svg>
                    <div class="service-text">
                        <h6 class="text-uppercase"><a href="https://wa.me/+51955362625?text=Hola DomiMan"
                                class="text-gray-900" target="_blank">
                                <i class="icofont-whatsapp"></i>
                                955 362 625
                            </a>
                            </li>
                        </h6>
                        <p class="text-muted font-weight-light text-sm mb-0">Soporte disponible 24 horas al día, 7 días
                            a la semana</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6 bg-gray-300 text-muted">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="font-weight-bold text-uppercase text-lg text-dark mb-3"><img
                            src="{{asset('assets/img/logo.svg')}}" width="200"><span class="text-primary">.</span></div>
                    <ul class="list-inline">
                        <!-- <li class="list-inline-item">
                            <a class="text-muted text-hover-primary" href="#" target="_blank" title="twitter"><i
                                    class="fab fa-twitter"></i></a>
                        </li> -->
                        <li class="list-inline-item">
                            <a class="text-muted text-hover-primary" href="https://www.facebook.com/domiman.pe" target="_blank" title="facebook"><i
                                    class="icofont-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-muted text-hover-primary" href="https://www.instagram.com/domiman.pe/?hl=es-la" target="_blank" title="instagram"><i
                                    class="icofont-instagram"></i></a>
                        </li>
                        <!-- <li class="list-inline-item">
                            <a class="text-muted text-hover-primary" href="#" target="_blank" title="pinterest"><i
                                    class="fab fa-pinterest"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-muted text-hover-primary" href="#" target="_blank" title="vimeo"><i
                                    class="fab fa-vimeo"></i>
                            </a>
                        </li> -->
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <h6 class="text-uppercase text-dark mb-3">Categorías</h6>
                    <ul class="list-unstyled">
                        @foreach($categorias as $categoria)
                        <li><a onclick="addCriteria(event)" data-categoria="{!! $categoria->id !!}"
                                data-name="categoria" class="text-muted">{{$categoria->nombre}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <h6 class="text-uppercase text-dark mb-3">Nosotros</h6>
                    <ul class="list-unstyled">
                        <li><a class="text-muted" href="#">Contáctanos</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="text-uppercase text-dark mb-3">OFERTAS Y DESCUENTOS DIARIOS</h6>
                    <p class="mb-3">Recibe las mejores ofertas.</p>
                    <form action="#" id="newsletter-form">
                        <div class="input-group mb-3"><input type="email"
                                class="form-control bg-transparent border-secondary border-right-0"
                                placeholder="Tu correo elctrónico" aria-label="Tu email">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0" type="submit"><i
                                        class="fa fa-paper-plane text-lg text-dark"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4 font-weight-light bg-gray-800 text-gray-300">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    <p class="mb-md-0">© {{date('Y')}} <a href="https://codebel.pe" target="_blank" rel="noopener noreferrer"> Codebel</a>. Todos
                        los derchos reservados.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline mb-0 mt-2 mt-md-0 text-center text-md-right">
                        <li class="list-inline-item"><img class="w-2rem" src="{{asset("/svg/visa.svg")}}"></li>
                        <li class="list-inline-item"><img class="w-2rem" src="{{asset("/svg/mastercard.svg")}}"></li>
                        <li class="list-inline-item"><img class="w-2rem" src="{{asset("/svg/paypal.svg")}}"></li>
                        <li class="list-inline-item"><img class="w-2rem" src="{{asset("/svg/western-union.svg")}}"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>