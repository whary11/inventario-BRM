<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Proveedor;
use App\Producto;
use App\Producto_proveedor;

class ProductoProveedorController extends Controller
{
    public function index(){
        return view('producto_proveedor');
    }
    public function getProducto_proveedor(){
        return [
            'data'=>Producto_proveedor::with(['proveedor','producto'])->get()
        ];
    }
    public function setProducto_proveedor(Request $request){
       
        DB::beginTransaction();
        try {
           $proveedor = Proveedor::create([
                'identificacion' => $request->proveedor['identificacion'],
                'nombres' => $request->proveedor['nombres'],
                'apellidos' => $request->proveedor['apellidos'],
                'telefono' => $request->proveedor['telefono'],
                'correo' => $request->proveedor['correo'],
                'direccion' => $request->proveedor['direccion'],
            ]);
            Producto_proveedor::create([
                'proveedor_id' => $proveedor->id,
                'producto_id' => $request->producto['id'],
                'precio' => $request->precio,
                'num_lote' => $request->num_lote,
                'cantidad_proveida' => $request->cantidad,
                'fecha_vencimiento' => $request->fecha,
            ]);
            $stock_actual = Producto::where('id',$request->producto['id'])->get()[0];
            Producto::where('id',$request->producto['id'])->update([
                'stock'=> $stock_actual->stock + $request->cantidad
            ]);
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
    public function putProducto(Request $request){
        DB::beginTransaction();
        try {
          Proveedor::where('id',$request->proveedor_id)->update([
                'identificacion' => $request->proveedor['identificacion'],
                'nombres' => $request->proveedor['nombres'],
                'apellidos' => $request->proveedor['apellidos'],
                'telefono' => $request->proveedor['telefono'],
                'correo' => $request->proveedor['correo'],
                'direccion' => $request->proveedor['direccion'],
            ]);
            Producto_proveedor::where('id',$request->id)->update([
                'precio' => $request->precio,
                'num_lote' => $request->num_lote,
                'fecha_vencimiento' => $request->fecha_vencimiento,
            ]);
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
}