@extends('dashboard')

@section('content')
@if(session()->has('employee_update'))
    <div class="alert alert-success mt-2">
        {{ session()->get('employee_update') }}
    </div>
    @endif
@if(session()->has('employee_register'))
    <div class="alert alert-success mt-2">
        {{ session()->get('employee_register') }}
    </div>
    @endif
<div class="page-heading">
    <h1 class="page-title">Employee Management</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Employee Management</li> --}}
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Employee</div>
            <div><a href="employee/add"><i class="fa fa-plus fa-md float-end"></i> Add</a></div>
        </div>
        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="employee_table1" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Employee Department</th>
                        <th>Employee Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Employee Name</th>
							<th>Employee Email</th>
							<th>Employee Department</th>
                            <th>Employee Status</th>
							<th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($employee as $emp)
                        <tr>
                            <td>{{$emp->name}}</td>
                            <td>{{$emp->email}}</td>
                            <td>

                                @foreach($emp->department as $depart)
                             {{$depart['department_name']}}
                                @endforeach
                            </td>
                            <td>
                                @if($emp->employee_status=="Enable")
                                <label class="switch">
                                  <input type="checkbox" class="Statusupdate" checked name="status" id="status-{{$emp->id}}" data-id={{$emp->id}} value="Enable">
                                  <span class="slider round"></span>
                                </label>
                              @else
                              <label class="switch">
                                  <input type="checkbox" class="Statusupdate" name="status" id="status-{{$emp->id}}" data-id={{$emp->id}} value="Disable">
                                  <span class="slider round"></span>
                                </label>
                              @endif
                            </td>
                            <td> <a href="/employee/edit/{{$emp->id}}" class="fa fa-pencil fa-lg"></a>
                                {{-- <a href="/employee/delete/{{$emp->id}}" class="btn btn-danger btn-sm">Delete</a> --}}
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#employee_table1').DataTable({
            pageLength: 10,
            responsive: true,
            scrollX: true,

        });
    })
</script>
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $("div.alert").remove();
        }, 5000 ); // 5 secs

        $(document).on("click", ".Statusupdate" , function() {
            // console.log("hello");
        var edit_id = $(this).data('id');
        var name = $('#status-'+edit_id).val();
// $User_status=$(this).val();
// $("#visitor_meet").html('');
$.ajax({
    type:'POST',

    url: "{{url('employee_status')}}",
    dataType:"json",

    data: {
        editid: edit_id,
        statusName: name,
        _token: '{{csrf_token()}}'
    },
    success: function(response){
       console.log("Data added Sucessfully");
      }
 });
});


    });
    </script>

@endsection
