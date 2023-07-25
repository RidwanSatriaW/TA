<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_name',
        'department_id',
        'status'
    ];

    public function availabels()
    {
        return $this->hasMany(EmployeeAvailable::class);
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
