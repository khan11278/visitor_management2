<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor_dept_emp extends Model
{
    use HasFactory;
    protected $fillable = [
        'visitor_department',
        'visitor_meet_person_name',
        'visitor_reason_to_meet',

    ];

    public function visitordateofemp()
    {
        return $this->belongsTo(Visitor_date::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'visitor_meet_person_name');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'visitor_department');
    }
}
