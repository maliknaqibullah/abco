<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'district_id','status','description'];


    public function district(){
        return $this->belongsTo(District::class);
    }

    public function bakeryOrder(){
        return $this->hasMany(BakeryOrder::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
    public function transferStock(){
        return $this->hasMany(TransferStock::class);
    }
}
