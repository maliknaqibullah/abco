<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable =['district_id','school_id','type','name','male','female','distance'];
//    public function bakery(){
//        return $this->belongsTo(Bakery::class);
//    }
    public function district(){
        return $this->belongsTo(District::class);
    }

    public function bakeryOrder(){
        return $this->hasMany(BakeryOrder::class);
    }
    public function attendance(){
        return $this->hasMany(SchoolAttendance::class);
    }


}
