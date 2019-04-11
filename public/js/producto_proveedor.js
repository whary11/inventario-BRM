new Vue({
    el: '#producto_proveedor',
    data: {
        viewProductos: [],

        tabla: '',
        nuevo_producto: {
            num_lote: '',
            producto: '',
            precio: '',
            cantidad: '',
            fecha: '',
            proveedor: {
                identificacion: '',
                nombres: '',
                apellidos: '',
                telefono: '',
                correo: '',
                direccion: '',
            }
        },

        editar_producto: {
            proveedor: {

            }
        },

        language: {
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
    mounted() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        this.ProductoTabla()
        this.productosSelect()
    },
    methods: {
        productosSelect() {
            $.ajax({
                type: "GET",
                url: "/productos/getproducto",
                success: (response) => {
                    this.viewProductos = response.data
                }

            });
        },
        ProductoTabla() {
            this.tabla = $('#tablaProducto').DataTable({
                'ajax': {
                    'method': 'GET',
                    'url': '/productos_proveedor/getproducto_proveedor',
                },
                columns: [{
                        defaultContent: '1'
                    },
                    {
                        data: 'proveedor.nombres'
                    },

                    {
                        data: 'producto.nombre'
                    },
                    {
                        data: 'num_lote'
                    },
                    {
                        data: 'cantidad_proveida'
                    },
                    {
                        data: 'precio'
                    },
                    {
                        defaultContent: `<div class="btn-group"><button data-toggle="modal" data-target="#editarProductoModal" class="editar btn btn-primary">Editar</button>`
                    },
                ],
                language: this.language
            });
            this.tabla.on('order.dt search.dt', () => {
                this.tabla.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            let self = this
            $('#tablaProducto tbody').on('click', 'button.editar', function (d) {
                var data = self.tabla.row($(this).parents('tr')).data();
                self.editar_producto = data
                console.log(data);

            });
        },

        crear() {
            if (this.nuevo_producto.producto == null || !this.nuevo_producto.producto.id) {
                Swal.fire({
                    title: 'Error!',
                    text: `Debe seleccionar un producto`,
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "/productos_proveedor/setproducto_proveedor",
                    data: this.nuevo_producto,
                    success: (response) => {
                        console.log(response);
                        if (response.resp) {
                            $('#crearProductoModal').modal('hide')
                            Swal.fire({
                                title: 'Muy bien!',
                                text: `Producto creado de manera correta`,
                                type: 'success',
                                confirmButtonText: 'OK'
                            })
                            this.tabla.ajax.reload();
                            this.nuevo_producto = {
                                proveedor: {
                                    identificacion: '',
                                    nombres: '',
                                    apellidos: '',
                                    telefono: '',
                                    correo: '',
                                    direccion: '',
                                }
                            }
                        } else {
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
        editar() {
            $.ajax({
                type: "POST",
                url: `productos_proveedor/putproducto`,
                data: this.editar_producto,
                success: (response) => {
                    console.log(response);
                    if (response.resp) {
                        $('#editarProductoModal').modal('hide')
                        Swal.fire({
                            title: 'Muy bien!',
                            text: `Producto editado de manera correta`,
                            type: 'success',
                            confirmButtonText: 'OK'
                        })
                        this.tabla.ajax.reload();
                        this.editar_producto = {
                            proveedor: {
                                identificacion: '',
                                nombres: '',
                                apellidos: '',
                                telefono: '',
                                correo: '',
                                direccion: '',
                            }
                        }
                    } else {
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