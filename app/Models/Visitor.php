<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'visitor_name', 
        // 'visitor_email', 
        // 'visitor_mobile_no', 
        // 'visitor_address', 
        'visitor_enter_time', 
        'visitor_out_time',
        'first_emotion',
        'feedback',
        'visitor_status', 
        'employee_availables_id',      
        'user_id',
        'data_visitors_id',
        'value',
    ];

    public function availables()
    {
        return $this->belongsTo(EmployeeAvailable::class, 'employee_availables_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function visitors()
    {
        return $this->belongsTo(DataVisitor::class, 'data_visitors_id', 'id');
    }
}


