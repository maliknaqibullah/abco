<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    use HasFactory;
        protected $fillable = ['warehouse_id','ingredient_id' ,'user_id','supplier_id','amount','unit'];
        
   public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

  public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
