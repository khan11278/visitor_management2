@extends('dashboard')

@section('content')
@if(session()->has('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div>
	@endif
<div class="page-heading">
    <h1 class="page-title">Department Management</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Department Management</li> --}}
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Department</div>
            {{-- <div><a href="/department/add" class="fa fa-plus fa-lg float-end">Add</a></div> --}}
            <div><a href="/department/add"><i class="fa fa-plus fa-md float-end"></i> Add</a></div>
        </div>
        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="department_table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Department Name</th>
                        <th>Department Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Department Name</th>
                        <th>Department Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data as $depart)
                    <tr>
                    <td>{{$depart->department_name}}</td>
                    <td>
                        @if($depart->department_status=="Enable")
                        <label class="switch">
                          <input type="checkbox" class="Statusupdate" checked name="status" id="status-{{$depart->id}}" data-id={{$depart->id}} value="Enable">
                          <span class="slider round"></span>
                        </label>
                      @else
                      <label class="switch">
                          <input type="checkbox" class="Statusupdate" name="status" id="status-{{$depart->id}}" data-id={{$depart->id}} value="Disable">
                          <span class="slider round"></span>
                        </label>
                      @endif

                    </td>
                    <td>{{$depart->created_at}}</td>
                    <td>{{$depart->updated_at}}</td>
                    {{-- <td>{{$depart->user_status}}</td> --}}
                    <td>
                        <a href="/department/edit/{{$depart->id}}" class="fa fa-pencil fa-lg"></a>
                        {{-- <a href="/sub_user/edit/{{$subuser->id}}" class="fa fa-pencil fa-lg"></a> --}}
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
        $('#department_table').DataTable({
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
            console.log("hello");
        var edit_id = $(this).data('id');
        var name = $('#status-'+edit_id).val();
        // console.log(edit_id +name);
// $User_status=$(this).val();
// $("#visitor_meet").html('');
$.ajax({
    type:'POST',

    url: "{{url('department_status')}}",
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
