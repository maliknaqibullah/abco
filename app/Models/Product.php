<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['warehouse_id','ingredient_id','supplier_id','name','amount','unit','is_supplied'];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

  public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function transferStock(){
        return $this->hasMany(TransferStock::class);
    }

}
