<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeAvailable;
use App\Models\Keperluan;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;


class EmployeeAvailableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('availability.employee_available');
    }

    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = EmployeeAvailable::with(['necessities','employees'])->get();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('department', function($row){
                    $department = DB::table('departments')->where('id', $row->employees->departments->id)->first();
                    return $department;
                })
                ->addColumn('action', function($row){
                    if($row->status == 1)
                    {
                        return '<a href="/available/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/available/deactivate/'.$row->id.'" class="btn btn-danger btn-sm">Deactivate</a>';
                    }
                    else
                    {
                        return '<a href="/available/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/available/activate/'.$row->id.'" class="btn btn-success btn-sm">Activate</a>';
                    }
                   
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function add()
    {
        $employee = Employee::where('status', 1)->get();
        $necessity = Keperluan::where('status', 1)->get();
        return view('availability.add_employee_available', compact('employee', 'necessity'));
    }

    function add_validation(Request $request)
    {
        $request->validate([
            'employee_id'       =>  'required',
            'keperluan_id'       =>  'required',
            
        ]);

        $data = $request->all();

        EmployeeAvailable::create([
            'employee_id'       =>  $data['employee_id'],
            'keperluan_id'       =>  $data['keperluan_id'],
            'status'       =>  1,
        ]);

        return redirect('available')->with('success', 'Employee Available Added');
    }

    public function edit($id)
    {
        $data = EmployeeAvailable::findOrFail($id);
        $necessity = Keperluan::where('status', 1)->get();
        return view('availability.edit_employee_available', compact('data', 'necessity'));
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'keperluan_id'       =>  'required'
        ]);

        $data = $request->all();

        $form_data = array(
            'keperluan_id'         =>  $data['keperluan_id']
        );

        EmployeeAvailable::whereId($data['hidden_id'])->update($form_data);

        return redirect('available')->with('success', 'Employee Available Data Updated');
    }

    function activate($id)
    {
    
        $status = 1;
        $form_data = array(
            'status'       =>  $status,
        );

        EmployeeAvailable::whereId($id)->update($form_data);
        return redirect('available')->with('success', 'Employee Available Data Updated');
    }
    function deactivate($id)
    {
    
        $status = 0;
        $form_data = array(
            'status'       =>  $status,
        );

        EmployeeAvailable::whereId($id)->update($form_data);
        return redirect('available')->with('success', 'Employee Available Data Updated');
    }
}
