<form class="modal fade" @submit.prevent='editar()' id="ver" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle de la factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-center">Numero de factura: @{{ver_detalle.num_factura}}</h6 class="text-center">

                    </div>
                    <div class="form-group col-md-12 table-reponsive">
                        <table class="table col-md-12">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                                {{-- @{{l}} --}}
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in ver_detalle.detalles">
                                    <td>@{{index+1}}</td>
                                    <td>
                                        <span v-for='(value,i) in ver_detalle.productos'>
                                            <span v-if='item.producto_id == value.id'>
                                                @{{value.nombre}}
                                            </span>
                                        </span>

                                    </td>
                                    <td>@{{item.precio}}</td>
                                    <td>@{{item.cantidad}}</td>
                                    <td>@{{item.cantidad * item.precio}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5><strong>Total: @{{ver_detalle.total_venta}}</strong></h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary"  @click.prevent="pdf(ver_detalle.id)" >Generar factura</a>
            </div>
        </div>
    </div>
</form>