<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Detalle_factura;
use App\Cliente;
use Barryvdh\DomPDF\Facade as PDF;

class DetalleFacturaController extends Controller
{
   public function index(){
       return view('historial');
    // return Factura::all();
   }
   public function getFactura(){
    return ['data'=>Factura::with(['detalles','productos','cliente'])->get()] ;

   }
   public function deletefactura(Request $request){

    DB::beginTransaction();
        try {
           foreach ($request->detalles as $key => $value) {
                //retornar la cantidad de productos al stock
                $stock_actual = Producto::where('id', $value['producto_id'])->get()[0];
               Producto::where('id', $value['producto_id'])->update([
                'stock' => $stock_actual->stock + $value['cantidad']
               ]);
               //Eliminar los detalles
               Detalle_factura::where('id',$value['id'])->delete();

           }
           //eliminar la factura
           Factura::where('id',$request->id)->delete();
           //Eliminar cliente
           Cliente::where('id',$request->cliente_id)->delete();
            $succes = true;
            DB::commit();
        } catch (\Throwable $th) {
            $succes = false;
            $error = $th->getMessage();
            DB::rollBack();
        }

        if ($succes) {
            return [
                'resp'=>true
            ];
        }else {
            return [
                'resp'=>false,
                'error'=>$error
            ];
        }
    }
    public function pdf(Factura $factura){
        // return view('factura');
        $detalle = Factura::with(['detalles','productos','cliente'])->where('id',$factura->id)->get()[0];
        $pdf = PDF::loadView('factura',['detalle'=>$detalle]);
        return $pdf->download('factura.pdf');
       
    }
}
