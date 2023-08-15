<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Keperluan;
use PDF;
use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $employee = Employee::where('status', 1)->get();
        $department = Department::where('status', 1)->get();
        $necessity = Keperluan::where('status', 1)->get();
        return view('report.index', compact('employee', 'department', 'necessity'));
    }

    function export_pdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',      
        ]);
        $data = $request->all();
        
        $startDate = Carbon::parse($data['start_date'])->startOfDay();
        $endDate = Carbon::parse($data['end_date'])->endOfDay();
        
        $department = $request->input('department');
        $employee = $request->input('employee');
        $necessity = $request->input('necessity');

        $visitor = Visitor::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate);

        if (!empty($department) && empty($employee) && empty($necessity)) {
            $visitor = $visitor->whereHas('availables', function ($query) use ($department) {
                $query->whereHas('employees', function ($query) use ($department) {
                    $query->where('department_id', $department);
                });
            })->get();
        } elseif (!empty($employee) && empty($department) && empty($necessity)) {
            $visitor = $visitor->whereHas('availables', function ($query) use ($employee) {
                $query->whereHas('employees', function ($query) use ($employee) {
                    $query->where('employee_id', $employee);
                });
            })->get();
        } elseif (!empty($necessity) && empty($employee) && empty($department)) {
            $visitor = $visitor->whereHas('availables', function ($query) use ($necessity) {
                $query->where('keperluan_id', $necessity);
            })->get();
        } else {
            $visitor = $visitor->get();
        }
        $visitorData = $visitor->pluck('value')->toArray(); // Mengambil nilai dari kolom 'value' dan mengonversi ke array

        $averageValue = count($visitorData) > 0 ? array_sum($visitorData) / count($visitorData) : 0;
        $roundedAverageValue = round($averageValue);
        $roundedAverageValue = intval($roundedAverageValue);
        if ($roundedAverageValue == 0) {
            $value = 'Very Unsatisfying';
        }elseif ($roundedAverageValue == 1) {
            $value = 'Unsatisfying';
        }elseif ($roundedAverageValue == 2) {
            $value = 'Neutral';
        }elseif ($roundedAverageValue == 3) {
            $value = 'Satisfying';
        }else {
            $value = 'Very Satisfying';
        }

        $pdf = PDF::loadview('report.pdf',['datas'=>$visitor, 'value'=>$value]);
    	return $pdf->download('laporan_visitor_'.date('Y-m-d_H-i-s').'.pdf');
    }
}
