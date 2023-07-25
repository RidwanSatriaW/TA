<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use DataTables;
use Illuminate\Support\Facades\Auth;

class SubUserController extends Controller
{
    public function construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sub_user.sub_user');
    }

    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = User::where('type','=','User')->where('status', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="/sub_user/'.$row->id.'/edit" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/sub_user/delete/'.$row->id.'" class="edit btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function add()
    {
        return view('sub_user.add_sub_user');
    }

    function add_validation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'User',
            'status' => 1
        ]);
        return redirect('sub_user')->with('success','User Added Successfully');

    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('sub_user.edit_sub_user',compact('data'));
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'email'     =>  'required|email',
            'name'      =>  'required'   
        ]);

        $data = $request->all();

        if(!empty($data['password']))
        {
            $form_data = array(
                'name'  => $data['name'],
                'email'  => $data['email'],
                'password' => Hash::make($data['password'])
            );
        }
        else
        {
            $form_data = array(
                'name'      =>  $data['name'],
                'email'     =>  $data['email']
            );
        }

        User::whereId($data['hidden_id'])->update($form_data);

        return redirect('sub_user')->with('success', 'User Data Updated');

    }

    function delete($id)
    {
        $data = User::findOrFail($id);
        if ($data->status == 1) {
            $status = 0;

        $form_data = array(
            'status'       =>  $status,
        );

        User::whereId($id)->update($form_data);
        // Employee::where('department_id', $id)->update($form_data);

        return redirect('sub_user')->with('success', 'Sub User Data Updated');

        
        }
    }
}
