<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = [];

    public function proveedor(){
        // return $this->belongsTo('\App\Proveedor','proveedor_id');
    }
}
