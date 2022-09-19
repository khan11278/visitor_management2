@extends('dashboard')

@section('content')

<h2 class="mt-5">Visitor Management</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
    	<li class="breadcrumb-item"><a href="/visitor">Visitor</a></li>
    	<li class="breadcrumb-item active">Add New Visitor</li>
  	</ol>
</nav>


<div class="row mt-4">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Add New Visitor</div>
			<div class="card-body">
				<form method="POST" action="{{$url}}">
                    {{-- <form method="POST"> --}}
                        {{-- {{Session::get('success')}} --}}
					@csrf
                    <div class="row">
					<div class="form-group mb-3 col-4">
		        		<label><b>Visitor Name *</b></label>
		        		<input type="text" name="name" class="form-control " {{$readonly}} placeholder="Name" value="{{old('name', $visitor->visitor_name)}}" />
		        		@if($errors->has('name'))
		        		<span class="text-danger">{{ $errors->first('name') }}</span>
		        		@endif
		        	</div>

		        	<div class="form-group mb-3 col-4">
		        		<label><b>Visitor Email *</b></label>
		        		<input type="text" name="visitor_email" class="form-control " {{$readonly}} placeholder="Email" value="{{old('visitor_email',$visitor->visitor_email)}}">
		        		@if($errors->has('visitor_email'))
		        			<span class="text-danger">{{ $errors->first('visitor_email') }}</span>
		        		@endif
		        	</div>
                    <div class="form-group mb-3 col-4">
		        		<label><b>Visitor Mobile Number *</b>(9 digits only)</label>

		        		<input type="number" name="visitor_mobile_no" class="form-control " {{$readonly}} placeholder="Mobile Number" value="{{old('visitor_mobile_no',$visitor->visitor_mobile_no)}}">
		        		@if($errors->has('visitor_mobile_no'))
		        			<span class="text-danger">{{ $errors->first('visitor_mobile_no') }}</span>
		        		@endif
		        	</div>
                </div>
                <div class="row">
                    <div class="form-group mb-3 col-4">
		        		<label><b>Visitor Address *</b></label>
		        		{{-- <input type="text" name="address" class="form-control " placeholder="Address"> --}}
		        		<input type="text" name="address" class="form-control " {{$readonly}} placeholder="Visitor address" value="{{old('address',$visitor->visitor_address)}}">
                        @if($errors->has('address'))
		        			<span class="text-danger">{{ $errors->first('address') }}</span>
		        		@endif
		        	</div>

                    <div class="form-group mb-3 col-4">
		        		<label><b>Visitor Reason To meet *</b></label>
		        		<input type="text" name="reason" class="form-control " placeholder="Visitor reason to meet" value="{{old('reason',$visitor->visitor_reason_to_meet)}}">
		        		@if($errors->has('reason'))
		        			<span class="text-danger">{{ $errors->first('reason') }}</span>
		        		@endif
		        	</div>
                    {{-- <div class="form-group mb-3 col-4">
		        		<label><b>Visitor Department *</b></label>
        `                   <select name="dept" id="depart-dd"  class="form-control " >
                                <option value="" {{$disabled1}}>Null</option>
                            @foreach ($dept as $department)
                            @if(old('dept',$visitor->visitor_department)==$department->department_name )
                                <option value="{{$department->id}}" selected>{{$department->department_name}}</option>
                            @else
                            <option value="{{$department->id}}" {{$disabled1}}>{{$department->department_name}}</option>
                            @endif
                            @endforeach
                        </select>
		        		@if($errors->has('dept'))
		        			<span class="text-danger">{{ $errors->first('dept') }}</span>
		        		@endif
		        	</div> --}}

                    {{-- <div class="form-group mb-3 col-4">
		        		<label><b>Visitor meet person name *</b></label>

                            <select id="visitor_meet" name="visitor_meet" class="form-control ">
                            </select>

                        @if($errors->has('visitor_meet'))
		        			<span class="text-danger">{{ $errors->first('visitor_meet') }}</span>
		        		@endif
		        	</div> --}}
                </div>
                    {{-- <div class="form-group mb-3">
		        		<label><b>Visitor enter time *</b></label>
		        		<input type="datetime-local" name="enter_time" class="form-control " value="{{old('enter_time',$visitor->visitor_enter_time)}}">
		        		@if($errors->has('enter_time'))
		        			<span class="text-danger">{{ $errors->first('enter_time') }}</span>
		        		@endif
		        	</div> --}}
                    <div class="row">
                        <div class="form-group mb-3">
                            <label><b>Visitor Meet Person Name *</b></label>
                            <br>
                            {{-- <b> {{$employee->department['department_name']}}</b> --}}
                            <p fontsize="10px;">
                            @foreach($new_department as $dept1)
                            <small>{{$dept1->department_name}}:</small>&nbsp;&nbsp;&nbsp;&nbsp;
                            @foreach($dept1->employee as $emp)
                                @if($emp->employee_status =="Enable")
                           <label> <input name="dept[{{$dept1->id}}][]"  type="checkbox"  value="{{$emp->id}}">{{$emp->name}} </label>
                                @endif
                            {{-- @if($errors->has('dept'))
                                <span class="text-danger">{{ $errors->first('dept') }}</span>
                            @endif --}}
                            @endforeach
                                <br><br>
                            @endforeach
                            @if($errors->has('dept'))
                                <span class="text-danger">{{ $errors->first('dept') }}</span>
                            @endif
                        </p>
                        </div>
                    {{-- <div class="form-group mb-3 col-4">
		        		<label><b>Visitor Out Status *</b></label>
                        <br>
		        		{{-- <input type="datetime-local" name="out_time" class="form-control " value="{{old('out_time',$visitor->visitor_out_time)}}"> --}}
		        		{{--<p fontsize="10px;">Yes
                        <input name="out_time" class="visitor_out_status" type="checkbox" value="Yes">
                        No
                        <input name="out_time" class="visitor_out_status" type="checkbox" value="No">
                        @if($errors->has('out_time'))
		        			<span class="text-danger">{{ $errors->first('out_time') }}</span>
		        		@endif
                        </p>
		        	</div> --}}

                    {{-- <div class="form-group mb-3 col-4">
		        		<label><b>Visitor Token *</b></label>
		        		  <select name="visitor_token" id="visitor_token"  class="form-control " >
                                <option value="{{old('visitor_token',$visitor->visitor_token)}}" @if($visitor->visitor_token==Null){{"hidden"}}@else{{""}}@endif selected>{{old('visitor_token',$visitor->visitor_token)}}</option>

                            @for($i=1;$i<=30;$i++)
                            {{$count=0;}}
                            @foreach ($visitor_all as $v_all)
                            @if($v_all->visitor_token == $i)

                               {{ $count++ ;}}
                            @endif

                            @endforeach
                            @if($count<1)

                                <option value="{{$i}}" {{$disabled1}}>{{$i}}</option>
                            @endif
                            @endfor
                        </select>
		        		@if($errors->has('visitor_token'))
		        			<span class="text-danger">{{ $errors->first('visitor_token') }}</span>
		        		@endif
		        	</div> --}}
                </div>
		        	{{-- <div class="form-group mb-3">
		        		<label><b>Password</b></label>
		        		<input type="password" name="password" class="form-control " placeholder="Password">
		        		@if($errors->has('password'))
		        			<span class="text-danger">{{ $errors->first('password') }}</span>
		        		@endif
		        	</div> --}}
		        	<div class="form-group mb-3">
		        		<input type="submit" class="btn btn-sm btn-primary" value="Save" />
		        	</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $("#depart-dd").change(function(){
    // alert("The text has been changed.");
    // console.log(11);
    $department=$(this).val();
    $("#visitor_meet").html('');
    $.ajax({
        type:'POST',
        // url:url('visitor_meet'),
        url: "{{url('visitor_meet')}}",
        dataType:"json",
        // data:$department,
        data: {
            depart:$department,
            _token: '{{csrf_token()}}'
        },
        success: function (result) {
        //    $("#msg").html(data.msg);
        $.each(result.dept, function (key, value) {
            // var nameArr = $(this).split(',');
            // console.log(nameArr);
            // var j="@php $visitor->visitor_meet_person_name @endphp";
            // if(j==value['name']){
            $("#visitor_meet").append('<option  value="' + value['id'] + '">' + value['name'] + '</option>');
            // }
            // else{
            //     $("#visitor_meet").append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
            // }
            console.log(value['id']);
            /////////////////
            // console.log(value.contact_person);
            // console.log("////////////////");
            // cont_per =value.contact_person.split(',');
            // console.log(cont_per);
            // console.log("////////////////");

            //////////////////
            // var j=@php $visitor->visitor_meet_person_name @endphp;
            // var j="@php echo $visitor->visitor_meet_person_name; @endphp" ;
            // console.log(j);

            ////////////
        //     for(var i=0;i<cont_per.length;i++){
        //         // if(j==cont_per[i]){
        //     $("#visitor_meet").append('<option  value="' + cont_per[i] + '">' + cont_per[i] + '</option>');
        //         // }
        //     // else{
        //     // $("#visitor_meet").append('<option value="' + cont_per[i] + '">' + cont_per[i] + '</option>');
        //     // }
        // }

        //////////////////
                        });
    //         $('#visitor_meet').append($('<option>', {
    //     value: value.contact_person,
    //     text : value.contact_person
    // }));

        console.log(result.dept);
        }
     });
  });

  $('.visitor_out_status').on('change', function() {
		    $('.visitor_out_status').not(this).prop('checked', false);
		});

// ///////////////

});

//////////////////////
// $(document).ready(function(){
//     // $("#depart-dd").change(function(){
//     // alert("The text has been changed.");
//     // console.log(11);
//     // var v_per="@php echo $visitor->visitor_meet_person_name; @endphp" ;
//     // console.log(v_per);
//     $department=$('#depart-dd').val();
//     // if($department==)
//     $("#visitor_meet").html('');
//     $.ajax({
//         type:'POST',
//         // url:url('visitor_meet'),
//         url: "{{url('visitor_meet')}}",
//         dataType:"json",
//         data:$department,
//         data: {
//             depart:$department,
//             _token: '{{csrf_token()}}'
//         },
//         success: function (result) {
//         //    $("#msg").html(data.msg);
//         $.each(result.dept, function (key, value) {
//             console.log(key);
//             // var nameArr = $(this).split(',');
//             // console.log(nameArr);
//             ////////////
//             // console.log(value.contact_person);
//             // console.log("////////////////");
//             // cont_per =value.contact_person.split(',');
//             // console.log(cont_per);
//             // console.log("////////////////");
//             ///////////
//             // ///////////var j=@php $visitor->visitor_meet_person_name @endphp;
//             //////////////
//         //     var j="@php echo $visitor->visitor_meet_person_name; @endphp" ;
//         //     var dis="@php if($url==route('visitor_create')){ echo " "; } else{ echo "disabled";} @endphp";
//         //     console.log("/////hello roshan////"+dis +"//////////////////"+ j);
//         //     for(var i=0;i<cont_per.length;i++){
//         //         console.log(cont_per[i]);
//         //         if(j==cont_per[i]){

//         //     $("#visitor_meet").append('<option selected value="' + cont_per[i] + '">' + cont_per[i] + '</option>');
//         //         }
//         //     else{
//         //     $("#visitor_meet").append('<option '+ dis +' value="' + cont_per[i] + '" >' + cont_per[i] + '</option>');
//         //     }
//         // }
//         ////////////////////////
//                         });
//     //         $('#visitor_meet').append($('<option>', {
//     //     value: value.contact_person,
//     //     text : value.contact_person
//     // }));

//         // console.log(result.dept);
//         }
//      });

// });

    </script>

@endsection
