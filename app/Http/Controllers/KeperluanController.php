<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAvailable;
use App\Models\Keperluan;
use Illuminate\Http\Request;
use DataTables;

class KeperluanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('necessity.keperluan');
    }

    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = Keperluan::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                  

                    if($row->status == 1)
                    {
                        return '<a href="/necessity/deactivate/'.$row->id.'" class="btn btn-danger btn-sm">Deactivate</a>';
                    }
                    else
                    {
                        return '<a href="/necessity/activate/'.$row->id.'" class="btn btn-success btn-sm">Activate</a>';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function add()
    {
        return view('necessity.add_keperluan');
    }

    function add_validation(Request $request)
    {
        $request->validate([
            'keperluan_name'       =>  'required',
        ]);

        $data = $request->all();

        Keperluan::create([
            'keperluan_name'       =>  $data['keperluan_name'],
            'status'       =>  1,
        ]);

        return redirect('necessity')->with('success', 'New Necessity Added');
    }

    public function edit($id)
    {
        $data = Keperluan::findOrFail($id);

        return view('necessity.edit_keperluan', compact('data'));
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'keperluan_name'       =>  'required',
        ]);

        $data = $request->all();

        $form_data = array(
            'keperluan_name'       =>  $data['keperluan_name'],
        );

        Keperluan::whereId($data['hidden_id'])->update($form_data);

        return redirect('necessity')->with('success', 'Necessity Data Updated');
    }

    function activate($id)
    {
       
        $status = 1;
        $form_data = array(
            'status'       =>  $status,
        );

        Keperluan::whereId($id)->update($form_data);
        return redirect('necessity')->with('success', 'Necessity Data Updated');
    }
    function deactivate($id)
    {
       
        $status = 0;
        $form_data = array(
            'status'       =>  $status,
        );

        Keperluan::whereId($id)->update($form_data);
        EmployeeAvailable::where('keperluan_id', $id)->update($form_data);

        return redirect('necessity')->with('success', 'Necessity Data Updated');
    }
}
