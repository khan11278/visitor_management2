@extends('dashboard')

@section('content')

@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
@endif
<div class="page-heading">
    <h1 class="page-title">Edit Sub User</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/information"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Edit Sub user</li> --}}
    </ol>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Edit Sub User</div>
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
                <form method="POST" action="{{ route('sub_user.edit_validation') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>User Name <span class="text-danger">*</span></label>
		        		<input type="text" name="name" class="form-control" placeholder="Name" value="{{ $data->name }}" />
		        		@if($errors->has('name'))
		        		<span class="text-danger">{{ $errors->first('name') }}</span>
		        		@endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>User Email <span class="text-danger">*</span></label>
		        		<input type="text" name="email" class="form-control" placeholder="Email" value="{{ $data->email }}">
		        		@if($errors->has('email'))
		        			<span class="text-danger">{{ $errors->first('email') }}</span>
		        		@endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>User Status <span class="text-danger">*</span></label>
                            <br>
                            <p fontsize="10px;">Enable
                            <input name="user_status" class="user_status" {{old('user_status',$data->user_status)=="Enable" ?"checked" :""}} type="radio" value="Enable">&nbsp;&nbsp;&nbsp;
                                Disable
                            <input name="user_status" class="user_status" {{old('user_status',$data->user_status)=="Disable" ?"checked" :""}} type="radio" value="Disable"><br>
                            @if($errors->has('user_status'))
                                <span class="text-danger">{{ $errors->first('user_status') }}</span>
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
        $(document).ready(function(){
            $('.user_status').on('change', function() {
		    $('.user_status').not(this).prop('checked', false);
		});
    });
        </script>
@endsection


