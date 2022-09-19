<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor_date extends Model
{
    use HasFactory;
    protected $fillable = [
        'visitor_enter_time',
        'visitor_out_time',
        'visitor_status',
        'visitor_token',
        'visitor_enter_by',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function visitordeptemp()
    {
        return $this->hasMany(Visitor_dept_emp::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'visitor_enter_by');
    }
}
