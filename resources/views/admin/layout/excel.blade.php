<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTES JOSPERU</title>
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
    <h1>Reporte de Ordenes de Servicios</h1>
    <table>
        <thead>
            <tr style="background-color: #000;">
                <th>FECHA DE INGRESO</th>
                <th>TIPO DE SERVICIO</th>
                <th>TIPO DE DESTINO</th>
                <th>TIPO DE PRESENTACIÓN</th>
                <th>FORMA DE PAGO</th>
                <th>DELIVERY</th>
                <th>MES</th>
                <th>N° ORDEN</th>
                <th>DNI</th>
                <th>CLIENTE REMITENTE</th>
                <th>CELULAR</th>
                <th>DNI DESTINATARIO</th>
                <th>CLIENTE DESTINATARIO</th>
                <th>CELULAR</th>
                <th>DIRECCIÓN</th>
                <th>DISTRITO</th>
                <th>PROVINCIA</th>
                <th>DEPARTAMENTO</th>
                <th>UBIGEO</th>
                <th>DETALLES</th>
                <th>CONTENIDO</th>
                <th>RECAUDACIÓN</th>
                <th>ESTATUS</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($reportes))
            @foreach($reportes as $reporte)
            <tr bgcolor="RGB(217,225,242,0)">
                <td>{{$reporte->created_at}}</td>
                <td>{{$reporte->TIPO_SERVICIO}}</td>
                <td>{{$reporte->TIPO_DESTINO}}</td>
                <td>{{$reporte->TIPO_PRESENTACION}}</td>
                <td>{{$reporte->TIPO_PAGO}}</td>
                <td>{{$reporte->ENTREGA}}</td>
                <td>{{ date('M', strtotime($reporte->ENTREGA))}}</td>
                <td>{{$reporte->orden}}</td>
                <td>{{$reporte->dnicliente}}</td>
                <td>{{$reporte->namecliente}}</td>
                <td>{{$reporte->celcliente}}</td>
                <td>{{$reporte->DNI_DESTI}}</td>
                <td>{{$reporte->NOM_APP_DEST}}</td>
                <td>{{$reporte->CONTACTO_DESTI}}</td>
                <td>{{$reporte->DIRECCION_DESTI}}</td>
                <td>{{$reporte->distrito}}</td>
                <td>{{$reporte->provincia}}</td>
                <td>{{$reporte->departamento}}</td>
                <td>{{$reporte->UBIEGO_DESTI}}</td>
                <td>{{$reporte->CONTENIDO}}</td>
                <td>{{'Cantidad: '. $reporte->CANTIDAD.' Dimenciones: '.$reporte->DIMENSIONES}}</td>
                <td>{{$reporte->RECAUDACION}}</td>
                <td>{{ $reporte->ESTADO }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

</body>

</html>
