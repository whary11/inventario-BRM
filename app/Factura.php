<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $guarded = [];
    // public function detalles(){
    //     // Detalle_factura
    //     return $this->belongsToMany('\App\Producto','detalle_facturas')->withPivot('id');

    // }
    public function detalles(){
        // Detalle_factura
        return $this->hasMany('\App\Detalle_factura');

    }
    public function productos(){
        // Detalle_factura
        return $this->belongsToMany('\App\Producto','detalle_facturas');

    }
    public function cliente(){
        // Detalle_factura
        return $this->belongsTo('\App\Cliente','cliente_id');

    }
}
