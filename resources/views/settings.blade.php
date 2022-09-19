@extends('dashboard')
@section('content')

@if(session()->has('settings'))
<div class="alert alert-success mt-5">
    {{ session()->get('settings') }}
</div>
@endif
<h2 class="mt-5">Settings</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
    	<li class="breadcrumb-item active">Settings</li>
  	</ol>
</nav>

<div class="row mt-4">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">Add New Logo</div>
			<div class="card-body">
				<form method="POST" action="{{$url}}"  enctype="multipart/form-data">
                    @csrf
    {{-- <label for="logo_upload" class="form-control m-1">{{ __('Upload your logo') }}</label> --}}

    <label class="m-2"><b>Upload your Logo *</b></label>
    <input onchange="temp_url(this)" type="file"  id="myFileInput" class="form-control m-1" name="logo_upload">
    {{-- @if($logo->folder_path != ""){
    <h4 id="imgPreview_e_11" class="form-control">uploads/{{$logo->folder_path}}</h4>
    <img id="imgPreview_e"  class="form-control" height="80" src="{{asset('uploads/'.$logo->folder_path)}}" alt="Preview">
    }
    @endif --}}
    <div class="col-md-4">
        <img id="imgPreview"  class="form-control m-2" height="80" src="{{asset('uploads/'.$logo->folder_path)}}" alt="Preview">
    </div>
    @error('logo_upload')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group mb-3">
        <input type="submit" class="btn btn-sm btn-primary m-2" value="Save" />
    </div>
</form>
</div>
</div>
</div>
</div>


 <script>
    $(document).ready(function(){
        $("#imgPreview").hide();
    });
            function temp_url(e){
            // $("#imgPreview_e").hide();
            // $("#imgPreview_e_11").hide();
            $("#imgPreview").show();
		const reader = new FileReader();
        console.log(reader);
		reader.addEventListener("load",()=>{
			localStorage.setItem("recent-image",reader.result);
            document.getElementById("imgPreview").setAttribute("src",reader.result);
		});
        console.log(e.files[0]);
        reader['readAsDataURL'](e.files[0]);
		// reader.readDataURL(e.files[0]);
    }

	document.addEventListener("DOMContentLoaded",() =>{
   	const recentImageDataUrl=localStorage.getItem("recent-image");
   	if(recentImageDataUrl){
   		document.querySelector("imgPreview").setAttribute("src",recentImageDataUrl);
   	}
	});
 </script>
 <script>
    $("document").ready(function(){
        setTimeout(function(){
           $("div.alert").remove();
        }, 5000 ); // 5 secs

    });
    </script>

@endsection
