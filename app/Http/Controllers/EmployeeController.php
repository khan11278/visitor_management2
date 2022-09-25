<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function employee(){
        $employee=Employee::all();
        // $dept=Department::all();
        return view('employee')->with(compact('employee'));
    }

    public function employeeStatus(Request $request){
        // dd($request);
            $employeeStatus = Employee::find($request->editid);
           if($request-> statusName == "Enable")
            {
                $employeeStatus->employee_status = "Disable";
            }
            else{
                $employeeStatus->employee_status = "Enable";
            }
            // $data['dept']=$employeeStatus->employee()->where('employee_status', '=', 'Enable')->get();
            $employeeStatus->save();
            // echo 'Update successfully.';
            // // return response()->json($data);
            // exit;
        }
    public function employee_add(){
        $department =Department::all();
        $title="Add New Employee";
        $count=$department->count();
        $emp_dept=[];
        $arr=[];
        $status=array('Active','Inactive');
        $url=route('employee_create');
        $employee=new Employee;
        $data= compact('department','count','employee','emp_dept','url','arr','status','title');
        return view('employee_add')->with($data);
    }
    public function employee_create(Request $request){
        // dd("hello");
        $request->validate([
            'name'          =>  'required',
            'email'         => 'required|email|unique:employees',
            'dept'          => 'required',
            'emp_status'    =>'required',
        ]);
        $input = $request->all();
        // foreach($input['dept'] as $depart1){
            // dd($depart1);
        $employee =new Employee();
        $employee->name=$request['name'];
        $employee->email=$request['email'];
        $employee->employee_status=$input['emp_status'];
        $employee->save();
        foreach($input['dept'] as $depart1){
        $emp_dept = Department::find($depart1);
        $employee->department()->attach($emp_dept);
        // $employee->department_id=$depart1;
        // $input = $request->all();
            // dd($input['dept']);
        // $depart_name1="";
        }
                // $depart_single= Department::where('id',$depart1)->first();
                // $depart_single->contact_person=$depart_single->contact_person.",".$request['name'];
                // dd($depart_single->department_name);
                // $depart_name1=$depart_name1.",".$depart_single->department_name;
                // $depart1->department;


                // }

                // $substring=substr( $depart_name1, 1);
                // $employee->department_name=$substring;
                // $employee->save();
                session()->flash('employee_register', 'You have Successfully Registered');
                return redirect('employee');
            }

    // function fetch_all(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         $data = Employee::latest()->get();
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 return '<a href="/employee/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/employee/delete/'.$row->id.'" class="btn btn-danger btn-sm delete">Delete</a>';
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
    public function employee_edit($id){
        $employee=Employee::find($id);
        $title="Edit Employee";
        $arr=[];
        foreach($employee->department as $depart1){
          array_push($arr,$depart1['id']);
        //     // $emp_dept = Department::find($depart1);
        //     // $employee->department()->attach($emp_dept);
        // echo ($arr1);
        // echo gettype($depart1['id']);
         }
        // echo  gettype($employee->department['id']);
        //  dd($arr);
        //  echo($employee->department['department_name']);
        //  dd($employee->department['id']);

        $url=url('/employee/update').'/'.$id;
        $department =Department::all();
        $count=$department->count();
        $data= compact('department','count','employee','arr','url','title');
        return view('employee_add')->with($data);
    }
    public function employee_update(Request $request,$id){
        // dd($employee);
        $request->validate([
            'name'          =>  'required',
            'dept'          => 'required',
            'emp_status'    =>'required',
            'email'         => 'required|email|unique:employees,email,'.$request->id,
        ]);
        $input = $request->all();
        $employee =Employee::find($id);
        $employee->name=$request['name'];
        $employee->email=$request['email'];
        $employee->employee_status=$input['emp_status'];
        $employee->save();
        $arr=[];
        foreach($input['dept'] as $depart1){
          array_push($arr,$depart1);
        }
        $employee->department()->sync($arr);
        session()->flash('employee_update', 'You have Successfully Updated');
        return redirect('employee');
}
public function employee_delete($id){
    $emp=Employee::find($id);
    $emp->delete();
    return redirect('employee');
}
}
