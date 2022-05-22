<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    public function product(){
        return $this->hasMany(Product::class);
    }

      public function stockHistory(){
        return $this->hasMany(StockHistory::class);
    }
}
