@extends('layouts')

@section('contenido')

    <div class="container mt-4" id="historial">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-success">
                        <h4 class="text-center pt-2">Historial de facturas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tablaHistorial">
                                <thead>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Numero de factura</th>
                                    <th>Precio de factura</th>
                                    <th>Fecha</th>
                                    <th>Opciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('modales.verHistorial')
    </div>    
    @section('script')
    <script src="{{ asset('js/historial.js') }}"></script>
    @endsection
@endsection