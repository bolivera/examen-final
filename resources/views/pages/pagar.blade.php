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
                    <ul class="custom-nav nav nav-pills mb-5">
                        <li class="nav-item w-25">
                            <a class="nav-link text-sm">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Pedido</font>
                                </font>
                            </a>
                        </li>
                        <li class="nav-item w-25">
                        <a class="nav-link text-sm active">
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
                     <form class="tab-content" id="form-checkout" method="post" action="realizar-pago"> 
                        @csrf
                        <div class="collapse show" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="mb-4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Dirección de envío</font>
                                </font>
                            </h3>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="fullname_invoice"  class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Nombre</font>
                                        </font>
                                    </label>
                                    <input name="fullname_invoice"  id="nombres" type="text" required value="{{ old('nombres') }}"
                                           class="form-control" >
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="lastName_invoice"  class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Apellidos completos</font>
                                        </font>
                                    </label>
                                    <input name="lastName_invoice"  id="apellidos" type="text" required value="{{ old('apellidos') }}"
                                           class="form-control" >
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="emailaddress_invoice"  class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Correo electrónico</font>
                                        </font>
                                    </label>
                                    <input name="emailaddress_invoice"  id="email" type="email"
                                           class="form-control"  required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="street_invoice" class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Dirección / Referencias</font>
                                        </font>
                                    </label>
                                    <input name="street_invoice" id="direccion" type="text" class="form-control" 
                                     required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="city_invoice" class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Departamento</font>
                                        </font>
                                    </label>
                                    <div class="form-group ">
                                        <select id="departamento" class="form-control" required name="departamento">
                                            <option selected>[Seleccionar]
                                            @if(!empty($departamentos))
                                                @foreach($departamentos as $dep)
                                                    <option value="{{ $dep->coddep }}">{{ $dep->nmbubigeo }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="city_invoice" class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Provincia</font>
                                        </font>
                                    </label>
                                    <select id="provincia" class="form-control" required name="provincia">
                                        <option selected>[Seleccionar]
                                        @if(isset($ubigeo))
                                            @foreach(\DB::table('ubigeo')->where(['flag' => 'P','coddep' =>
                                            $ubigeo[0]->coddep])->get() as $dep)
                                                <option value="{{ $dep->codprov }}" data-depa="{{ $dep->coddep }}">
                                                    {{ $dep->nmbubigeo }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="city_invoice" class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Distrito</font>
                                        </font>
                                    </label>
                                    <select id="distrito" class="form-control" required name="distrito">
                                        <option selected>[Seleccionar]
                                        @if(isset($ubigeo))
                                            @foreach(\DB::table('ubigeo')->where(['flag' => 'T','coddep' =>
                                            $ubigeo[0]->coddep, 'codprov' => $ubigeo[1]->codprov])->get() as $dep)
                                                <option value="{{ $dep->coddist }}">{{ $dep->nmbubigeo }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="phonenumber_invoice" class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Número de teléfono</font>
                                        </font>
                                    </label>
                                    
                                    <input name="phonenumber_invoice" 
                                        id="telefono"  class="form-control" type="number" min="1"  pattern="[0-9]{5,9}" required>
                                </div>

                                <div class="col-md-6 form-group align-self-end ">
                                    <label for="phonenumber_invoice" class="form-label">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Legal</font>
                                        </font>
                                    </label>
                                    <div class="mb-1 mt-1">
                                        <!-- <input type="checkbox" class="custom-control-input" name="check" id="check"> -->
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" id="check" type="checkbox" name="check" >
                                                        <label class="custom-control-label" for="check">
                                                        Acepto los terminos y condiciones
                                                        </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <a class="btn" id="myBtnModal" style="padding:.0rem .0rem;">(ver)</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ventana Modal -->
                                <div id="myModal" class="modalVentana">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                    <span class="closeModal ml-auto">&times;</span>
                                    <h3 class="mx-auto">Terminos y condiciones</h3>
                                    <br>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus eaque, fuga temporibus sequi magnam atque dolores placeat libero quasi tempore voluptates aliquid nobis dolore aperiam tempora ullam neque doloremque vero?</p>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia veritatis rem magnam temporibus suscipit aspernatur odio laboriosam nobis quasi animi alias corporis, consectetur accusamus facere, odit, distinctio aliquid voluptate quam!</p>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">

                               <a class="btn btn-link text-muted" href="{{route('cart')}}">
                                    <i class="icofont-simple-left"></i>
                                    Atrás
                               </a>
                            
                                <button typeof="button" class="btn btn-dark" id="checkout-btn">
                                    Realizar compra
                                    <i class="mt-2 icofont-simple-right"></i>
                                </button>
                        </div>
                     </form> 
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
                                    <strong>S/.<span id="envioDelivery">0.00</span></strong>
                                </li> 

                                  <li class="order-summary-item border-0" id="product-description">
                                    <span>Total a pagar</span>
                                    <strong class="order-summary-total">S/.<span id="quantity-total">{{number_format(Cart::getSubtotal(), 2)}}</span></strong>
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
    <script src="{{ asset('front/js/modal.js?v=311091.33') }}"></script>
    <script>
        getPrecioDeEnvio = (departamento) => {
            let aux = $("#quantity").text();
            // let monto_aux = aux.replace('S/.\n', '');
            var monto = parseInt(aux);

            if(monto < 300){
                let envio = "8.00"
                let total = monto + 8;
                if(departamento != 15){
                    envio = "15.00";
                    total = monto + 15;
                }

                $("#envioDelivery").text(envio);
                $("#quantity-total").text(total.toFixed(2));
            }
        }
    </script>


@endsection
