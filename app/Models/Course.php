<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sessions()
    {
        return $this->hasMany(Session::class,'id');
    }
    public function students()
    {
        return $this->hasMany(Student::class,'id');
    }
}
