<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{

    protected $table = "product";


    public function scopeProductsByCategory($query,$id){
        return $query->where('cat_id',$id);
    }

}
