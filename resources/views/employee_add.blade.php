@extends('dashboard')

@section('content')

@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
@endif
<div class="page-heading">
    <h1 class="page-title">{{$title}}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/information"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">{{$title}}</li> --}}
    </ol>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">{{$title}}</div>
                {{-- <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item">option 1</a>
                        <a class="dropdown-item">option 2</a>
                    </div>
                </div> --}}
            </div>
            <div class="ibox-body">
                <form method="POST" action="{{ $url }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Employee Name <span class="text-danger">*</span></label>
		        		<input type="text" name="name" class="form-control" value="{{old('name', $employee->name)}}" placeholder="Name" />
		        		@if($errors->has('name'))
		        		<span class="text-danger">{{ $errors->first('name') }}</span>
		        		@endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Employee Email <span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" value="{{old('name', $employee->email)}}" placeholder="Email">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Employee department <span class="text-danger">*</span></label>
                        <br>

                        <p fontsize="10px;">
                        @foreach($department as $dept)
                        <small>{{$dept->department_name}}</small>&nbsp;
                         @if($dept->department_status =="Disable")
                         {{-- <span class="text-danger"><small>{{$dept->department_name}}</small></span>&nbsp; --}}
                        <input name="dept[]"  type="checkbox" onclick="this.checked=!this.checked;"  {{ in_array($dept->id, $arr) ? 'checked' : '' }} value="{{$dept->id}}">
                        @else
                        {{-- <small>{{$dept->department_name}}</small>&nbsp; --}}
                        <input name="dept[]"  type="checkbox"  {{ in_array($dept->id, $arr) ? 'checked' : '' }} value="{{$dept->id}}">

                        @endif
                            <br>
                        @endforeach
                        @if($errors->has('dept'))
		        			<span class="text-danger">{{ $errors->first('dept') }}</span>
		        		@endif
                    </p>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Employee Status <span class="text-danger">*</span></label>
                            <br>
                            <p fontsize="10px;">Enable
                            <input name="emp_status" class="emp_status" {{ ($employee->employee_status == "Enable" )? 'checked' : '' }} type="radio" value="Enable"><br>
                                Disable
                            <input name="emp_status" class="emp_status" {{ ($employee->employee_status == "Disable" )? 'checked' : '' }} type="radio" value="Disable"><br>
                            @if($errors->has('emp_status'))
                                <span class="text-danger">{{ $errors->first('emp_status') }}</span>
                            @endif
                            </p>
                        </div>

                    </div>



                    <div  class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <a href="{{ url()->previous() }}"><button class="btn btn-secondary mx-1" type="button">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
               $("div.alert").remove();
            }, 5000 ); // 5 secs

        });
        $(document).ready(function() {
            $(document).ready(function(){
            $('.emp_status').on('change', function() {
		    $('.emp_status').not(this).prop('checked', false);
		});
    });
    });
        </script>
@endsection


