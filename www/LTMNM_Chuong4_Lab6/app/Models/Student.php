<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Cho phép create() gán các trường đã được kiểm tra trong controller.
    protected $fillable = ['name', 'email', 'age', 'gender', 'class_name'];
}
