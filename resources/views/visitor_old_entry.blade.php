@extends('dashboard')

@section('content')

<h2 class="mt-5">Department Management</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/visitor">Visitor Management</a></li>
            <li class="breadcrumb-item">Old Visitor Entry</li>
  	</ol>
</nav>
<div class="row mt-4">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">Old Visitor Entry</div>
			<div class="card-body">
				<form method="POST" action="{{route('visitor_old_entry_create')}}">
					@csrf
                    <div class="row">
                    <div class="col-sm-7">
                        Old Visitor mobile:
                        {{-- <input type="text" class="form-control" list="visitor_mobile1" id="visitor_mobile1" name="visitor_mobile1"> --}}
                        <input type="text" name="visitor_mobile_2" id="visitor_mobile_2" class="form-control" list="visitor_mobile1" />
                        <datalist id="visitor_mobile1">
                        @foreach($visitor_mob_distinct as $vmob)
                            <option value={{$vmob->visitor_mobile_no}}></option>
                        @endforeach
                        </datalist>
                    </div>
                    <div class="col-sm-7">
                    <div style="margin:5px 0px;">
                        <input type="submit" class="btn btn-danger btn-sm" value="Submit">
                        {{-- <input type="reset" id="reset1" class="btn btn-danger" value="Reset"> --}}
                    </div>
                    </div>
		        	</div>
                </div>
				</form>
			</div>
		</div>
	</div>


<script>

$(document).ready(function(){

});

</script>
@endsection
