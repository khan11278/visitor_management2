@extends('dashboard')

@section('content')
    {{-- <script>
alert(<h6>{{Session::get('success')}}</h6>);
</script> --}}
    @if (session()->has('success1'))
        <div class="alert alert-success mt-5">
            {{ session()->get('success1') }}
        </div>
    @endif
    {{-- <h6>{{Session::get('success')}}</h6> --}}
    <h2 class="mt-5">Visitor Entry</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
            <li class="breadcrumb-item active">Visitor Management</li>
        </ol>
    </nav>
    <div class="mt-4 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-md-8">Visitor Management</div>
                    {{-- <p> {{URL::current()}} </p> --}}
                    <div class="col col-md-4" @if (Auth::user()->type == 'Admin') {{ 'hidden' }} @endif>
                        <a href="/visitor/add" class="btn btn-success btn-sm float-end btn-margin-left">New Visitor Add</a>
                        {{-- <a href="/visitor/old_entry" class="btn btn-success btn-sm float-end">Old Visitor Add</a> --}}
                        {{-- <input type="buttom" id="button1" class="btn btn-success btn-sm" value="Entry with mobile number"> --}}
                    </div>
                </div>
            </div>
            <div class="row " style="margin-bottom:-37px;">
                <div class="col-md-4" style="background-color: green"></div>
                <p id="table_info"></p>
            </div>
            <div class="card-body">

            </div>
            <div class="table table-margin">
                <form action="">
                    <div class="row">
                        <div class="col-sm-4">
                            Visitor mobile:
                            {{-- <input type="text" class="form-control" list="visitor_mobile1" id="visitor_mobile1" name="visitor_mobile1"> --}}
                            <input type="text" id="visitor_mobile_2" class="form-control" list="visitor_mobile1" />
                            <datalist id="visitor_mobile1">
                            @foreach($visitors as $vmob)
                                <option selected>{{$vmob->visitor_mobile_no}}</option>
                            @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-2" style="margin:5px 0px;">
                        <input type="reset"  id="reset1" class="btn btn-danger btn-sm" value="Reset" >
                        {{-- <input type="reset" id="reset1" class="btn btn-danger" value="Reset"> --}}

                    </div>
                </div>
                </form>
            </div>
                </form>
                {{-- <div style="margin:5px 0px;">

                    <input type="input" id="count" class="form-control"  value="Reset">
               </div> --}}
                <table class="table table-bordered" id="visitor_info">
                    {{-- <table id="visitor_table" class="display nowrap" style="width:100%"> --}}
                    <thead>
                        <tr>
                            <th>Visitor Name</th>
                            <th>Visitor Email</th>
                            <th>Visitor Mobile Number</th>
                            <th>Visitor Address</th>
                            <th>Status</th>
                            <th>Last Visit Date</th>
                            {{-- <th>Meet Person Name</th>
                            <th>Department</th>
                            <th>In Date</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Status</th>
                            <th>Enter By</th> --}}
                            <th {{$hidden1}}>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visitors as $visitor)
                            <tr>
                                <td> {{ $visitor->visitor_name }}</td>
                                <td> {{ $visitor->visitor_email }}</td>
                                <td> {{ $visitor->visitor_mobile_no }}</td>
                                <td> {{ $visitor->visitor_address}}</td>
                                <td>
                                    {{-- @dd($visitor->action->visitor_status); --}}
                                    @if ($visitor->action->visitor_status == 'In')
                                    <span class="w3-badge w3-green">In</span>
                                    @else
                                    <span class="w3-badge w3-red">Out</span>
                                    @endif
                                </td>
                                <td> {{ $visitor->action->visitor_enter_time }}</td>
                                {{-- <td> {{ $visitor->visitor_status }}</td> --}}
                                {{-- <td> {{ $visitor->visitor_meet_person_name }}</td>
                                <td>{{ $visitor->visitor_department }}</td>
                                <td>{{ date('Y-m-d', strtotime($visitor->visitor_enter_time)) }}</td>
                                <td> {{ date('H:m:s', strtotime($visitor->visitor_enter_time)) }}</td>
                                <td> {{ $visitor->visitor_out_time }}</td>
                                <td> {{ $visitor->visitor_status }}</td>
                                <td> {{ $visitor->visitor_enter_by ? $visitor->visitor_enter_by->name : "" }}</td> --}}
                               <td {{$hidden1}}>
                                {{-- @dd($visitor->action->visitor_status) --}}
                                    @if ($visitor->action->visitor_status == 'Out')
                                    <form action="/visitor/entry/{{ $visitor->id }}" method="get">
                                        @csrf
                                        {{-- <input type="submit" value="Out" /> --}}
                                        <button class="btn btn-primary btn-sm">Create</button>
                                    </form>
                                    @else
                                        <form action="/visitor/out/{{$visitor->action->id}}" method="post">
                                            @csrf
                                            {{-- <input type="submit" value="Out" /> --}}
                                            <button class="btn btn-danger btn-sm ">Out</button>
                                        </form>
                                    @endif
                                    {{-- <a href="/visitor/out/{{$visitor1->id}}" class="btn btn-danger btn-sm">Out</a></td> --}}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    </div>
<script>
$(document).ready( function () {
    var table=  $('#visitor_info').DataTable();

    $('#visitor_mobile_2').on('input', function() {
                // console.log("Roshan "+this.value);
                table.columns(2).search(this.value).draw();
                // var info2 = $('#visitor_table').DataTable().page.info();
                // $("#table_info").text("Total Count:"+info2.recordsDisplay);
            });
            $('#reset1').on('click', function() {
            table.columns(2).search("").draw();
            });
} );
</script>
<
@endsection
