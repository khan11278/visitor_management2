@extends('dashboard')

@section('content')
<h2 class="mt-5">Analytics</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
    	{{-- <li class="breadcrumb-item"><a href="/sub_user">Sub Management</a></li> --}}
    	<li class="breadcrumb-item active">Information</li>
  	</ol>
</nav>

<div class="row mt-12">
	<div class="col-md-3">
		<div class="card bg-primary text-white">
            <div class="card-body">Total Today Visitor<br>{{$todayCount}}</div>

          </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">Total Yesterday Visitor<br>{{$yesterdayCount}}</div>
          </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">Total Last 7 Days Visitors<br>{{$weekCount}}</div>
          </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">Total Visitor Till Day<br>{{$totalCount}}</div>
          </div>
    </div>
</div>

@endsection
