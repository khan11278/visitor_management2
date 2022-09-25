<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visitor;
use App\Models\Visitor_date;
use App\Models\Visitor_dept_emp;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//below done
// private function collection_departmentWithEnabledEmployee(){
//     return Department::whereHas('employee', function($employee){
//         $employee->where('employee_status', 'Enable');
//     })->get();
// }
private function collection_departmentWithEnabledEmployee(){
    return Department::where('department_status','Enable')->whereHas('employee', function($employee){
        $employee->where('employee_status', 'Enable');
    })->get();
}
    public function visitor_info(){
        $visitors =Visitor::all();
        // $visitor_mob_distinct=Visitor::where('visitor_status','=','Out')->get()->unique('visitor_mobile_no');
        // dd(Auth::user()->type);
        if (Auth::user()->type == "Admin") {
            $hidden1="hidden" ;
          }else{
            $hidden1="";
          }

        foreach($visitors as $visitor)
        {
            $visitor['action']=Visitor_date::where('visitor_id',$visitor->id)->latest()->first();
        }
        return view('visitor_info')->with(compact('visitors','hidden1'));
    }

//below done
    function index()
    {

        $collection_visitors = Visitor_date::orderBy('id', 'desc')->get();
        // foreach($collection_visitors as $visitor)
        // {
        //     $visitor['action']=Visitor_date::where('visitor_id',$visitor->id)->latest()->get();
        // }
        // foreach($collection_visitors as $emp)
        // {
        //     $visitor['emp']=Visitor_date::where('visitor_id',$visitor->id)->latest()->first();
        // }


        // dd($visitor['action']);

        $visitor_mob_distinct=Visitor::all()->unique('visitor_mobile_no')->pluck('visitor_mobile_no');
        // dd($visitor_mob_distinct);
        $dept=Department::all();

        $data=compact('collection_visitors','dept','visitor_mob_distinct');
        return view('visitor')->with($data);
    }

    //  function fetch_all(Request $request)
    // {
        // $records=Visitor::all();

        // foreach($records as $record){
        //     $visitor_name = $record->visitor_name;
        //     $visitor_mobile_no = $record->visitor_mobile_no;
        //     $visitor_token = $record->visitor_token;
        //     $visitor_meet_person_name = $record->visitor_meet_person_name;
        //     $visitor_department = $record->visitor_department;
        //     $enter = explode(' ',$record->visitor_enter_time);
        //     $visitor_enter_time=$enter[0];
        //     $visitor_out_time = $record->visitor_out_time;
        //     $visitor_status = $record->visitor_status;
        //     $visitor_enter_by = $record->visitor_enter_by;

        //     $data_arr[] = array(
        //       "visitor_name" => $visitor_name,
        //       "visitor_mobile_no" => $visitor_mobile_no,
        //       "visitor_token" => $visitor_token,
        //       "visitor_meet_person_name" => $visitor_meet_person_name,
        //       "visitor_department" => $visitor_department,
        //       "visitor_enter_time" => $visitor_enter_time,
        //       "visitor_out_time" => $visitor_out_time,
        //       "visitor_status" => $visitor_status,
        //       "visitor_enter_by" => $visitor_enter_by,
        //     );
        //  }
        //  $response = array(
        //     "aaData" => $data_arr
        // );
        // echo json_encode($response);
        // exit;

    //     if($request->ajax())
    //     {
    //         $query = Visitor::join('users', 'users.id', '=', 'visitors.visitor_enter_by');

    //         if(Auth::user()->type == 'User')
    //         {
    //             $query->where('visitors.visitor_enter_by', '=', Auth::user()->id);
    //         }

    //         $data = $query->get(['visitors.visitor_name','visitor_mobile_no','visitor_token', 'visitors.visitor_meet_person_name', 'visitors.visitor_department', 'visitors.visitor_enter_time', 'visitors.visitor_out_time', 'visitors.visitor_status', 'users.name', 'visitors.id']);

    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->editColumn('visitor_status', function($row){
    //                 if($row->visitor_status == 'In')
    //                 {
    //                     return '<span class="badge bg-success">In</span>';
    //                 }
    //                 else
    //                 {
    //                     return '<span class="badge bg-danger">Out</span>';
    //                 }
    //             })
    //             ->escapeColumns('visitor_status')
    //             ->addColumn('action', function($row){
    //                 if($row->visitor_status == 'In')
    //                 {
    //                     // return '<a href="/visitor/view/'.$row->id.'" class="btn btn-info btn-sm">View</a>&nbsp;<a href="/visitor/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/visitor/delete/'.$row->id.'" class="btn btn-danger btn-sm delete">Delete</a>';
    //                     // return '<a href="/visitor/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;<a href="/visitor/delete/'.$row->id.'" class="btn btn-danger btn-sm delete">Delete</a>';
    //                     return '<a href="/visitor/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>';

    //                 }
    //                 else
    //                 {
    //                    // return '<a href="/visitor/view/'.$row->id.'" class="btn btn-info btn-sm">View</a>&nbsp;<a href="/visitor/delete/'.$row->id.'" class="btn btn-danger btn-sm delete">Delete</a>';
    //                     // return '<a href="/visitor/delete/'.$row->id.'" class="btn btn-danger btn-sm delete">Delete</a>';
    //                     return '';
    //                 }
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    //not required
    public function old_entry(){
        $visitor_mob_distinct=Visitor::where('visitor_status','=','Out')->get()->unique('visitor_mobile_no');
        // dd($visitor_mob_distinct);
        // $visitor_mob_distinct=where('visitor_status','=','Out')
        return view('visitor_old_entry')->with(compact('visitor_mob_distinct'));
    }
//not required
    public function old_entry_create(Request $request){
        // dd("hello");
        $request->validate([
            'visitor_mobile_2' =>'required',
        ]);
        $visitor_mob_distinct=Visitor::where('visitor_status','=','Out')->get()->unique('visitor_mobile_no');
        foreach( $visitor_mob_distinct as $v){
            if($request->visitor_mobile_2 == $v->visitor_mobile_no)
            {
                $visitor=Visitor::where('visitor_mobile_no','=',$request->visitor_mobile_2)->first();
                return redirect('/visitor/entry/'.$visitor->id);

            }

        }

        // dd($visitor);
        return redirect()->back();
    }
//below done
    public function add(){
        $visitor=new Visitor();
        // $visitor_all=Visitor::all();
        // dd($visitor_all);
        $readonly="";
        // $depart = Department::find($request->depart);
        // $arrayDepart=Department::where("employee_status","=","Enable")->get();

        $new_department =$this->collection_departmentWithEnabledEmployee();

        $url=route('visitor_create');
        $disabled1="";
        $data=compact('new_department','visitor','url','readonly','disabled1');
        return view('visitor_add')->with($data);
    }
    // public function visitor_meet_first(){
    //     return view('visitor_meet_test');
    // }

//below done
    public function visitor_meet(Request $request){
        $depart = Department::find($request->depart);
        // dd($depart->employee);
        $data['dept']=$depart->employee()->where('employee_status', '=', 'Enable')->get();
        // dd($data['dept']);
        // dd($data['dept']);
        // $data['dept'] = Department::find($request->depart);
        // where("department_id",$request->depart)->get(["department_n"]);
        return response()->json($data);

    }

//below done
    public function create(Request $request){
        // dd($request);
        $request->validate([
            'name'          =>  'required',
            'visitor_email' => 'required|email|unique:visitors',
            'visitor_mobile_no'       => 'required|numeric|digits_between:1,10|unique:visitors',
            'address'       => 'required|string|max:255',
            // 'visitor_meet'  => 'required|string|max:255',
            'dept'          => 'required',
            'reason'        => 'required|string|max:255',
            // 'enter_time'    =>'required',
            // 'out_time'      =>'required',
            // 'password'      =>  'required|min:6',
        ]);
        // dd($request['dept']);
        // $array=$request['dept'];


        // array_unique($array);
        // $data=$request->all();
        // User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
        $visitor =new Visitor();
            $visitor->visitor_name = $request['name'];
             $visitor->visitor_email     = $request['visitor_email'];
            // 'password' = Hash::make($request['password']);
            // 'type'     = 'User'
            $visitor->visitor_mobile_no    = $request['visitor_mobile_no'];
            $visitor->visitor_address    = $request['address'];
            $visitor->save();
            // dd($visitor->id);
            $date=new Visitor_date();
            $date->visitor_id =$visitor->id;
            $date->visitor_enter_by =Auth::user()->id;
            $date->visitor_enter_time=Carbon::now();
            $date->visitor_out_time= NUll;
            $date->visitor_status='In';

            if(Visitor_date::max('visitor_token')==Null){
                $maxValue=0;
                }
                else{
                $maxValue =Visitor_date::max('visitor_token');
                }
                // dd($maxValue);
                $visit=Visitor_date::latest()->first();
                // if($visit==NUll){
                //     $visit=
                // }
                if($visit==NUll){
                    $carb=Carbon::today();
                }
                else{
                $carb=new Carbon($visit['visitor_enter_time']);
                }
                if($carb->gt(Carbon::today()) ==true ){
                    $date->visitor_token= $maxValue+1;
                 }
                 else{
                    $visit=Visitor_date::all();
                    // dd($visit)
                    foreach($visit as $v){

                    $v->visitor_token=Null;
                    $v->visitor_status="Out";
                    $v->save();
                    }
                    $date->visitor_token= 1;
                 }
                 $date->save();
                //  dd($request['dept']);
        foreach($request['dept'] as $key => $item){
            // dd($key);
            foreach($item as $key1 => $emp){
                // echo "$emp".",";
                $visit_date_emp=new Visitor_dept_emp();
                $visit_date_emp->visitor_date_id =$date->id;
                $visit_date_emp->visitor_department=$key;
                $visit_date_emp->visitor_meet_person_name=$emp;
                $visit_date_emp->visitor_reason_to_meet=$request['reason'];
                // dd( $visit_date_emp);
                $visit_date_emp->save();
            }
            // dd();
        }
        // dd();
        //     $visitor =new Visitor();
        //     $visitor->visitor_name = $request['name'];
        //      $visitor->visitor_email     = $request['visitor_email'];
        //     // 'password' = Hash::make($request['password']);
        //     // 'type'     = 'User'
        //     $visitor->visitor_mobile_no    = $request['visitor_mobile_no'];
        //     $visitor->visitor_address    = $request['address'];
        //     // dd($request['visitor_meet']);
        //     $meet_person=Employee::find($request['visitor_meet']);
        //     // $visitor->visitor_meet_person_name    = $meet_person->name;
        //     // dd($request['dept']);
        //    $depart1=Employee::find($dept)->department->first();
        //    dd($depart1);
        // //     dd($depart1->department_name);
        //     $visitor->visitor_department    = $depart1->department_name;
        //     $meet_person=Employee::find($dept);

        //     $visitor->visitor_meet_person_name =$meet_person->name;
        //     $visitor->visitor_reason_to_meet    = $request['reason'];
        //     // 'visitor_enter_time'    = Carbon::now()->toDateTimeString();
        //     // $visitor->visitor_enter_time    =$request['enter_time'] ;


        //     // $dt = Carbon::now();
        //     // $dt->toTimeString();
        //     // dd($dt);


        //     $visitor->visitor_enter_time    =Carbon::now() ;
        //     $visitor->visitor_outing_remark    = "null";
        //     // if($request['out_time']=="Yes"){
        //     // $visitor->visitor_out_time    =Carbon::now();
        //     // }
        //     // else{
        //         $visitor->visitor_out_time    =NUll;
        //     // }
        //     // if($visitor->visitor_out_time== NUll){
        //     // $visitor->visitor_status='In';
        //     // }
        //     // else{
        //         $visitor->visitor_status='In';
        //     // }
        //     $visitor->visitor_enter_by    = Auth::user()->id;

        //     // ////////////
        //     // Carbon::today()
        //     // $date=new DateTime($visit['visitor_enter_time']);
        //     // dd($date);
        //     if(Visitor::max('visitor_token')==Null){
        //         $maxValue=0;
        //         }
        //         else{
        //         $maxValue =Visitor::max('visitor_token');
        //         }
        //         // dd($maxValue);
        //         $visit=Visitor::latest()->first();
        //         $carb=new Carbon($visit['visitor_enter_time']);
        //         if($carb->gt(Carbon::today()) ==true ){
        //             $visitor->visitor_token= $maxValue+1;
        //          }
        //          else{
        //             $visit=Visitor::all();
        //             // dd($visit)
        //             foreach($visit as $v){

        //             $v->visitor_token=Null;
        //             $v->visitor_status="Out";
        //             $v->save();
        //             }
        //             $visitor->visitor_token= 1;
        //          }
        //     // $visitor->visitor_token=$request['visitor_token'];

        //     // /////////////////
        //     $visitor->save();


         session()->flash('success1', 'You have Successfully Registered');

        // dd("success");
        return redirect('/visitor/info');

    }
//not required
    public function edit($id){
        $visitor=Visitor::find($id);
        // dd($visitor);
        $dept=Department::all();
        $visitor_all=Visitor::all();
        $url=url('/visitor/update').'/'.$id;
        $readonly="readonly";
        $disabled1='disabled';
        $data=compact('visitor','dept','url','visitor_all','readonly','disabled1');
        return view('visitor_add')->with($data);
    }
//not required
    public function update($id,Request $request ){
        $request->validate([
            // 'name'          =>  'required',
            // // 'visitor_email' => 'required|email|unique:visitor',
            // // 'visitor_mobile_no'       => 'required|integer|max:9',
            // 'address'       => 'required|string|max:255',
            // // 'visitor_meet'  => 'required|string|max:255',
            // 'dept'          => 'required|string|max:255',
            // 'reason'        => 'required|string|max:255',

            // 'password'      =>  'required|min:6',
            'name'          =>  'required',
            'visitor_email' => 'required|email',
            'visitor_mobile_no'       =>  'required|numeric|digits_between:1,10',
            'address'       => 'required|string|max:255',
            'visitor_meet'  => 'required|string|max:255',
            'dept'          => 'required|string|max:255',
            'reason'        => 'required|string|max:255',
            // 'enter_time'    =>'required',
            'out_time'      =>'required',
        ]);

        $visitor =Visitor::find($id);
            $visitor->visitor_name = $request['name'];
             $visitor->visitor_email     = $request['visitor_email'];
            // 'password' = Hash::make($request['password']);
            // 'type'     = 'User'
            $visitor->visitor_mobile_no    = $request['visitor_mobile_no'];
            $visitor->visitor_address    = $request['address'];
            // dd($request['visitor_meet']);
            $visitor->visitor_meet_person_name    = $request['visitor_meet'];
            $visitor->visitor_department    = $request['dept'];
            $visitor->visitor_reason_to_meet    = $request['reason'];
            // 'visitor_enter_time'    = Carbon::now()->toDateTimeString();
            $visitor->visitor_enter_time    =$visitor->visitor_enter_time;
            $visitor->visitor_outing_remark    = "null";
            if($request['out_time']=="Yes"){
            $visitor->visitor_out_time    =Carbon::now();
            $visitor->visitor_token=Null;
            }
            else{
                $visitor->visitor_out_time    =NUll;
                $visitor->visitor_token=$request['visitor_token'];
            }
            if($visitor->visitor_out_time== NUll){
                $visitor->visitor_status='In';
            }
            else{
                $visitor->visitor_status='Out';
            }
            // $visitor->visitor_status='In';
            $visitor->visitor_enter_by    = Auth::user()->id;
            $visitor->save();
            // dd("success");
            session()->flash('success1', 'You have Successfully Updated');
            return view('/visitor');
    }
//not required
    public function delete($id){
        $visitor=Visitor::find($id);
        $visitor->delete($id);
        return redirect()->back();
    }

    //below done
    public function entry($p){
        $visitor=Visitor::find($p);
        $visitor->visitor_department=Null;
        $visitor->visitor_meet_person_name=Null;
        $visitor->visitor_reason_to_meet=Null;
        // $visitor->visitor_token=Null;
        $new_department =$this->collection_departmentWithEnabledEmployee();

        // =Department::all();
        $readonly="readonly";
        $disabled1="";
        $visitor_all=Visitor::all();
        $url=url('/visitor/entry/create').'/'.$p;
        return view('visitor_add')->with(compact('visitor','url','new_department','visitor_all','readonly','disabled1'));
    }
    //below done
    public function entry_create(Request $request,$id){
        // dd("hello how are you");
        $request->validate([
            'name'          =>  'required',
            'visitor_email' => 'required|email',
            'visitor_mobile_no'       =>  'required|numeric|digits_between:1,10',
            'address'       => 'required|string|max:255',
            // 'visitor_meet'  => 'required|string|max:255',
            'dept'          => 'required',
            'reason'        => 'required|string|max:255',
            // 'enter_time'    =>'required',
            // 'out_time'      =>'required',
            // 'password'      =>  'required|min:6',
        ]);
        // dd($request['dept']);
        // $array=$request['dept'];


        // array_unique($array);
        // $data=$request->all();
        // User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
        // $visitor =Visitor::find();
        //     $visitor->visitor_name = $request['name'];
        //      $visitor->visitor_email     = $request['visitor_email'];
        //     // 'password' = Hash::make($request['password']);
        //     // 'type'     = 'User'
        //     $visitor->visitor_mobile_no    = $request['visitor_mobile_no'];
        //     $visitor->visitor_address    = $request['address'];
        //     $visitor->save();
            // dd($visitor->id);
            $date=new Visitor_date();
            $date->visitor_id =$id;
            $date->visitor_enter_by =Auth::user()->id;
            $date->visitor_enter_time=Carbon::now();
            $date->visitor_out_time= NUll;
            $date->visitor_status='In';

            if(Visitor_date::max('visitor_token')==Null){
                $maxValue=0;
                }
                else{
                $maxValue =Visitor_date::max('visitor_token');
                }
                // dd($maxValue);
                $visit=Visitor_date::latest()->first();
                // if($visit==NUll){
                //     $visit=
                // }
                if($visit==NUll){
                    $carb=Carbon::today();
                }
                else{
                $carb=new Carbon($visit['visitor_enter_time']);
                }
                if($carb->gt(Carbon::today()) ==true ){
                    $date->visitor_token= $maxValue+1;
                 }
                 else{
                    $visit=Visitor_date::all();
                    // dd($visit)
                    foreach($visit as $v){

                    $v->visitor_token=Null;
                    $v->visitor_status="Out";
                    $v->save();
                    }
                    $date->visitor_token= 1;
                 }
                 $date->save();
                //  dd($request['dept']);
        foreach($request['dept'] as $key => $item){
            // dd($key);
            foreach($item as $key1 => $emp){
                // echo "$emp".",";
                $visit_date_emp=new Visitor_dept_emp();
                $visit_date_emp->visitor_date_id =$date->id;
                $visit_date_emp->visitor_department=$key;
                $visit_date_emp->visitor_meet_person_name=$emp;
                $visit_date_emp->visitor_reason_to_meet=$request['reason'];
                // dd( $visit_date_emp);
                $visit_date_emp->save();
            }
            // dd();
        }
            // $visitor->visitor_token=$request['visitor_token'];

         session()->flash('success1', 'You have Successfully Registered');

        // dd("success");
        return redirect('/visitor/info');

    }
    //below done
    public function visitor_out($id){
        // dd("hello");
        $visitor =Visitor_date::find($id);

            $visitor->visitor_out_time = Carbon::now();
            // dd($visitor->visitordatesofvisitor->visitor_out_time);
            // $visitor->visitor_token=Null;
            // dd( $visitor->visitordatesofvisitor->visitor_status);
            $visitor->visitor_status='Out';
            // $visitor->visitor_department=$visitor->visitor_department;
            $visitor->save();
            // dd("success");
            // $dept=Department::all();
            session()->flash('success1', 'The Out status has been updated');
            return redirect('/visitor/info');
    }

}

