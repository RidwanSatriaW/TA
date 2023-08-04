<?php

namespace App\Http\Controllers;

use App\Models\DataVisitor;
use DataTables;
use Carbon\Carbon;
use App\Models\Visitor;
use App\Models\Keperluan;
use Illuminate\Http\Request;
use App\Models\EmployeeAvailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        return view('visitor.visitor');
    }

    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $query = Visitor::with('availables.employees.departments', 'users', 'visitors');
            // dd($query);
           

            if(Auth::user()->type == 'User')
            {
                $query->where('user_id', '=', Auth::user()->id);
            // }else{
            //     $query->get(['*','visitors.id as visitor_id']);
            }
            $query->get();
           

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('visitor_status', function($row){
                    if($row->visitor_status == 'Complete')
                    {
                        return '<span class="badge bg-success">Complete</span>';
                    }
                    else
                    {
                        return '<span class="badge bg-warning">On Meet</span>';
                    }
                })
                ->escapeColumns('visitor_status')
                ->addColumn('action', function($row){
                    if($row->visitor_status == 'On meet')
                    {
                        // return '<a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-scan">SCAN</a>';
					
                        return '<a href="/visitor/'.$row->id.'/edit" class="btn btn-danger btn-sm">Scan</a>&nbsp
                        ';
                    }
                    else
                    {
                        return '<a href="/visitor/'.$row->id.'/view" class="btn btn-info btn-sm">View</a>&nbsp';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function add()
    {
        $keperluan = Keperluan::where('status', 1)->get();
        $users = DataVisitor::all();
        return view('visitor.add_visitor', compact('keperluan', 'users'));
    }

    function get_available($id)
    { 
        $available = EmployeeAvailable::where('keperluan_id', $id)->where('status', 1)->get();
        foreach ($available as $item) {
            echo "<option value=".$item->id.">".$item->employees->employee_name." (".$item->employees->departments->department_name.")"."</option>";
        }
        // return response()->json($available);
        
    }
    function add_validation_first(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'person' => 'required'
                 
        ]);
        $data = $request->all();
        $visitor = [
                'user' => $data['user'],
                'person' => $data['person'],
            ];
        return view('scan.first', compact('visitor'));
    }

    function add_validation(Request $request)
    {
        try {
            $request->validate([
                'user' => 'required',
                // 'necessity' => 'required',
                'person' => 'required',
                'emotion' => 'required'       
            ]);
            $data = $request->all();
            // dd($data);
            $employee_availables = EmployeeAvailable::where('id', $data['person'])->pluck('id');
                            // where('employee_id', '=', $data['person'])
                            // ->where('keperluan_id', '=', $data['necessity'])
                            // // ->first()
                            // ->pluck('id');
            // dd($employee_availables);
            $employee_availables_id = $employee_availables[0];
            // dd($employee_availables_id);
            $visitor_enter_time = Carbon::now();
            $user_id = Auth::user()->id;
    
            Visitor::create([
                'data_visitors_id' => $data['user'],
                'visitor_enter_time' => $visitor_enter_time,
                // 'first_emotion' => '-',
                'first_emotion' => $data['emotion'],
                'employee_availables_id' => $employee_availables_id,
                'visitor_status' => 'On meet',
                'visitor_out_time' => '-',
                'feedback' => '-',
                'user_id' => $user_id,
            ]);
            $output = [
                'success' => true,
                'msg' => 'Add Visitor Data Successfully'
            ];
        } catch (\Throwable $th) {
            $output = [
                'success' => false,
                'msg' => $th->getMessage()
            ];
        }
        return $output;
      

    }

    function show($id)
    {
        $visitor = Visitor::find($id);
        return view('visitor.detail_visitor', compact('visitor'));
    }

    function edit($id)
    {
        $visitor = Visitor::find($id);
        
        return view('scan.last', compact('visitor'));
    }

    function edit_validation(Request $request)
    {
        try {
            $request->validate([
                'feedback'       =>  'required',
            ]);
            $data = $request->all();
            $out_time = Carbon::now();
            $form_data = array(
                'feedback'       =>  $data['feedback'],
                'visitor_out_time' => $out_time,
                'visitor_status' => 'Complete',
            );

            Visitor::whereId($data['visitor_id'])->update($form_data);

            $output = [
                'success' => true,
                'msg' => 'Add Visitor Data Successfully'
            ];
        } catch (\Throwable $th) {
            $output = [
                'success' => false,
                'msg' => $th->getMessage()
            ];
        }
        return $output;
    }


}
