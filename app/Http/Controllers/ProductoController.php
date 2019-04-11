<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Proveedor;
use App\Producto;

class ProductoController extends Controller
{
    public function index(){
        return view('producto');
    }
    public function getProducto(){
        return [
            'data'=>Producto::all()
        ];
    }
    public function setProducto(Request $request){
       
        DB::beginTransaction();
        try {
            Producto::create([
                'nombre' => $request->nombre,
                'precio_venta' => $request->precio_venta,
                'stock' => 0
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
            Producto::where('id',$request->id)->update([
                'nombre' => $request->nombre,
                'precio_venta' => $request->precio_venta,
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
