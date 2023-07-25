<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keperluan extends Model
{
    use HasFactory;

    protected $fillable = [
        'keperluan_name',
        'status',
    ];
    public function availabels()
    {
        return $this->hasMany(EmployeeAvailable::class);
    }
}
