new Vue({
    el:'#producto',
    data:{
        tabla:'',
        nuevo_producto:{
            nombre:'',
            precio_venta:'',
        },

        editar_producto:{},
       
        language:{
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": ">",
                "previous": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
        
    },
    mounted(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        this.ProductoTabla()
    },
    methods:{
        ProductoTabla(){
            this.tabla=$('#tablaProducto').DataTable({
                'ajax': {
                    'method': 'GET',
                    'url': '/productos/getproducto',
                },
                columns: [{
                        defaultContent: '1'
                    },
                    {
                        data: 'nombre'
                    },
                    
                    {
                        data: 'precio_venta'
                    },
                    {
                        data: 'stock'
                    },
                    {
                        defaultContent: `<div class="btn-group"><button data-toggle="modal" data-target="#editar" class="editar btn btn-primary">Editar</button>`
                    },
                ],
                language: this.language
            });
            this.tabla.on('order.dt search.dt',()=> {
                this.tabla.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            let self = this
            $('#tablaProducto tbody').on('click', 'button.editar',function (d) {
                var data = self.tabla.row($(this).parents('tr')).data();
                self.editar_producto = data
                // console.log(data);
                
            });
        },
        
        
        crear(){ 
            
            

            if (Number(this.nuevo_producto.precio_venta.trim()) == NaN) {
                Swal.fire({
                    title: 'Muy bien!',
                    text: `El precio es incorrecto`,
                    type: 'error',
                    confirmButtonText: 'OK'
                })
                console.log(Number(this.nuevo_producto.precio_venta.trim()));

            }else{

                $.ajax({
                    type: "POST",
                    url: "/productos/setproducto",
                    data: this.nuevo_producto,
                    success:(response)=> {
                        console.log(response);
                        if (response.resp) {
                            $('#crear').modal('hide')
                            Swal.fire({
                                title: 'Muy bien!',
                                text: `Producto creado de manera correta`,
                                type: 'success',
                                confirmButtonText: 'OK'
                            })
                            this.tabla.ajax.reload();
                           this.nuevo_producto={}
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: `no se pudo crear el producto`,
                                type: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                        
                    }
                });
            }
            
        },
        editar(){
            $.ajax({
                type: "POST",
                url: `/productos/putproducto`,
                data: this.editar_producto,
                success:(response)=> {
                    console.log(response);
                    if (response.resp) {
                        $('#editar').modal('hide')
                        Swal.fire({
                            title: 'Muy bien!',
                            text: `Producto editado de manera correta`,
                            type: 'success',
                            confirmButtonText: 'OK'
                        })
                        this.tabla.ajax.reload();
                       this.editar_producto={}
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: `no se pudo editar el producto`,
                            type: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                    
                }
            });
        }
    }
})