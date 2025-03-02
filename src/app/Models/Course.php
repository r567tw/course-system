<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = ['name', 'start', 'description', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
