<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use DataTables;
// use Yajra\DataTables\Services\DataTable;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SubUserController extends Controller
{
    public function construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::where('type', '=', 'User')->get();
        return view('sub_user')->with(compact('data'));
    }

    // function fetch_all(Request $request)
    // {
    //     // dd($request->ajax());
    //     if($request->ajax())
    //     {
    //         $data = User::where('type', '=', 'User')->get();
    //         return view();
    //         // return DataTables::of($data)
    //         //         ->addIndexColumn()
    //         //         ->addColumn('action', function($row){
    //         //             // return '<a href="/sub_user/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
    //         //             return '<a href="/sub_user/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>';
    //         //         })
    //         //         ->rawColumns(['action'])
    //         //         ->make(true);
    //     }
    // }
    public function userStatus(Request $request){
        // dd($request);
            $userStatus = User::find($request->editid);
           if($request-> statusName == "Enable")
            {
                $userStatus->user_status = "Disable";
            }
            else{
                $userStatus->user_status = "Enable";
            }
            // $data['dept']=$userStatus->employee()->where('employee_status', '=', 'Enable')->get();
            $userStatus->save();
            // echo 'Update successfully.';
            // // return response()->json($data);
            // exit;
        }


    function add()
    {
        return view('add_sub_user');
    }

    function add_validation(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'email'         =>  'required|email|unique:users',
            'password'      =>  'required|min:6',
            'user_status'    =>'required',
        ]);

        $data = $request->all();

        User::create([
            'name'      =>  $data['name'],
            'email'     =>  $data['email'],
            'password'  =>  Hash::make($data['password']),
            'type'      =>  'User',
            'user_status'=>$data['user_status']
        ]);

        return redirect('sub_user')->with('success', 'New User Added');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('edit_sub_user', compact('data'));
    }

    function edit_validation(Request $request)
    {
        // dd($request);
        // dd($sub_user);
        // dd($request->hidden_id);
        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required|email|unique:users,email,'.$request->hidden_id ,
            'user_status'    =>'required',
        ]);

        $data = $request->all();

        if(!empty($data['password']))
        {
            $form_data = array(
                'name'  => $data['name'],
                'email'  => $data['email'],
                'password' => Hash::make($data['password']),
                'user_status'=>$data['user_status']
            );
        }
        else
        {
            $form_data = array(
                'name'      =>  $data['name'],
                'email'     =>  $data['email'],
                'user_status'=>$data['user_status']
            );
        }

        User::whereId($data['hidden_id'])->update($form_data);

        return redirect('sub_user')->with('success', 'User Data Updated');

    }

    function delete($id)
    {
        $data = User::findOrFail($id);

        $data->delete();

        return redirect('sub_user')->with('success', 'User Data Removed');
    }
}
