@extends('layouts')

@section('contenido')
<div class="container mt-2" id="comprar" v-cloak>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form class="card" @submit.prevent='setFactura()'>
                <div class="card-header">
                    <h4 class="text-center">Facturación</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Información del cliente</h5>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="identificacion">Identificación <span class="text-danger">*</span></label>
                            <input type="number" v-model='compra.cliente.identificacion' required id="identificacion" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombres">Nombres <span class="text-danger">*</span></label>
                            <input type="text"  v-model='compra.cliente.nombres' required id="nombres" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="apellidos">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" v-model='compra.cliente.apellidos' required id="apellidos" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefono">Teléfono</label>
                            <input type="number"  v-model='compra.cliente.telefono' id="telefono" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="correo">Correo eléctronico</label>
                            <input type="email"  v-model='compra.cliente.correo' id="correo" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="direccion">Dirección</label>
                            <input type="text"  v-model='compra.cliente.direccion' id="direccion" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-12">
                            <h5 class="card-title text-center">Información del producto</h5>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="direccion">Producto</label>
                            <v-select  placeholder="Seleccione un producto" :options="viewProductos" v-model='compra.producto'
                            label="nombre">
                           <span slot="no-options">
                               No hay productos..
                           </span>
                       </v-select>
                       <p v-if='compra.producto != null && compra.producto.stock' class="text-success" > <blockquote> @{{compra.producto.stock}} </blockquote> productos en stock</p>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="direccion">Cantidad</label>
                            <input type="number" v-model='compra.cantidad' id="direccion" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4 mt-4">
                            <button class="btn btn-success" @click.prevent='añadir()'>Añadir a la bolsa</button>
                        </div>
                    </div>
                    <div v-if='detalle.length > 0'>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Sub total</th>
                                        <th>Opciones</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <tr v-for='(value,index) in detalle'>
                                    <td>@{{index+1}}</td>
                                    <td>@{{value.producto.nombre}}</td>
                                    <td>@{{value.producto.precio_venta}}</td>
                                    <td>@{{value.cantidad}}</td>
                                    <td>@{{value.producto.precio_venta * value.cantidad}}</td>
                                    <td><a href='#' class="btn btn-danger" @click='eliminar(index)'>Eliminar</a></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total: @{{total_compra}}</td>
                                    <td></td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-center"> <button type="submit" class="btn btn-primary">Finalizar compra</button></h5>
                            </div>
                        </div>
                       
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')        
<script src="{{ asset('js/comprar.js') }}"></script>
@endsection
@endsection

<style>
    [v-cloak]{
        display: none;
    }

</style>