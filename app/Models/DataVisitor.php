<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVisitor extends Model
{
    use HasFactory;
    protected $fillable = [
    'visitor_name', 
    'visitor_email', 
    'visitor_mobile_no', 
    'visitor_address', 
    ];

    public function logs()
    {
        return $this->hasMany(Visitor::class);
    }
}
