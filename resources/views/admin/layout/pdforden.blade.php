<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ORDEN N° {{ $servicio->orden }}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <style type="text/css" media="all">
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #5D6975;
      text-decoration: underline;
    }

    body {
      position: relative;
      margin: 0 auto;
      color: #001028;
      background: #FFFFFF;
      font-family: Nunito, sans-serif;
      font-size: 12px;
      /* font-family: nUNTI; */
      /* padding: 0; */
    }

    header {
      padding: 10px 0;
      margin-bottom: 30px;
      width: 100%;
    }

    #logo {
      text-align: center;
      margin-bottom: 10px;
    }

    #logo img {
      width: 190px;
    }

    h2 {
      border-top: 1px solid #5D6975;
      border-bottom: 1px solid #5D6975;
      color: #5D6975;
      /* font-size: 2.4em; */
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 20px 0;
      background: url(/images/dimension.png);
    }

    #project {
      float: right;
    }

    #project span {
      color: #5D6975;
      text-align: left;
      width: 52px;
      margin-right: 40px;
      display: inline-block;
      font-size: 0.8em;
    }

    #company {
      float: right;
      text-align: left;
    }

    #project {
      float: left;
    }

    #project div,
    #company div {
      white-space: nowrap;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
      position: relative;

    }

    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }

    table th,
    table td {
      text-align: center;
    }

    table th {
      padding: 5px 0px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table .service,
    table .desc {
      text-align: left;
    }

    table td {
      /* padding: 10px; */
      text-align: right;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.2em;
    }

    table td.grand {
      border-top: 1px solid #5D6975;
      ;
    }

    #notices .notice {
      color: #5D6975;
      font-size: 1.2em;
      /* height: 220px; */
      padding-bottom: 10rem;
      /* position: absolute; */
    }

    footer {
      color: #5D6975;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
    }

    /* #logo {
      background: url(/images/logo.png);
      background-repeat: no-repeat;
      background-size: contain;
      height: 83px;
      width: 200px;
      position: relative;
    left: 43%;
    } */
  </style>
</head>

<body>
  @php
  setlocale(LC_TIME,"es_ES");
  date_default_timezone_set('America/Lima');
  @endphp

  <header class="clearfix">
    <div id="logo">
      <img src="{{ public_path('/images/logo-josperu.svg') }}" alt="">
    </div>
    <h2>ORDEN DE SERVICIO N° {{ $servicio->orden }}</h2>
    <div id="company" class="clearfix">
      <div>JOSPERU Courier </div>
      <div>Jirón San Lino Mz 2f Lote 18A,<br /> Los Olivos, Lima – Perú</div>
      <div>(+ 51 1) 468 4626</div>
      <div><a href="mailto:atencionalcliente@josperucourier.com">atencionalcliente@josperucourier.com</a></div>

    </div>
    <div id="project">
      <div><span>REMITENTE</span> {{ $servicio->NOM_REMIT }}</div>
      <div><span>DESTINATARIO</span> {{ $servicio->destinatario }}</div>
      <div><span>DIRECCIÓN </span> {{ $servicio->DIRECCION_DESTI }}</div>
      <div><span>UBIGEO</span> {{ $servicio->ubigeo }} - {{ $ubigeo[0]->nmbubigeo.' - '.$ubigeo[1]->nmbubigeo.' - '.$ubigeo[2]->nmbubigeo }}</div>
      <div><span>F. EMISIÓN</span> {{ ($servicio->fecha_registro) }}</div>
      <span>----------------------------------------------------------------------------------------</span>
      <div><span>TIPO DE SERVICIO</span>  {{ ($servicio->TIPO_SERVICIO == 1) ? 'Regular' : 'Urgente' }}</div>
      <div><span>TIPO DE ENVIO</span> {{ ($servicio->TIPO_DESTINO == 1) ? 'Local' : 'Nacional' }}</div>
      <div><span>PRESENTACIÓN</span> {{ ($servicio->TIPO_PRESENTACION == 1) ? 'Sobres' : 'Caja' }}</div>
      <div><span>FORMA DE PAGO</span> {{ ($servicio->TIPO_PAGO == 1) ? 'Contado' : 'Crédito' }}</div>
      <div><span>TIPO DE CLIENTE</span> {{ ($servicio->TIPO_CLIENTE == 1) ? 'Natural' : 'Jurídico' }}</div>

    </div>  

  </header>
  <main>


    <table width="100%">
      <thead>
        <tr>
          <th class="service">CODIGO/UBICACIÓN</th>
          <th class="desc">DESCRIPCIÓN</th>
          <th>CANTIDAD</th>
          <th>UNIDAD</th>
        </tr>
      </thead>
      <tbody>
        @if(!empty($ordenes))
        @foreach($ordenes as $orden)
        <tr>
          <td class="service">COD-{{ $orden->ID }}</td>
          <td class="desc">{{ $orden->CONTENIDO }}</td>
          <td class="unit">{{ $orden->CANTIDAD }}</td>
          <td class="qty">1</td>
        </tr>

        @endforeach
        @endif


        <tr>

        </tr>
      </tbody>
    </table>
    <div id="notices">
      <div>Observaciones adicionales:</div>
    </div>

    <div id="projects" style="padding-top:10rem">
      <span>-------------------------------------------------------------------</span>
      <div> Nombres y Firma del cliente</div>

    </div>

  </main>
  <footer>
    JOSPERU Courier - Jirón San Lino Mz 2f Lote 18A - Los Olivos, Lima – Perú
  </footer>


</body>

</html>