<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BakeryOrder extends Model
{
    use HasFactory;
    protected $fillable = ['bakery_id','order_date','school_id','warehouse_id','male','female','loaves_qty','distributed_loaves','is_supplied'];

 protected $dates = [
        'created_at','updated_at','order_date'
    ];


    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

  public function school(){
        return $this->belongsTo(School::class);
    }
  public function bakery(){
        return $this->belongsTo(Bakery::class);
    }

}
