@extends('dashboard')

@section('content')
{{-- <script>
alert(<h6>{{Session::get('success')}}</h6>);
</script> --}}
{{-- @if(session()->has('success1'))
		<div class="alert alert-success">
			{{ session()->get('success1') }}
		</div>
	@endif --}}
    @if(session()->has('employee_update'))
    <div class="alert alert-success mt-5">
        {{ session()->get('employee_update') }}
    </div>
    @endif
@if(session()->has('employee_register'))
    <div class="alert alert-success mt-5">
        {{ session()->get('employee_register') }}
    </div>
    @endif
{{-- <h6>{{Session::get('success')}}</h6> --}}
<h2 class="mt-5">Employee Management</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
    	<li class="breadcrumb-item active">Employee</li>
  	</ol>
</nav>
<div class="mt-4 mb-4">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col col-md-8">Employee Management</div>
               {{-- <p> {{URL::current()}} </p> --}}
				<div class="col col-md-4"  >
                    <a href="employee/add" class="btn btn-success btn-sm float-end">Add</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">

                <table class="table table-bordered" id="employee_table1">

                    <thead>
						<tr>
							<th>Employee Name</th>
							<th>Employee Email</th>
							<th>Employee Department</th>
                            <th>Employee Status</th>
							<th>Action</th>
						</tr>
					</thead>
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
                            <td>{{$emp->employee_status	}}</td>
                            <td><a href="/employee/edit/{{$emp->id}}" class="btn btn-primary btn-sm">Edit</a>
                                {{-- <a href="/employee/delete/{{$emp->id}}" class="btn btn-danger btn-sm">Delete</a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
							<th>Visitor Name</th>
                            <th>Visitor Mobile Number</th>
                            <th>Visitor Token</th>
							<th>Meet Person Name</th>
                            <th>Department</th>
							<th>In Time</th>
							<th>Out Time</th>
							<th>Status</th>
							<th>Enter By</th>
							<th>Action</th>
						</tr>
                    </tfoot> --}}
				</table>
			</div>
		</div>
	</div>
</div>


<script>
    // $(document).ready( function () {
    // $('#employee_table').DataTable();
    // } );
    $("document").ready(function(){
        $('#employee_table1').DataTable();

        setTimeout(function(){
           $("div.alert").remove();
        }, 5000 ); // 5 secs


    //    var $emp= $('#employee_table').DataTable();
    //    console.log($emp);
        // $('#employee_table').DataTable();
    });
    </script>

@endsection
