
function detalleCompraProductos(value, row, index) {
    return [
        `<a  href="javascript:void(0)"
        data-table_name="table-ventas-detalle" 
        data-id_venta="${row.id}" data-name="${row.ordenCompra}"
         data-toggle="modal" data-target="#modalDetalleProductos">`,
      'Ver 📦',
      '</a>'
    ].join('')
}

function datosExtraCompra(value, row, index) {
    return [
        `<a  href="javascript:void(0)"
        data-table_name="table-ventas-detalle" 
        data-id_venta="${row.id}" data-name="${row.ordenCompra}"
         data-toggle="modal" data-target="#modalDetalleVenta">`,
      'Ver 📋',
      '</a>'
    ].join('')
}


$('#modalDetalleProductos').on('shown.bs.modal', function (e) {
    const id_venta = $(e.relatedTarget).data('id_venta')
    const nombre_venta = $(e.relatedTarget).data('name')
    const table = $(e.relatedTarget).data('table_name')
    $('#table_name').val(table)
    $('.modalProductosTitle').text(`Productos - venta: ${nombre_venta}`)
    $('#table-ventas-productos').bootstrapTable('refresh', {
        url: `productos-ventas/${id_venta}`
    });
})

$('#modalDetalleVenta').on('shown.bs.modal', function (e) {
    const id_venta = $(e.relatedTarget).data('id_venta')
    const nombre_venta = $(e.relatedTarget).data('name')
    const table = $(e.relatedTarget).data('table_name')
    $('#table_name').val(table)
    $('.modalExtraTitle').text(`Datos del navegador - venta: ${nombre_venta}`)
    $('#table-ventas-detalle').bootstrapTable('refresh', {
        url: `extra-ventas/${id_venta}`
    });
})





