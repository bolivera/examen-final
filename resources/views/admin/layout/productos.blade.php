@extends('admin.app')

@section('content')
    <div class="layout layout-nav-side">
        {!! $header !!}
        <div class="main-container">
            <div class="navbar bg-white breadcrumb-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Productos</li>
                    </ol>
                </nav>
            </div>

            <div class="container">
                <section class="mt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="card-title h6 text-center btn btn-outline-info"
                               href="{{ route('formProducto')}}"> <i class="icofont-ui-add"></i> NUEVO PRODUCTO</a>
                        </div>
                    </div>
                </section>

                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">

                        <section class="py-4 py-lg-3">
                            <h3 class="display-5 mb-2 mt-1">Lista de productos</h3>
                            <div class="d-flex card p-4">
                                <table class="table table-borderless" id="productos">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">titulo</th>
                                        <th scope="col">Categoría</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($productos)
                                        @foreach($productos as $producto)
                                            <tr>
                                                <th scope="row">{{ $loop->index+1 }}</th>
                                                <td>{{ $producto->titulo  }}</td>
                                                <td>{{ $producto->categoria($producto->idCategoria)->nombre }}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger eliminar"
                                                            data-id="{{ $producto->id }}">
                                                        <i class="icofont-ui-delete"></i> Eliminar
                                                    </button>
                                                    <a href="{{route('editarProducto',$producto->id)}}"
                                                       class="btn btn-sm btn-warning">
                                                        <i class="icofont-edit"></i>
                                                        Editar
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset

                                    </tbody>
                                </table>
                                {{$productos->links()}}
                            </div>
                        </section>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
