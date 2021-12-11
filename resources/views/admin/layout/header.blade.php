<div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">

    <a class="navbar-brand" href="/admin">
         <img alt="Pipeline" src="{{asset('assets/img/logo.svg')}}" width="100%"/>
        <p class="mt-4" style="margin:0"><small>Bienvenido : </br>
        <p style="font-size:12px;margin: -7px 1px 0px 0px;padding: 0;position: absolute;">{{ Auth::user()->name }} </p></small></p>

    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
                aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-block d-lg-none ml-2">
            <div class="dropdown">
                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img alt="Image" src="assets/img/avatar-male-4.jpg" class="avatar"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="nav-side-user.html" class="dropdown-item">Perfil</a>
                    <a href="#" class="dropdown-item">Cerrar sesion</a>
                </div>
            </div>
        </div>
    </div>
    <div class="collapse navbar-collapse flex-column" id="navbar-collapse">
        <ul class="navbar-nav d-lg-block">
            <li class="nav-item">
                <a class="nav-link" href="/admin">Inicio</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2"
                   aria-controls="submenu-2">Colecciones</a>
                <div id="submenu-2" class="collapse">
                    <ul class="nav nav-small flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formColeccion') }}">Nueva colección</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('allColecciones') }}">Todas las coleciones</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3"
                   aria-controls="submenu-2">Categorias</a>
                <div id="submenu-3" class="collapse">
                    <ul class="nav nav-small flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formCategoria') }}">Nueva categoría</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('allCategorias') }}">Todas las categorias</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4"
                   aria-controls="submenu-4">Productos</a>
                <div id="submenu-4" class="collapse">
                    <ul class="nav nav-small flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formProducto') }}">Nuevo Producto</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('allProductos') }}">Todos los productos</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5"
                   aria-controls="submenu-5">Tallas</a>
                <div id="submenu-5" class="collapse">
                    <ul class="nav nav-small flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formTalla') }}">Nueva talla</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('allTalla') }}">Todas las tallas</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6"
                   aria-controls="submenu-6">Colores</a>
                <div id="submenu-6" class="collapse">
                    <ul class="nav nav-small flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formColor') }}">Nuevo color</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('allColor') }}">Todos los colores</a>
                        </li>
                    </ul>
                </div>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7"
                   aria-controls="submenu-7">Ventas</a>
                <div id="submenu-7" class="collapse">
                    <ul class="nav nav-small flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('verVenta') }}">Todas las ventas</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <hr>
        <div>
            <div class="dropdown mt-2">
                <button class="btn btn-light  btn-block dropdown-toggle" type="button" id="newContentButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    AGREGAR NUEVO
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('formProducto') }}">Producto</a>
                    <a class="dropdown-item" href="{{ route('formCategoria') }}">Categoria</a>
                    <a class="dropdown-item" href="{{ route('formColeccion') }}">Colección</a>

                    <a class="dropdown-item" href="{{ route('formCategoria') }}">Talla</a>
                    <a class="dropdown-item" href="{{ route('formCategoria') }}">Color</a>
                </div>
            </div>
        </div>

    </div>
    <div class="d-none d-lg-block">
        <div class="dropup">
            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img alt="Image" src="/assets/img/avatar-male-4.jpg" class="avatar"/>
            </a>
            <div class="dropdown-menu">
                @if(Auth::user()->perfil == 1)
                    <a href="{{ route('register') }}" class="dropdown-item">Agregar Usuario</a>
                @endif
                <a href="{{ route('logout') }}" class="dropdown-item">Cerrar session</a>
            </div>
        </div>
    </div>

</div>
