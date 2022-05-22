<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['school_id','male','female','class_name'];

        public function school(){
        return $this->belongsTo(School::class);
    }
}
