@extends('layouts.app')
@section('header')
    {!! $header !!}
@endsection
@section('content')

    <main>
        <section class="hero">
            <div class="container">
                <nav class="" aria-label="migaja de pan">
                    <ol class="breadcrumb justify-content-center no-border mb-0">
                        <li class="breadcrumb-item"><a class="" href="/"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Hogar</font></font></a></li>
                        <li class="active breadcrumb-item" aria-current="page"><span class=""><font
                                    style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Tus ordenes</font></font></span></li>
                    </ol>
                </nav>
                <div class="hero-content pb-5 text-center"><h1 class="mb-5"><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Tus ordenes</font></font></h1>
                    <div class="row">
                        <div class="mx-auto col-xl-8"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">Tus pedidos en un solo lugar.</font></font></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9">
                    <div class="table-responsive">
                        <table class="table-responsive-md table table-borderless table-hover">
                            <thead class="bg-light">
                            <tr>
                                <th class="py-4 text-uppercase text-sm"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">Pedido #</font></font></th>
                                <th class="py-4 text-uppercase text-sm"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">Fecha</font></font></th>
                                <th class="py-4 text-uppercase text-sm"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">Total</font></font></th>
                                <th class="py-4 text-uppercase text-sm"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">Estado</font></font></th>
                                <th class="py-4 text-uppercase text-sm"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">Acción</font></font></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class="py-4 align-middle"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">N.º 1735</font></font></th>
                                <td class="py-4 align-middle"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">22/6/2017</font></font></td>
                                <td class="py-4 align-middle"><font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit;">$ 150,00</font></font></td>
                                <td class="py-4 align-middle"><span class="p-2 text-uppercase badge badge-info"><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Estar preparado</font></font></span>
                                </td>
                                <td class="py-4 align-middle"><a class="btn btn-outline-dark btn-sm"
                                                                 href="/customer-order"><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vista</font></font></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mb-5 col-lg-4 col-xl-3">
                   @include('pages.customer')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('footer')
    {!! $footer !!}
@endsection
