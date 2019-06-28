new Vue({
    el: '#historial',
    data: {
        l:'mncvmvn',
        tabla: '',
        ver_detalle: '',
        cancelar: '',
    },
    mounted() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        this.HistorialTabla()
    },
    methods: {
        pdf(factura_id){
            window.open(`/hisorial/pdf/${factura_id}`)
        },
        HistorialTabla() {
            this.tabla = $('#tablaHistorial').DataTable({
                'ajax': {
                    'method': 'GET',
                    'url': '/hisorial/getfactura',
                },
                columns: [{
                        defaultContent: '1'
                    },
                    {
                        data: 'cliente.nombres'
                    },

                    {
                        data: 'num_factura'
                    },
                    {
                        data: 'total_venta'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        defaultContent: `<div class="btn-group"><button data-toggle="modal" data-target="#ver" class="ver btn btn-primary">Ver</button><button data-toggle="modal" class="cancelar ml-2 btn btn-danger">Cancelar</button>`
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
            $('#tablaHistorial tbody').on('click', 'button.ver', function (d) {
                var data = self.tabla.row($(this).parents('tr')).data();
                self.ver_detalle = data
                console.log(self.ver_detalle);

            });

            $('#tablaHistorial tbody').on('click', 'button.cancelar', function (d) {
                var data = self.tabla.row($(this).parents('tr')).data();
                self.cancelar = data

                // alert(self.cancelar.id)
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                    title: 'Estas seguro?',
                    text: "Quieres cancelar esta factura!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        //ajax aqui
                        $.ajax({
                            type: "POST",
                            url: "/hisorial/deletefactura",
                            data: self.cancelar,
                            success: (response) => {
                                console.log(response);
                                if (response.resp) {
                                    $('#crear').modal('hide')
                                    swalWithBootstrapButtons.fire(
                                        'Eliminado!',
                                        'Factura eliminada correctamente.',
                                        'success'
                                    )
                                    self.tabla.ajax.reload();
                                } else {
                                    swalWithBootstrapButtons.fire(
                                        'Error!',
                                        'No se pudo eliminar la factura',
                                        'error'
                                    )
                                }

                            }
                        });
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'Has cancelado esta acción',
                            'warning'
                        )
                    }
                })

            });
        },
    }
})