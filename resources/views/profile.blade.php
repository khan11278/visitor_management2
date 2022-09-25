@extends('dashboard')
@section('content')
@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
@endif
<div class="page-heading">
    <h1 class="page-title">Profile</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/information"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Profile</li> --}}
    </ol>
</div>
<div  class="row">
    <div class="col-md-6 col-sm-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Profile Details</div>
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
                <form method="post" action="{{ route('profile.edit_validation') }}">
                    @csrf
                    <div class="">
                        <div class="col-sm-12 col-lg-12 form-group">
                            <label>User Name <span class="text-danger">*</span></label>
                            {{-- <input class="form-control" type="text" placeholder="First Name"> --}}
                            <input type="text" name="name" class="form-control" placeholder="name" value="{{ $data->name }}" />
                            @if($errors->has('name'))
		        		        <span class="text-danger">{{ $errors->first('name') }}</span>
		        		    @endif
                        </div>
                        <div class="col-sm-12 col-lg-12 col-lg-6 form-group">
                            <label>User Email <span class="text-danger">*</span></label>
		        		<input type="text" name="email" class="form-control" placeholder="Email" value="{{ $data->email }}" />
		        		@if($errors->has('email'))
		        		<span class="text-danger">{{ $errors->first('email') }}</span>
		        		@endif
                        </div>
                    </div>
                    <div {{$hidden}} class="form-group col-sm-12 col-lg-12">
                        <label>Password</label>
		        		<input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>

                    <div  {{$hidden}} class="form-group col-sm-12 d-flex justify-content-lg-start justify-content-center">
                        <button class="btn btn-primary" type="submit">Submit</button>
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
        </script>
@endsection

