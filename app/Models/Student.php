<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reg_no',
        'first_name',
        'last_name',
        'email',
        'gender',
        'course_id'
         
    
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
   
}