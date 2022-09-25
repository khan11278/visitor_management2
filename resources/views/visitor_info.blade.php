@extends('dashboard')

@section('content')
@if (session()->has('success1'))
        <div class="alert alert-success mt-2">
            {{ session()->get('success1') }}
        </div>
    @endif

<div class="page-heading">
    <h1 class="page-title">Visitor Entry</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Visitor Entry</li> --}}
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Visitor</div>
            {{-- <div><a href="employee/add" class="fa fa-plus fa-lg float-end"></a></div> --}}
            <div  @if (Auth::user()->type == 'Admin') {{ 'hidden' }} @endif>
                {{-- <a href="/visitor/add" class="fa fa-plus fa-lg float-end">Add</a> --}}
                <a href="/visitor/add"><i class="fa fa-plus fa-md float-end"></i> Add</a>
            </div>
        </div>
        <div class="ibox-body">

            <form  style="background-color:#bdc3c7" class="border  rounded m-1 p-1" action="">
                {{-- <div class="col-sm-3 form-group"> --}}
                    {{-- <div class="col-md-4" style="background-color: green"></div> --}}

                {{-- </div> --}}
                {{-- <h4><div class="col col-md-1 rounded text-center" style="background-color:rgb(175, 149, 33)" >Filter</div></h4> --}}
                <div class="row">
                    <div class="col-sm-3 form-group">
                        Visitor mobile:
                        {{-- <input type="text" class="form-control" list="visitor_mobile1" id="visitor_mobile1" name="visitor_mobile1"> --}}
                        <input type="text" id="visitor_mobile_2" class="form-control rounded" list="visitor_mobile1" />
                        <datalist id="visitor_mobile1">
                        @foreach($visitors as $vmob)
                            <option selected>{{$vmob->visitor_mobile_no}}</option>
                        @endforeach
                        </datalist>
                    </div>


                    <div class="col-sm-3 form-group">
                        {{-- <br><input type="button" class="btn btn-danger btn-sm" value="Reset" onClick="window.location.reload()"> --}}
                       <br> <input type="reset"  id="reset1" class="btn btn-danger btn-sm" value="Reset" >
                    </div>

                    <div class="col-sm-3 form-group">
                    <br><p id="table_info"></p>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-bordered table-hover" id="visitor_info" cellspacing="0" width="100%">
                <thead>
                    <tr>
                            <th>Visitor Name</th>
                            <th>Visitor Email</th>
                            <th>Visitor Mobile Number</th>
                            <th>Visitor Address</th>
                            <th>Status</th>
                            <th>Last Visit Date</th>
                            <th {{$hidden1}}>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Visitor Name</th>
                        <th>Visitor Email</th>
                        <th>Visitor Mobile Number</th>
                        <th>Visitor Address</th>
                        <th>Status</th>
                        <th>Last Visit Date</th>
                        <th {{$hidden1}}>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($visitors as $visitor)
                            <tr>
                                <td> {{ $visitor->visitor_name }}</td>
                                <td> {{ $visitor->visitor_email }}</td>
                                <td> {{ $visitor->visitor_mobile_no }}</td>
                                <td> {{ $visitor->visitor_address}}</td>
                                <td>

                                    @if ($visitor->action->visitor_status == 'In')
                                    <span class="badge badge-pill badge-success">In</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">Out</span>
                                    @endif
                                </td>
                                <td> {{ $visitor->action->visitor_enter_time }}</td>
                               <td {{$hidden1}}>

                                    @if ($visitor->action->visitor_status == 'Out')
                                    <form action="/visitor/entry/{{ $visitor->id }}" method="get">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Create</button>
                                    </form>
                                    @else
                                        <form action="/visitor/out/{{$visitor->action->id}}" method="post">
                                            @csrf
                                            <button class="btn btn-danger btn-sm ">Out</button>
                                        </form>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        var table=  $('#visitor_info').DataTable({
            pageLength: 10,
            ordering: false ,
            responsive: true,
            scrollX: true,

        });

        $('#visitor_mobile_2').on('input', function() {
                    // console.log("Roshan "+this.value);
                    table.columns(2).search(this.value).draw();
                    // var info2 = $('#visitor_table').DataTable().page.info();
                    // $("#table_info").text("Total Count:"+info2.recordsDisplay);
                });
                $('#reset1').on('click', function() {
                table.columns(2).search("").draw();
                });

                setTimeout(function(){
                    $("div.alert").remove();
                    }, 5000 ); // 5 secs
    } );
    </script>


@endsection
