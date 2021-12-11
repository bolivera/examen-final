@extends('admin.app')
@section('content')
    <div class="layout layout-nav-side">
        {!! $header !!}
        <div class="main-container">
            <div class="navbar bg-white breadcrumb-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{route('allTalla')}}">Lista de Tallas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nueva Talla</li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">
                        <section class="py-4 py-lg-3">
                            <h3 class="display-5 mb-2 mt-1">{{ !empty($talla) ? 'Editar Talla' : 'Agregar Talla' }}</h3>
                            <div class="d-flex card p-4">
                                <fieldset class="border p-2">
                                    <legend class="w-auto"><small> <strong> Datos </strong> </small></legend>
                                    <form method="post"  action="{{route('saveTalla')}}" class="col-md-12 form-row talla">
                                        @csrf
                                        <input type="hidden" name="status" value="{{  !empty($talla) ? 'edit' : 'new'  }}">
                                        <input type="hidden" name="id" value="{{  !empty($talla) ? $talla->id : '0' }}">

                                        <div class="form-group col-md-12">
                                            <label for="medida">Tamaño de talla</label>
                                            <input type="text" name="medida" class="form-control" id="talla" required
                                                   value="{{ !empty($talla->medida) ? $talla->medida : '' }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <div class="justify-content-end ">
                                                <button type="submit" class="btn btn-primary save display-block"
                                                        data-status="{{ !empty($talla) ? 'edit' : 'new' }}">{{ !empty($talla) ? 'ACTUALIZAR TALLA' : 'GUARDAR TALLA' }}</button>
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
