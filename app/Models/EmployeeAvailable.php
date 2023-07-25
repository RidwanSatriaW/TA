<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAvailable extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'keperluan_id',
        'status',
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    public function necessities()
    {
        return $this->belongsTo(Keperluan::class, 'keperluan_id', 'id');
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
