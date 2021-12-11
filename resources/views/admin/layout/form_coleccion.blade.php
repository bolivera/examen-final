@extends('admin.app')

@section('content')
    <div class="layout layout-nav-side">
        {!! $header !!}

        <div class="main-container">
            <div class="navbar bg-white breadcrumb-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{route('allColecciones')}}">Lista de colecciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nueva colección</li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="row justify-content-center" id="colecciones">
                    <div class="col-lg-12 col-xl-12">
                        <section class="py-4 py-lg-3">
                            <h3 class="display-5 mb-2 mt-1"> {{ (!empty($coleccion->id)) ? 'Actualizar - '.$coleccion->titulo : 'Nueva colección' }}</h3>
                            <div class="d-flex card p-4">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" role="tabpanel"
                                         data-filter-list="content-list-body">
                                        <form class="col-md-12 form-row">
                                            <div class="form-group col-md-12">
                                                <label for="direccion">Título</label>
                                                <input type="text" class="form-control"
                                                       value="{{ (!empty($coleccion->titulo)) ? $coleccion->titulo : '' }}"
                                                       id="titulo" placeholder="Título de colección">
                                            </div>
                                            <div class="form-group col-md-12" id="search">
                                                <label for="txt_search">Descripción</label>
                                                <textarea class="form-control" value="" id="descripcion"
                                                          placeholder="Ingrese descripción de colección">{{ (!empty($coleccion->descripcion)) ? $coleccion->descripcion : '' }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="fileadjunto">Adjuntar documento</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                       id="fileadjunto"
                                                >
                                                <h4 class="cargando text-info">Subiendo imagen ...</h4>

                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="fileadjunto">Documento adjunto</label>
                                                <div class="row" id="fileadjunto_list">
                                                    @isset($imagenes)
                                                        @foreach($imagenes as $imagen)
                                                            <div class="col-md-6 image" id="img_{{$imagen['id']}}"
                                                                 data-id="{{$imagen['id']}}"
                                                                 data-name="{{$imagen['name']}}">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="dropdown card-options">
                                                                            <button class="btn-options" type="button"
                                                                                    data-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false"><i
                                                                                    class="material-icons">more_vert</i>
                                                                            </button>
                                                                            <div
                                                                                class="dropdown-menu dropdown-menu-right"
                                                                                style=""><a href="javascript:void(0)"
                                                                                            class="dropdown-item text-danger delete"
                                                                                            data-id="{{$imagen['id']}}"
                                                                                            data-name="{{$imagen['name']}}">Eliminar</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-title">
                                                                            <a href="#">
                                                                                <h5 class="H5-filter-by-text">
                                                                                    <img
                                                                                        src="{{$imagen['urlCompleta']}}"
                                                                                        width="100%"></h5></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endisset
                                                </div>
                                            </div>
                                        </form>

                                        <fieldset class="border p-2 ">
                                            <legend class="w-auto "><small> <strong> Lista de productos </strong>
                                                </small></legend>
                                            <div class="row">

                                                <div class="col-md-10 ">
                                                    @if(!empty($orden->orde))
                                                        <div id="spinner">
                                                            <div class="d-flex justify-content-center">
                                                                <div class="spinner-grow text-primary"
                                                                     style="width: 3rem; height: 3rem;" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div id="listColeccions">
                                                        <div class="card-list">
                                                            <div class="card-list-head">
                                                                <h6>Productos seleccionados</h6>
                                                            </div>
                                                            <div id="listColeccion" class="row">
                                                                @isset($listProductos)
                                                                    @foreach($listProductos as $prod)
                                                                        <div class="card card-task col-md-6 productos" id="listSeleccionado_{{$prod['id']}}" data-id="{{$prod['id']}}">
                                                                            <div class="card-body">
                                                                                <div class="card-title">
                                                                                    <a href="javascript:void(0)">
                                                                                        <h6  data-filter-by="text">
                                                                                            {{$prod['titulo']}}</h6>
                                                                                    </a>
                                                                                    <span class="text-small">{{ $prod['categoria']  }}</span>
                                                                                </div>
                                                                                <div class="card-meta">
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <button type="button"
                                                                                                class="btn btn-sm btn-danger delete" data-id="{{$prod['id']}}">
                                                                                            <i
                                                                                                class="icofont-close"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <button type="button" class="btn btn-outline-info"
                                                            data-toggle="modal"
                                                            data-backdrop="static"
                                                            data-target="#AddProducto">
                                                        <span> + Agregar</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </fieldset>
                                    </div>
                                    <div class="tab-pane fade" id="members" role="tabpanel"
                                         data-filter-list="content-list-body">
                                        <fieldset class="border">
                                            <legend class="w-auto"><small> <strong> Datos de entrega de
                                                        producto </strong> </small></legend>
                                            <form class="col-md-12 form-row">
                                                <div class="form-group col-md-6" id="search">
                                                    <label for="txt_search">Observaciones</label>
                                                    <textarea class="form-control" value="" id="observaciones"
                                                              placeholder="Ingrese observaciones adicionales si es necesario">{{ (!empty($orden->OBSERVACIONES)) ? $orden->OBSERVACIONES : '' }}</textarea>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="fileadjunto">Adjuntar documento</label>
                                                    <input type="file" class="form-control" id="fileadjunto"
                                                           data-file="{{ !empty($orden->file) ? $orden->file : '' }}">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="fileadjunto">Documento adjunto</label>
                                                    @if(!empty($orden->file))
                                                        <a class="btn btn-primary"
                                                           href="/uploads/orden/{{ $orden->file}}" id="blah-fileadjunto"
                                                           target="_blank" rel="noopener noreferrer">Ver file</a>
                                                    @else
                                                        <a class="btn btn-primary disabled" href="http://"
                                                           id="blah-fileadjunto" target="_blank"
                                                           rel="noopener noreferrer">Ver file</a>
                                                    @endif
                                                </div>
                                            </form>
                                        </fieldset>

                                    </div>
                                    <div class="row justify-content-end  p-2">
                                        <button type="button" class="btn btn-primary guardar"
                                                data-id="{{ !empty($coleccion) ? $coleccion->id : '0' }}"
                                                data-status="{{ !empty($orden) ? 'edit' : 'new' }}"><i
                                                class="icofont-save"></i> {{ !empty($orden) ? 'ACTUALIZAR' : 'GENERAR  ' }}
                                            COLECCIÓN
                                        </button>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="AddProducto" tabindex="-1" role="dialog" aria-labelledby="AddProductoLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buscar productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="search">
                    <div class="col-md-12 form-row">
                        <div class="form-group col-md-12">
                            <label for="contenidocaja">Contendido de caja</label>
                            <input id="txt_search" type="text"
                                   value="{{ (!empty($orden->CONTENIDO)) ? $orden->CONTENIDO : '' }}"
                                   class="form-control" id="contenidocaja" placeholder="Escribe aquí y presiona Enter">
                        </div>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Título</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Accción</th>
                            </tr>
                            </thead>
                            <tbody id="listProductos">
                            @foreach($productos as $producto)
                                <tr id="producto_{{$producto->id}}">
                                    <th scope="row">1</th>
                                    <td>{{$producto->titulo}}</td>
                                    <td>{{$producto->categoria($producto->idCategoria)->nombre}}</td>
                                    <td>
                                        <button data-id="{{$producto->id}}"
                                                class="btn btn-outline-info btn-sm seleccionar"><i
                                                class="icofont-checked"></i>
                                            Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


@endsection
