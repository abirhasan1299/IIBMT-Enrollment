<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function sessions()
    {
        return $this->belongsTo(Session::class,'session_id');
    }
    public function modes()
    {
        return $this->belongsTo(Mode::class,'mode');
    }
}
