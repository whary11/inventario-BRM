@extends('layouts')

@section('contenido')
<main id="producto_proveedor">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center card-title">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#crearProductoModal">
                               Proveer Nuevo producto
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tablaProducto">
                                <thead>
                                    <th>#</th>
                                    <th>Proveedor</th>
                                    <th>Nombre del producto</th>
                                    <th>Número de lote</th>
                                    <th>Cantidad proveída</th>
                                    <th>Precio de compra</th>
                                    <th>Opciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- modales --}}
    @include('modales.crearProducto_proveedor')
    @include('modales.editarProducto_proveedor')
    {{-- script --}}
    @section('script')
        
        <script src="{{ asset('js/producto_proveedor.js') }}"></script>
        
    @endsection
</main>


@endsection