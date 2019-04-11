<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Factura;
use App\Cliente;
use App\Detalle_factura;
use App\Producto;

class FacturaController extends Controller
{
   public function index(){
       return view('comprar');
   }
   public function setFactura(Request $request){
        DB::beginTransaction();
        try {
            //insertamos los datos del cliente
            $cliente = Cliente::create([
                'identificacion' => $request->cliente['identificacion'],
                'nombres' => $request->cliente['nombres'],
                'apellidos' => $request->cliente['apellidos'],
                'telefono' => $request->cliente['telefono'],
                'correo' => $request->cliente['correo'],
                'direccion' => $request->cliente['direccion'],
            ]);
            //generar el numero de factura
            $lastFactura = Factura::orderBy('id','desc')->take(1)->get();
                if (count($lastFactura) != 0) {
                    $num_factura = 'BRM-'.($lastFactura[0]->id+1);
                }else{
                    $num_factura = 'BRM-1';
                }
            //crear la factura
            $factura = Factura::create([
                'cliente_id' => $cliente->id,
                'num_factura' => $num_factura,
                'total_venta' => $request->total
            ]);
            
            foreach ($request->detalle as $key => $value) {
                //crear los detalles
                Detalle_factura::create([
                    'factura_id' => $factura->id,
                    'producto_id' => $value['producto']['id'],
                    'precio' => $value['producto']['precio_venta'],
                    'cantidad' => $value['cantidad'],
                ]);
                //Actualizar el stock
                $stock_actual = Producto::where('id',$value['producto']['id'])->get()[0];
                Producto::where('id',$value['producto']['id'])->update([
                    'stock' => $stock_actual->stock - $value['cantidad']
                ]);

            }
            $succes = true;
           DB::commit();
        } catch (\Throwable $th) {
            $succes = false;
            $error = $th->getMessage();
            DB::rollBack();
            //throw $th;
        }
        if ($succes) {
           return [
               'resp' => true
           ];
        }else {
            return [
                'resp' => false,
                'error' => $error
            ];
        }
   }
}
