<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_proveedor extends Model
{
    protected $guarded = [];
    public function proveedor(){
        return $this->belongsTo('\App\Proveedor','proveedor_id');
    }
    public function producto(){
        return $this->belongsTo('\App\Producto','producto_id');
    }
}
