<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class,'id');
    }
}
