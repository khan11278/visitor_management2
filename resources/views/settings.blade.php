@extends('dashboard')
@section('content')
@if(session()->has('settings'))
<div class="alert alert-success mt-5">
    {{ session()->get('settings') }}
</div>
@endif
<div class="page-heading">
    <h1 class="page-title">Settings</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/information"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Settings</li> --}}
    </ol>
</div>
<div hh class="row">
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Logo Upload</div>
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
                <form method="POST" action="{{$url}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="m-2">Upload your Logo <span class="text-danger">*</span></label>
                            <input onchange="temp_url(this)" type="file"  id="myFileInput" class="form-control m-1" name="logo_upload">
                            <div class="col-md-6">
                                <img id="imgPreview"  class="form-control m-2" height="100" width="200" src="{{asset('uploads/'.$logo->folder_path)}}" alt="Preview">
                            </div>
                            @if($errors->has('logo_upload'))
		        		<span class="text-danger">{{ $errors->first('logo_upload') }}</span>
		        		@endif
                        </div>

                    </div>


                    <div   class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
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


    $("document").ready(function(){
        setTimeout(function(){
           $("div.alert").remove();
        }, 5000 ); // 5 secs

    });


     </script>
@endsection

