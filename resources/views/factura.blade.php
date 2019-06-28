{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script> --}}
<table  width='100%' border="1" >
    <thead>
        <tr>
            <th>Numero de factura: {{$detalle['num_factura']}}</th>
            <th>Fecha de facturacion: {{$detalle['created_at']}}</th>
        </tr>
       
        <tr>
            <th>Nombre del cliente: {{$detalle['cliente']['nombres']}} {{$detalle['cliente']['apellidos']}}</th>
            <th>Identificación: {{$detalle['cliente']['identificacion']}}</th>
        </tr>
       
    </thead>
</table>

<table width='100%' border="1">
   <thead>
       <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
       </tr>
      
   </thead>
   <tbody>
        @foreach ($detalle['detalles'] as $item )
            <tr>
                <td>
                        @foreach ($detalle['productos'] as $producto)
                        @if ($item['producto_id'] == $producto['id'])
                        {{$producto['nombre']}}
                        @endif
                    @endforeach
                </td>
                <td>
                   
                    {{$item['precio']}}
                
                </td>
                <td>{{$item['cantidad']}}</td>
                <td>{{$item['cantidad'] * $item['precio']}}</td>
            </tr>
        @endforeach
        <tr>   
        <th colspan="4" ><h4>Total: {{$detalle['total_venta']}}</h4></th>
           </tr>
    </tbody>
</table>