<form class="modal fade" @submit.prevent='crear()' id="crearProductoModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title text-center">Información del proveedor</h5>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="identificacion">Identificación <span class="text-danger">*</span></label>
                        <input type="number" required id="identificacion"
                            v-model="nuevo_producto.proveedor.identificacion" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nombres">Nombres <span class="text-danger">*</span></label>
                        <input type="text" required id="nombres" v-model="nuevo_producto.proveedor.nombres"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellidos">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" required id="apellidos" v-model="nuevo_producto.proveedor.apellidos"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefono">Teléfono</label>
                        <input type="number" id="telefono" v-model="nuevo_producto.proveedor.telefono"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="correo">Correo eléctronico</label>
                        <input type="email" id="correo" v-model="nuevo_producto.proveedor.correo" class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" v-model="nuevo_producto.proveedor.direccion"
                            class="form-control" placeholder="">
                    </div>
                </div>
                <h5 class="card-title text-center">Información del producto</h5>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="nombre_producto">Producto <span class="text-danger">*</span></label>
                        <v-select placeholder="Seleccione un producto" :options="viewProductos"
                            v-model='nuevo_producto.producto' label="nombre">
                            <span slot="no-options">
                                No hay productos..
                            </span>
                        </v-select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_lote">Número de lote <span class="text-danger">*</span></label>
                        <input type="text" required id="num_lote" v-model='nuevo_producto.num_lote' class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="precio">Precio <span class="text-danger">*</span></label>
                        <input type="text" required id="precio" v-model='nuevo_producto.precio' class="form-control"
                            placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cantidad">Cantidad proveída <span class="text-danger">*</span></label>
                        <input type="number" required id="cantidad" v-model='nuevo_producto.cantidad'
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_vencimiento">Fecha de vencimiento <span class="text-danger">*</span></label>
                        <input type="date" required id="fecha_vencimiento" v-model='nuevo_producto.fecha'
                            class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</form>