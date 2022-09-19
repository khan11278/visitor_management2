<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function department()
    {
        // return $this->belongsToMany(Department::class);
        return $this->belongsToMany(Department::class, 'department_employee');

    }

}
