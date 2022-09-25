@extends('dashboard')

@section('content')

@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
@endif
<div class="page-heading">
    <h1 class="page-title">Edit Department</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/information"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Edit Department</li> --}}
    </ol>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Edit Department</div>
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
                <form method="POST" action="{{ route('department.edit_validation') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Department Name <span class="text-danger">*</span></label>
		        		<input type="text" name="department_name" class="form-control" value="{{ $data->department_name }}" />
		        		@if($errors->has('department_name'))
		        			<span class="text-danger">{{ $errors->first('department_name') }}</span>
		        		@endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Department Status <span class="text-danger">*</span></label>
                        <br>
                        <p fontsize="10px;">Enable
                        <input name="dept_status" class="dept_status" {{ ($data->department_status == "Enable" )? 'checked' : '' }} type="radio" value="Enable"><br>
                            Disable
                        <input name="dept_status" class="dept_status" {{ ($data->department_status == "Disable" )? 'checked' : '' }} type="radio" value="Disable"><br>
                        @if($errors->has('dept_status'))
                            <span class="text-danger">{{ $errors->first('emp_status') }}</span>
                        @endif
                        </p>
                        </div>
                    </div>



                    <div  class="form-group">
                        <input type="hidden" name="hidden_id" value="{{ $data->id }}" />
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
            $('.dept_status').on('change', function() {
		    $('.dept_status').not(this).prop('checked', false);
		});

    });
        </script>
@endsection


