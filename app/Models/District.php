<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function school(){
        return $this->hasMany(School::class);
    }
    public function warehouse(){
        return $this->hasMany(Warehouse::class);
    }
    public function bakery(){
        return $this->hasMany(Bakery::class);
    }


}
