<form class="modal fade" @submit.prevent='editar()' id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text" required v-model='editar_producto.nombre' id="nombre"  class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="precio">Precio de venta <span class="text-danger">*</span></label>
                        <input type="number" v-model='editar_producto.precio_venta' required id="precio" class="form-control" placeholder="">
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
