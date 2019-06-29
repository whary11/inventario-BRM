<form class="modal fade" @submit.prevent='editar()' id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <h5 class="card-title text-center">Información del proveedor</h5>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="identificacion">Identificación <span class="text-danger">*</span></label>
                        <input type="number" required id="identificacion" v-model="editar_producto.proveedor.identificacion" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nombres">Nombres <span class="text-danger">*</span></label>
                        <input type="text" required id="nombres" v-model="editar_producto.proveedor.nombres" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellidos">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" required id="apellidos" v-model="editar_producto.proveedor.apellidos" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefono">Teléfono</label>
                        <input type="number" id="telefono" v-model="editar_producto.proveedor.telefono" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="correo">Correo eléctronico</label>
                        <input type="email" id="correo" v-model="editar_producto.proveedor.correo" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" v-model="editar_producto.proveedor.direccion" class="form-control" placeholder="">
                    </div>
                </div>
                <h5 class="card-title text-center">Información del producto</h5>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="num_lote">Producto <span class="text-danger">*</span></label>
                        <v-select disabled  placeholder="Seleccione un producto" :options="viewProductos" v-model='editar_producto.producto'
                        label="nombre">
                       <span slot="no-options">
                           No hay productos..
                       </span>
                   </v-select>
                        {{-- <input type="text" required id="num_lote" v-model='editar_producto.num_lote' class="form-control" placeholder=""> --}}
                    </div>
                    <div class="form-group col-md-4">
                            <label for="num_lote">Número de lote <span class="text-danger">*</span></label>
                            <input type="text" required id="num_lote" v-model='editar_producto.num_lote' class="form-control" placeholder="">
                        </div>
                    <div class="form-group col-md-4">
                        <label for="precio">Precio del producto <span class="text-danger">*</span></label>
                        <input type="text" required id="precio" v-model='editar_producto.precio' class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cantidad">Cantidad del produto <span class="text-danger">*</span></label>
                        <input type="text" disabled required id="cantidad" v-model='editar_producto.cantidad_proveida' class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_vencimiento">Fecha de vencimiento <span class="text-danger">*</span></label>
                        <input type="date" required id="fecha_vencimiento" v-model='editar_producto.fecha_vencimiento' class="form-control" placeholder="">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </div>
    </div>
</form>
