<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Visitor;
use App\Models\DataVisitor;
use Illuminate\Http\Request;

class VisitorDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        return view('data.index');
    }

    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = DataVisitor::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    return '<a href="/data/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>';
                   
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function add()
    {
        return view('data.add');
    }

    function add_validation(Request $request)
    {
            $request->validate([
                'visitor_name' => 'required',
                'visitor_email' => 'required|email|unique:data_visitors,visitor_email',
                'visitor_mobile_no' => 'required',
                'visitor_address' => 'required',    
            ]);
            $data = $request->all();
            DataVisitor::create([
                'visitor_name' => $data['visitor_name'],
                'visitor_email' => $data['visitor_email'],
                'visitor_mobile_no' => $data['visitor_mobile_no'],
                'visitor_address' => $data['visitor_address'],
            ]);

            return redirect('data')->with('success', 'New Data Visitor Added');

       
    }

    function edit($id)
    {
        $visitor = DataVisitor::find($id);
        
        return view('data.edit', compact('visitor'));
    }

    function edit_validation(Request $request)
    {
            $request->validate([
                'visitor_name' => 'required',
                // 'visitor_email' => 'required|email|unique:data_visitors,visitor_email',
                'visitor_mobile_no' => 'required',
                'visitor_address' => 'required',    
            ]);
            $data = $request->all();

            $form_data = array(
                'visitor_name'       =>  $data['visitor_name'],
                // 'visitor_email'       =>  $data['visitor_email'],
                'visitor_mobile_no'       =>  $data['visitor_mobile_no'],
                'visitor_address'       =>  $data['visitor_address'],
            );
    
            DataVisitor::whereId($data['hidden_id'])->update($form_data);
    
            return redirect('data')->with('success', 'Visitor Data Updated');       
    }

}
