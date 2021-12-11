@extends('admin.app')

@section('content')
<div class="layout layout-nav-side">
    {!! $header !!}
    <div class="main-container">
        <div class="navbar bg-white breadcrumb-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('allProductos')}}">Lista de productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo producto</li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-xl-12">
                    <section class="py-4 py-lg-3">
                        <h3 class="display-5 mb-2 mt-1">
                            {{ (!empty($producto)) ? 'Actualizar producto '  . $producto->titulo : 'Agregar nuevo producto'}}
                        </h3>
                        <div class="d-flex card p-4">
                            <fieldset class="border p-2">
                                <legend class="w-auto"><small> <strong> Datos </strong> </small></legend>
                                <div class="col-md-12 form-row  form" id="producto" data-method="POST"
                                    data-action="{{ route('saveProducto') }}">

                                    <div class="form-group col-md-6">
                                        <label for="titulo">Titulo del producto</label>
                                        <input type="text" name="titlo"
                                            value="{{ isset($producto->titulo) ? $producto->titulo : '' }}"
                                            class="form-control" id="titulo" placeholder="Nombre del producto" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="categoria">Categoría</label>
                                        <select id="categoria" class="form-control" name="categoria" required>
                                            <option value="" selected>[Categoría]</option>
                                            @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}"
                                                {{(isset($producto) && ($producto->idCategoria ==  $categoria->id)) ? 'selected' : '' }}>
                                                {{$categoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 " id="search">
                                        <label for="txt_search">Tipo de entrega</label>
                                        <div class="custom-control custom-checkbox col-md-auto">
                                            <input type="checkbox"
                                                {{(isset($producto) && ($producto->despachoDomicilio ==  1)) ? 'checked' : '' }}
                                                id="tipoEntregaDomicilio" name="tipoEntregaDomicilio"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="tipoEntregaDomicilio"></label>
                                            <span>Despacho a domicilio</span>
                                        </div>
                                        <div class="custom-control custom-checkbox col-md-auto">
                                            <input type="checkbox"
                                                {{(isset($producto) && ($producto->despachoTienda ==  1)) ? 'checked' : '' }}
                                                id="DespachoTienda" name="DespachoTienda" class="custom-control-input">
                                            <label class="custom-control-label" for="DespachoTienda"></label>
                                            <span>Retiro en tienda</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9 row">
                                        <div class="form-group col-md-7">
                                            <label for="descripcion">Descripción rápida</label><br>
                                            <textarea name="shortext" id="descripcion" class="form-control "
                                                cols="10" rows="2"
                                                placeholder="Resumen breve del producto">{{ isset($producto->Descripcion) ? $producto->Descripcion : '' }}</textarea>
                                            <small> <b> Máximo 120 letras </b></small>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="precio">Precio</label>
                                            <input type="number" id="precio" name="precio" class="form-control "
                                                placeholder="ejm: 10.00"
                                                value="{{ isset($producto->precio) ? $producto->precio : '' }}" required
                                                data-role="tagsinput">
                                            <small>Debe incluir tu IGV + Comisión de pasarela</small>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="descripcionCompleta">Descripción completa</label>
                                            <textarea type="text" name="descripcionCompleta" class="form-control tallas tinymce"
                                                id="descripcionCompleta" placeholder="ejm: cazuales,cuero" required
                                                data-role="tagsinput">{{ isset($producto->descripcionCompleta) ? $producto->descripcionCompleta : '' }}</textarea>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="tagsinput">Tags</label>
                                            <input type="text" name="tags" class="form-control tallas" id="tags"
                                                placeholder="ejm: cazuales,cuero"
                                                value="{{ isset($producto->tags) ? $producto->tags : '' }}" required
                                                data-role="tagsinput">
                                        </div>
                                    </div>

                                    <div class="col-md-3 row">
                                        <div class="form-group col">
                                            <label for="tallas">Tallas</label>
                                            @foreach($tallas as $i => $item)
                                            <div class="custom-control  form-check  custom-checkbox form-switch">
                                                <input type="checkbox"
                                                    {{(isset($producto) && ($item->id ==  CodebelHelpers::getTalla($producto->tallas, $item->id))) ? 'checked' : '' }}
                                                    id="tallas__{{$i}}" name="tallaId[]" value="{{$item->id}}"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="tallas__{{$i}}"></label>
                                                <span>{{$item->medida}}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="colores">Colores</label>

                                            @foreach($colores as $i => $color)
                                            <div class="custom-control form-check  custom-checkbox">
                                                <input type="checkbox"
                                                    {{(isset($producto) && ($color->id ==  CodebelHelpers::getColor($producto->colores, $color->id))) ? 'checked' : '' }}
                                                    id="colores__{{$i}}" name="coloresId[]" value="{{$color->id}}"
                                                    class="custom-control-input">

                                                <label class="custom-control-label" for="colores__{{$i}}"></label>
                                                <span>{{$color->nombre}}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="imagenes">Galería de imágenes</label>
                                        <input type="file" name="imagen" id="fileGaleria" accept="image/*">
                                        <h4 class="cargando text-info">Subiendo imagen ...</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="list-imagenes content-list-body">
                                            <div class="list-group-activity dropzone-previews content-list-body row"
                                                id="fileGaleria_list">
                                                @isset($imagenes)
                                                @foreach($imagenes as $imagen)
                                                <div class="col-md-3 image" id="img_{{$imagen['id']}}"
                                                    data-id="{{$imagen['id']}}" data-name="{{$imagen['name']}}">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="dropdown card-options">
                                                                <button class="btn-options" type="button"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"><i
                                                                        class="material-icons">more_vert</i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                                    <a href="javascript:void(0)"
                                                                        class="dropdown-item text-danger delete"
                                                                        data-id="{{$imagen['id']}}"
                                                                        data-name="{{$imagen['name']}}">Eliminar</a>
                                                                </div>
                                                            </div>
                                                            <div class="card-title">
                                                                <a href="#">
                                                                    <h5 class="H5-filter-by-text"><img
                                                                            src="{{$imagen['urlCompleta']}}"
                                                                            width="100%"></h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary guardar btn-block"
                                        data-id="{{isset($producto->id) ? $producto->id : '0'}}"> GUARDAR
                                        PRODUCTO
                                    </button>
                                </div>
                            </fieldset>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script src="{{asset('assets/editor/tinymce.min.js')}}"></script>

<script>
$(document).ready(function() {
    $('#multiTallas').tokenize2({
        dataSource: 'select'
    });
})
tinymce.init({
    selector: '.tinymce',
    height: 120,
    menubar: false,
    theme: 'modern',
    mobile: {
        theme: 'mobile',
        plugins: ['autosave', 'lists', 'autolink']
    },
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'bold underline italic | bullist numlist | alignleft aligncenter alignright alignjustify | link',
});
</script>
@endsection