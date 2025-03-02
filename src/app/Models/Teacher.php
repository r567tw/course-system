<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $hidden = ['password'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
