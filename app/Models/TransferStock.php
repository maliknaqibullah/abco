<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStock extends Model
{
    use HasFactory;
    protected $fillable =['warehouse_id','product_id','destination_id','destination_type','stock_qty','is_transferred'];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }


}
