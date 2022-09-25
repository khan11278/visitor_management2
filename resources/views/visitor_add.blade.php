@extends('dashboard')

@section('content')

@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
@endif
<div class="page-heading">
    <h1 class="page-title">Add New Visitor</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/information"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Add New Visitor</li> --}}
    </ol>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Visitor Detail Form</div>

            </div>
            <div class="ibox-body">
                <form method="POST" action="{{$url}}">
                    @csrf
                    <div class="col-sm-12 col-lg-6 p-1" style="border: thin solid #bdc3c7;border-radius: 10px;">
                        {{-- <p><h5>Visitor Personal Inforamtion</h5></p> --}}
                        <div class="col-sm-12 form-group">
                            <h4>Visitor Personal Inforamtion</h4>
                        </div>
                        <div class="col-sm-12 col-lg-12 form-group"  title="Please Fill the visitor name!">
                            <label>Visitor Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control " {{$readonly}} placeholder="Name" value="{{old('name', $visitor->visitor_name)}}" />
                            @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-12 col-lg-12 form-group" title="Please Fill the visitor Email!">
                            <label>Visitor Email <span class="text-danger">*</span></label>
		        		<input type="text" name="visitor_email" class="form-control " {{$readonly}} placeholder="Email" value="{{old('visitor_email',$visitor->visitor_email)}}">
		        		@if($errors->has('visitor_email'))
		        			<span class="text-danger">{{ $errors->first('visitor_email') }}</span>
		        		@endif
                        </div>
                        <div class="col-sm-12 col-lg-12  form-group" title="Please Fill the Visitor Mobile Number nine digits only!">
                            <label>Visitor Mobile Number <span class="text-danger">*</span>(9 digits only)</label>

		        		<input type="number" name="visitor_mobile_no" class="form-control " {{$readonly}} placeholder="Mobile Number" value="{{old('visitor_mobile_no',$visitor->visitor_mobile_no)}}">
		        		@if($errors->has('visitor_mobile_no'))
		        			<span class="text-danger">{{ $errors->first('visitor_mobile_no') }}</span>
		        		@endif
                        </div>
                        <div class="col-sm-12 col-lg-12 form-group" title="Please Fill the visitor address!">
                            <label>Visitor Address <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control " {{$readonly}} placeholder="Visitor address" value="{{old('address',$visitor->visitor_address)}}">
                            @if($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-1 col-sm-12 col-lg-6 mt-4" style="border: thin solid #bdc3c7;border-radius: 10px;">
                        <div class="col-sm-12 form-group">
                            <h4>Visitor visit Information</h4>
                        </div>
                        <div class="col-sm-12 col-lg-12 form-group" title="Please Fill the visitor reason of meet with the employee in department!">
                            <label>Visitor Reason To meet<span class="text-danger">*</span></label>
		        		<input type="text" name="reason" class="form-control " placeholder="Visitor reason to meet" value="{{old('reason',$visitor->visitor_reason_to_meet)}}">
		        		@if($errors->has('reason'))
		        			<span class="text-danger">{{ $errors->first('reason') }}</span>
		        		@endif
                        </div>
                        <div class="col-sm-12 col-lg-12 form-group" title="Please Tick the checkbox to whom visitor is going to meet!">
                            <label>Visitor Going To Meet to Whom <span class="text-danger">*</span></label>
                            <br>
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <small>
                                            <td>Department</td>
                                        <td>Persons In Department</td>
                                        </small>
                                    </tr>
                                </thead>
                                <tbody>
                            <p fontsize="10px;">
                            @foreach($new_department as $dept1)
                            <tr>
                           <td><b> <small>{{$dept1->department_name}}</small></b>&nbsp;&nbsp;&nbsp;&nbsp;<br></td>
                            <td>
                                {{-- @php $number = 0; @endphp --}}
                                @foreach($dept1->employee as $emp)
                                    @if($emp->employee_status =="Enable")
                                    {{-- @php $i=0;
                                    $i++;
                                    echo $i;
                                    @endphp --}}
                                    <label>
                                            <input name="dept[{{$dept1->id}}][]" class="mr-1" type="checkbox"  value="{{$emp->id}}" {{ (in_array($emp->id , (old('dept')[$dept1->id] ?? []))) ? 'checked ' : '' }}><small><span class="mr-3">{{$emp->name}}</span></small>
                                        </label>
                                     {{-- @php  $i++ ; @endphp --}}
                                        {{-- @php echo (isset(old('dept')[$dept1->id][$number]) ? old('dept')[$dept1->id][$number] : null) ; @endphp --}}
                                        {{-- @php echo in_array($emp->id , (old('dept')[$dept1->id] ?? [])) ; @endphp --}}
                                        {{-- {{ old('dept.'.$dept1->id.$emp->id) ?? "Old is not defined" }} --}}
                                        {{-- {{ (!empty(old()) && count(old('dept'))) ? dd(old('dept')[$dept1->id][$number]) : '' }} --}}
                                        {{-- @php echo $key ;@endphp --}}
                                        {{-- @php echo $number ; @endphp --}}
                                        {{-- @if(isset(old('dept')[$dept1->id][$number])) --}}
                                        {{-- @php $number++ ; @endphp --}}
                                    @endif

                                @endforeach
                                <br>
                            @endforeach

                            {{-- {{ (!empty(old()) && count(old('dept'))) ? dd(old('dept')) : '' }} --}}
                            </td>
                        </tr>
                        </p>




                        </tbody>
                    </table>
                    @if($errors->has('dept'))
                    <span class="text-danger">{{ $errors->first('dept') }}</span>
                    @endif
                        </div>


                    </div>


                    <div  class="form-group col-sm-12 col-lg-2 mt-1 d-flex justify-content-center">
                        <button class="btn btn-primary justify-content-center" type="submit">Submit</button>
                        <a href="{{ url()->previous() }}"><button class="btn btn-secondary mx-1" type="button">Cancel</button></a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#depart-dd").change(function(){

            $department=$(this).val();
            $("#visitor_meet").html('');
            $.ajax({
                type:'POST',
                url: "{{url('visitor_meet')}}",
                dataType:"json",
                data: {
                    depart:$department,
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                $.each(result.dept, function (key, value) {

                    $("#visitor_meet").append('<option  value="' + value['id'] + '">' + value['name'] + '</option>');

                    console.log(value['id']);

                                });


                console.log(result.dept);
                }
             });
          });

          $('.visitor_out_status').on('change', function() {
                    $('.visitor_out_status').not(this).prop('checked', false);
                });



        });



            </script>
@endsection


