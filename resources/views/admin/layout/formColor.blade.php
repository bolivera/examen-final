@extends('admin.app')
@section('content')
    <div class="layout layout-nav-side">
        {!! $header !!}
        <div class="main-container">
            <div class="navbar bg-white breadcrumb-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{route('allColor')}}">Lista de Color</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nuevo color</li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">
                        <section class="py-4 py-lg-3">
                            <h3 class="display-5 mb-2 mt-1">{{ !empty($color) ? 'Editar color' : 'Agregar color' }}</h3>
                            <div class="d-flex card p-4">
                                <fieldset class="border p-2">
                                    <legend class="w-auto"><small> <strong> Datos </strong> </small></legend>
                                    <form method="post"  action="{{route('saveColor')}}" class="col-md-12 form-row color">
                                        @csrf
                                        <input type="hidden" name="status" value="{{  !empty($color) ? 'edit' : 'new'  }}">
                                        <input type="hidden" name="id" value="{{  !empty($color) ? $color->id : '0' }}">

                                        <div class="form-group col-md-12">
                                            <label for="nombre">Nombre del color</label>
                                            <input type="text" name="nombre" class="form-control" id="color" required
                                                   value="{{ !empty($color->nombre) ? $color->nombre : '' }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="codigoColor">Seleccionar Color</label>
                                            <input type="color" name="codigoColor" class="form-control-color" id="codigoColor" required
                                            value="{{ !empty($color->codigo_hexa) ? $color->codigo_hexa : '#ffffff' }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <div class="justify-content-end ">
                                                <button type="submit" class="btn btn-primary save display-block"
                                                        data-status="{{ !empty($color) ? 'edit' : 'new' }}">{{ !empty($color) ? 'ACTUALIZAR COLOR' : 'GUARDAR COLOR' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
