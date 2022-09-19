<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['department_name','department_status'];

    // public function getDepartmentEmployees(){
    //     return $this->hasMany(Employee::class);
    // }
    public function employee()
    {
        // return $this->belongsToMany(Employee::class);
        return $this->belongsToMany(Employee::class, 'department_employee');
    }
    public function getEnabledEmployeeCount($department_id){
        $count = Employee::where('employee_status', 'Enable')->whereHas('department', function($q)use($department_id){
            $q->where("department_id",$department_id);
        })->count();
        // error_log($count);
        return ($count > 0) ? True : False;
    }

}
