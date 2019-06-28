<form class="modal fade" @submit.prevent='crear()' id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text" required v-model='nuevo_producto.nombre' id="nombre"  class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="precio">Precio de venta <span class="text-danger">*</span></label>
                        <input type="text" v-model='nuevo_producto.precio_venta' required id="precio" class="form-control" placeholder="">
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
