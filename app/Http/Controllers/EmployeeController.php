<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EmployeeAvailable;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('employee.employee');
        // $data = Employee::with('departments')->get();
        // dd($data);
    }

    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = Employee::with('departments')->get();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
            
                ->addColumn('action', function($row){
                   
                    if($row->status == 1)
                    {
                        return '<a href="/employee/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/employee/deactivate/'.$row->id.'" class="btn btn-danger btn-sm">Deactivate</a>';
                    }
                    else
                    {
                        return '<a href="/employee/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/employee/activate/'.$row->id.'" class="btn btn-success btn-sm">Activate</a>';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function add()
    {
        $department = Department::where('status', 1)->get();
        return view('employee.add_employee', compact('department'));
    }

    function add_validation(Request $request)
    {
        $request->validate([
            'employee_name'       =>  'required',
            'department'       =>  'required',
        ]);

        $data = $request->all();

        Employee::create([
            'employee_name'       =>  $data['employee_name'],
            'department_id'       =>  $data['department'],
            'status'       =>  1,
        ]);

        return redirect('employee')->with('success', 'New Employee Added');
    }

    public function edit($id)
    {
        $data = Employee::findOrFail($id);
        $department = Department::where('status', 1)->get();
        return view('employee.edit_employee', compact('data', 'department'));
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'employee_name'       =>  'required',
            'department'       =>  'required'
        ]);

        $data = $request->all();
        // dd($data);

        $form_data = array(
            'employee_name'       =>  $data['employee_name'],
            'department_id'         =>  $data['department']
        );

        Employee::whereId($data['hidden_id'])->update($form_data);

        return redirect('employee')->with('success', 'Employee Data Updated');
    }

    function activate($id)
    {
        $status = 1;
        $form_data = array(
            'status'       =>  $status,
        );

        Employee::whereId($id)->update($form_data);
        return redirect('employee')->with('success', 'Employee Data Updated');

    }
    function deactivate($id)
    {
        $status = 0;
        $form_data = array(
            'status'       =>  $status,
        );

        Employee::whereId($id)->update($form_data);
        EmployeeAvailable::where('employee_id', $id)->update($form_data);

        return redirect('employee')->with('success', 'Employee Data Updated');

    }
}
