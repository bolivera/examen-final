<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A project management Bootstrap theme by Medium Rare">
    <link href="assets/img/favicon.ico" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
    <link href="{{ asset('css/admin/theme.css?v=32') }}" rel="stylesheet" type="text/css" media="all"/>
    
    <link href="{{ asset('assets/css/admin/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
@yield('header')
@yield('content')
@yield('footer')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/theme.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/app.js?v=311091.6')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/administracion.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/bootstrap-table.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/bootstrap-table-export.js')}}"></script> 




@if(\Auth::check())
    <link href="{{ asset('css/iconos.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endif

@yield('scripts')
</body>
</html>
