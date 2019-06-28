new Vue({
    el:'#comprar',
    data:{
        viewProductos:[],
        compra:{
            cliente:{
                telefono:'',
                direccion:'',
                correo:''
            },
            producto:[],
            cantidad:''
        },
        detalle:[],
        total:0
    },
    mounted(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        this.productosSelect()
    },
    methods:{
        
        productosSelect(){
            $.ajax({
                type: "GET",
                url: "/productos/getproducto",
                success:(response) =>{
                    this.viewProductos = response.data
                }
                
            });
        },
        añadir(){
            if (this.compra.producto == null || !this.compra.producto.id) {
                Swal.fire({
                    title: 'Error!',
                    text: `Debe seleccionar un producto`,
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            }else if (this.compra.cantidad == '') {
                Swal.fire({
                    title: 'Error!',
                    text: `Debe escribir una cantidad`,
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            }else if (this.compra.cantidad > this.compra.producto.stock) {
                Swal.fire({
                    title: 'Error!',
                    text: `La cantidad no puede ser mayor al stock del producto`,
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            }else{
                self = this
                let producto = this.detalle.filter(item => item.producto.id == this.compra.producto.id);
                
                if (producto.length > 0 ) {
                    Swal.fire({
                        title: 'Error!',
                        text: `El producto ya fue añadido`,
                        type: 'error',
                        confirmButtonText: 'OK'
                    })
                    self.compra.producto = []
                    self.compra.cantidad = ''
                }else{
                    let obj = {
                        producto: this.compra.producto,
                        cantidad: this.compra.cantidad
                    }
                    this.detalle.push(obj)
                    this.compra.producto = []
                    this.compra.cantidad = ''
                }
               
                
            }
        },
        eliminar(index){
            this.detalle.splice(index,1)
            this.compra.producto = []
            this.compra.cantidad = ''
        },
        setFactura(){
            let data = {
                detalle:this.detalle,
                cliente:this.compra.cliente,
                total:this.total
            }
            $.ajax({
                type: "POST",
                url: `/comprar/setfactura`,
                data: data,
                success:(response)=> {
                    console.log(response);
                    if (response.resp) {
                        Swal.fire({
                            title: 'Muy bien!',
                            text: `Compra realizada correntamente`,
                            type: 'success',
                            confirmButtonText: 'OK'
                        })
                        this.productosSelect()

                        this.compra={
                            cliente:{
                                telefono:'',
                                direccion:'',
                                correo:''
                            },
                            producto:[],
                            cantidad:''
                        },
                        this.detalle=[]
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: `no se pudo realizar la compra`,
                            type: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                    
                }
            });
        },
        
    },
    
    computed:{
        total_compra(){
            self = this
            self.total = 0
            $.each(this.detalle, function (indexInArray, value) { 
                self.total = self.total + (parseInt(value.producto.precio_venta)  * parseInt(value.cantidad))
                 
            });
            return self.total
        }
    }
})