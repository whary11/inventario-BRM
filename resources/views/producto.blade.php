@extends('layouts')

@section('contenido')
<main id="producto">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                <div class="card shadow-lg">
                    <div class="card-header bg-success">
                        <h4 class="text-center card-title">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#crear">
                                Nuevo producto
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tablaProducto">
                                <thead>
                                    <th>#</th>
                                    <th>Nombre del producto</th>
                                    <th>Precio de venta</th>
                                    <th>Stock</th>
                                    <th>Opciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('modales.crearProducto')
    @include('modales.editarProducto')
    @section('script')
    <script src="{{ asset('js/producto.js') }}"></script>
    @endsection
@endsection