<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CLIENTES</title>
    <style>
        #cell {
            background-color: #000000;
            color: #ffffff;
        }


        .cell {
            background-color: #000000;
            color: #ffffff;
        }

        tr td {
            background-color: #ffffff;
        }

        tr>td {
            border-bottom: 1px solid #000000;
        }
    </style>
</head>

<body>
    <h1>LISTA DE CLIENTES</h1>
    <table>

        <thead>
            <tr style="background-color: #000;">
                <th>NOMBRES Y APELLIDOS</th>
                <th>DNI/RUC</th>
                <th>CELULAR / FIJO</th>
                <th>DIRECCIÓN</th>
                <th>UBIGEO</th>
                <th>DEPARTAMENTO</th>
                <th>PROVINCIA</th>
                <th>DISTRITO</th>
                <th>FECHA DE REGISTRO</th>
                <th>TIPO DE CLIENTE</th>
           </tr>
        </thead>
        <tbody>
            @if(!empty($clientes))
            @foreach($clientes as $reporte)
            <tr bgcolor="RGB(217,225,242,0)">
                <td>{{$reporte->NOM_APEL}}</td>
                <td>{{$reporte->DNI}}</td>
                <td>{{$reporte->CELULAR}}</td>
                <td>{{$reporte->DIRECCION}}</td>
                <td>{{$reporte->UBIGEO}}</td>
                <td>{{$reporte->departamento}}</td>
                <td>{{$reporte->provincia}}</td>
                <td>{{$reporte->distrito}}</td>
                <td>{{$reporte->updated_at}}</td>
                <td>{{$reporte->TIPO_CLIENTE}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

</body>

</html>