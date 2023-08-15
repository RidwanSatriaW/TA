<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EmployeeAvailable;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('department.department');
    }

    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = Department::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->status == 1)
                    {
                        return '<a href="/department/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/department/deactivate/'.$row->id.'" class="btn btn-danger btn-sm">Deactivate</a>';
                    }
                    else
                    {
                        return '<a href="/department/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/department/activate/'.$row->id.'" class="btn btn-success btn-sm">Activate</a>';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function add()
    {
        return view('department.add_department');
    }

    function add_validation(Request $request)
    {
        $request->validate([
            'department_name'       =>  'required',
        ]);

        $data = $request->all();

        Department::create([
            'department_name'       =>  $data['department_name'],
            'status'                => 1,
        ]);

        return redirect('department')->with('success', 'New Department Added');
    }

    public function edit($id)
    {
        $data = Department::findOrFail($id);

        return view('department.edit_department', compact('data'));
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'department_name'       =>  'required',
        ]);

        $data = $request->all();

        $form_data = array(
            'department_name'       =>  $data['department_name'],
        );

        Department::whereId($data['hidden_id'])->update($form_data);

        return redirect('department')->with('success', 'Department Data Updated');
    }

    function activate($id)
    {
        $status = 1;

        $form_data = array(
            'status'       =>  $status,
        );

        Department::whereId($id)->update($form_data);
        return redirect('department')->with('success', 'Department Data Updated');
        
    }
    function deactivate($id)
    {
        $status = 0;
        $form_data = array(
            'status'       =>  $status,
        );
        Department::whereId($id)->update($form_data);
        Employee::where('department_id', $id)->update($form_data);
        EmployeeAvailable::whereHas('employees', function ($query) use ($id) {
            $query->where('department_id', $id);
        })->update($form_data);

        return redirect('department')->with('success', 'Department Data Updated');
        
    }
}
