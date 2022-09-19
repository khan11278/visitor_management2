@extends('dashboard')

@section('content')


<h2 class="mt-5">Employee Management</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
    	<li class="breadcrumb-item active"><a href="/employee">Employee Add</a></li>
    	{{-- <li class="breadcrumb-item active">Add New Sub User</li> --}}
  	</ol>
</nav>
<div class="row mt-4">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">Add New Employee</div>
			<div class="card-body">
				<form method="POST" action="{{ $url }}">
					@csrf
					<div class="form-group mb-3">
		        		<label><b>Employee Name *</b></label>
		        		<input type="text" name="name" class="form-control" value="{{old('name', $employee->name)}}" placeholder="Name" />
		        		@if($errors->has('name'))
		        		<span class="text-danger">{{ $errors->first('name') }}</span>
		        		@endif
		        	</div>
		        	<div class="form-group mb-3">
		        		<label><b>Employee Email *</b></label>
		        		<input type="text" name="email" class="form-control" value="{{old('name', $employee->email)}}" placeholder="Email">
		        		@if($errors->has('email'))
		        			<span class="text-danger">{{ $errors->first('email') }}</span>
		        		@endif
		        	</div>
                    {{-- <div class="form-group mb-3">
		        		<label><b>Employee Department*</b></label>
		        		<input type="text" name="dept" class="form-control" placeholder="Employee Department">
		        		@if($errors->has('dept'))
		        			<span class="text-danger">{{ $errors->first('dept') }}</span>
		        		@endif
		        	</div> --}}
                    <div class="form-group mb-3">
		        		<label><b>Employee department *</b></label>
                        <br>
                        {{-- <b> {{$employee->department['department_name']}}</b> --}}
                        <p fontsize="10px;">
                        @foreach($department as $dept)
		        		 <small>{{$dept->department_name}}</small>&nbsp;
                         @if($dept->department_status =="Disable")
                        <input name="dept[]"  type="checkbox" onclick="this.checked=!this.checked;"  {{ in_array($dept->id, $arr) ? 'checked' : '' }} value="{{$dept->id}}">
                        @else
                        <input name="dept[]"  type="checkbox"  {{ in_array($dept->id, $arr) ? 'checked' : '' }} value="{{$dept->id}}">
                            {{-- @if($dept->department_status == "Disable")
                            <span class="text-danger">This Department is Disable</span>

                            @endif --}}
                        @endif
                            <br>
                        @endforeach
                        @if($errors->has('dept'))
		        			<span class="text-danger">{{ $errors->first('dept') }}</span>
		        		@endif
                    </p>
		        	</div>
                    <div class="form-group mb-3">

                            <label><b>Employee Status *</b></label>
                            <br>
                            <p fontsize="10px;">Enable
                            <input name="emp_status" class="emp_status" {{ ($employee->employee_status == "Enable" )? 'checked' : '' }} type="checkbox" value="Enable"><br>
                                Disable
                            <input name="emp_status" class="emp_status" {{ ($employee->employee_status == "Disable" )? 'checked' : '' }} type="checkbox" value="Disable"><br>
                            @if($errors->has('emp_status'))
                                <span class="text-danger">{{ $errors->first('emp_status') }}</span>
                            @endif
                            </p>

		        	</div>
		        	<div class="form-group mb-3">
		        		<input type="submit" class="btn btn-sm btn-primary" value="Add" />
		        	</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
            $('.emp_status').on('change', function() {
		    $('.emp_status').not(this).prop('checked', false);
		});
    });
</script>
@endsection
