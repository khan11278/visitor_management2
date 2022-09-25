@extends('dashboard')

@section('content')
@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
	@endif
<div class="page-heading">
    <h1 class="page-title">Sub User Management</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Sub User Management</li> --}}
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Sub user</div>
            {{-- <div><a href="{{ route('sub_user.add') }}" class="fa fa-plus fa-lg float-end">Add</a></div> --}}
            <div><a href="{{ route('sub_user.add') }}"><i class="fa fa-plus fa-md float-end"></i> Add</a></div>
        </div>
        <div class="ibox-body">


            <table class="table table-striped table-bordered table-hover" id="user_table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                            <th>Name</th>
							<th>Email</th>
							<th>Created At</th>
							<th>Updated At</th>
                            <th>User Stauts</th>
							<th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                            <th>Name</th>
							<th>Email</th>
							<th>Created At</th>
							<th>Updated At</th>
                            <th>User Stauts</th>
							<th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data as $subuser)
                    <tr>
                    <td>{{$subuser->name}}</td>
                    <td>{{$subuser->email}}</td>
                    <td>{{$subuser->created_at}}</td>
                    <td>{{$subuser->updated_at}}</td>
                    <td>

                        @if($subuser->user_status=="Enable")
                          <label class="switch">
                            <input type="checkbox" class="Statusupdate" checked name="status" id="status-{{$subuser->id}}" data-id={{$subuser->id}} value="Enable">
                            <span class="slider round"></span>
                          </label>
                        @else
                        <label class="switch">
                            <input type="checkbox" class="Statusupdate" name="status" id="status-{{$subuser->id}}" data-id={{$subuser->id}} value="Disable">
                            <span class="slider round"></span>
                          </label>
                        @endif

                    </td>
                    <td>
                        <a href="/sub_user/edit/{{$subuser->id}}" class="fa fa-pencil fa-lg"></a>
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
        $('#user_table').DataTable({
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

        // $('#user_table').DataTable();
        $(document).on("click", ".Statusupdate" , function() {
            // console.log("hello");
        var edit_id = $(this).data('id');
        var name = $('#status-'+edit_id).val();
// $User_status=$(this).val();
// $("#visitor_meet").html('');
$.ajax({
    type:'POST',

    url: "{{url('user_status')}}",
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
