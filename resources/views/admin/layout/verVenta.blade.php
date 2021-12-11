@extends('admin.app')

@section('content')
    <div class="layout layout-nav-side">
        {!! $header !!}
        <div class="main-container">
            <div class="navbar bg-white breadcrumb-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista ventas</a></li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">
                        <section class="py-4 py-lg-3">
                            <h3 class="display-5 mb-2 mt-1"></h3>
                            <div class="d-flex card p-4">
                                <fieldset class="border p-2">
                                    <legend class="w-auto"><small> <strong> Datos </strong> </small></legend>
                              
                                    <table 
                                    id="table-ventas"
                                    data-height="600"
                                    data-url="all-ventas"
                                    data-toggle="table"
                                    data-pagination="true"
                                    data-search="true"
                                    data-sort-order="desc"
                                    data-search-align="left"
                                    data-show-refresh="true"
                                    data-show-toggle="true"
                                    data-show-columns="true"
                                     >
                                     <!-- data-show-export="true"
                                    data-export-data-type="all" -->
                                    <thead>
                                        <tr>
                                        <th data-field="id">Id</th>
                                        <th data-field="ordenCompra">N° Compra</th>
                                        <th data-field="created_at">Fecha</th>
                                        <th data-field="TotalAmount">Monto total</th> 
                                        <th data-field="fullName">Cliente</th>
                                        <th data-field="email">Email</th>
                                        <th data-field="phoneNumber">Teléfono</th>
                                        <th data-field="distrito">Distrito</th>
                                        <th data-field="provincia">Provincia</th>
                                        <th data-field="departamento">Departamento</th>
                                        <th data-field="operate" data-formatter="detalleCompraProductos">Productos</th>
                                        <th data-field="operate" data-formatter="datosExtraCompra">Datos Extra</th>
                                        </tr>
                                    </thead>
                                    </table>

                                </fieldset>
                            </div>
                        </section>

                        <div class="modal fade" id="modalDetalleVenta" tabindex="-1" role="dialog" aria-labelledby="modalHistorial" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title modalExtraTitle" id="modalExtraTitle"></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <section class="creditos-empresa-container">
                                
                                <div class="creditos-reclutadores-table-historial">
                                  <table 
                                    id="table-ventas-detalle"
                                    data-height="300"
                                    data-toggle="table"
                                  >
                                    <thead>
                                        <th data-field="ipAddress">IP</th> 
                                        <th data-field="browserUserAgent">Datos navegador</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                              </section>
                            </div>

                          </div>
                        </div>
                      </div>


                      <div class="modal fade" id="modalDetalleProductos" tabindex="-1" role="dialog" aria-labelledby="modalHistorial" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title modalProductosTitle" id="modalProductosTitle"></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <section class="creditos-empresa-container">
                                
                                <div class="creditos-reclutadores-table-historial">
                                  <table 
                                    id="table-ventas-productos"
                                    data-height="300"
                                    data-toggle="table"
                                  >
                                    <thead>
                                        <th data-field="productLabel">Nombre producto</th>
                                        <th data-field="productRef">Datos</th>
                                        <th data-field="productQty">Cantidad</th>
                                        <th data-field="productAmount">Precio</th> 
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                              </section>
                            </div>

                          </div>
                        </div>
                      </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
