@extends('dashboard')

@section('content')
@if (session()->has('success1'))
        <div class="alert alert-success mt-2">
            {{ session()->get('success1') }}
        </div>
    @endif

<div class="page-heading">
    <h1 class="page-title">Visitor Report</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Visitor Report</li> --}}
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

            <form style="background-color:#bdc3c7" class="border rounded m-1 p-3" action="">
                {{-- <div class="col-sm-3 form-group"> --}}
                    {{-- <div class="col-md-4" style="background-color: green"></div> --}}

                {{-- </div> --}}
                {{-- <h4><div class="col col-md-1 rounded text-center" style="background-color:rgb(175, 149, 33)" >Filter</div></h4> --}}
                <div class="row">
                    <div class="col-sm-3 form-group">
                            Minimum date:
                            {{-- <input type="text" class="form-control"   id="min_date" name="min"> --}}
                            <input type='date' class="form-control rounded" placeholder='1990-01-20' min='1990-01-20'  id='min_date'  max='2122-01-01'>
                        </div>
                        <div class="col-sm-3 form-group">
                            Maximum date:
                            <input type='date' class="form-control  rounded"  min='1990-01-20'  id='max_date'  max='2122-01-01'>
                        </div>
                        <div class="col-sm-3 form-group">
                            Visitor name:
                            <input type="text" class="form-control  rounded" id="visitor_name1" name="visitor_name1">
                        </div>
                        <div class="col-sm-3 form-group">
                            Visitor mobile:
                            {{-- <input type="text" class="form-control" list="visitor_mobile1" id="visitor_mobile1" name="visitor_mobile1"> --}}
                            <input type="text" id="visitor_mobile_2" class="form-control  rounded" list="visitor_mobile1" />
                            <datalist id="visitor_mobile1">
                            @foreach($visitor_mob_distinct as $vmob)
                                <option>{{$vmob}}</option>
                            @endforeach
                            </datalist>
                        </div>
                        <div class="col-sm-3 form-group">
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 form-group">
                        Department:
                            <select name="dept" id="depart-dd" class="form-control  rounded">
                                <option value="" selected>Select Any</option>
                                @foreach ($dept as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-sm-3 form-group">
                        Visitor meet person name:
                            <select id="visitor_meet" name="visitor_meet" class="form-control  rounded ">

                            </select>
                    </div>
                    <div class="col-sm-3 form-group">
                        Visitor Status:
                                <select name="visitor_status" id="visitor_status" class="form-control  rounded">
                                    <option value="" selected>Select Any</option>
                                    <option value="In" >In</option>
                                    <option value="Out" >Out</option>
                                </select>
                    </div>
                    <div class="col-sm-1 form-group  rounded">
                        <br><input type="button" class="btn btn-danger btn-sm" value="Reset" onClick="window.location.reload()">
                    </div>
                    <div class="col-sm-2 form-group">
                    <br><p id="table_info"></p>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-bordered table-hover" id="visitor_table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Visitor Name</th>
                        <th>Visitor Mobile Number</th>
                        <th>Visitor Token</th>
                        <th>Meet Person Name</th>
                        <th>Department</th>
                        <th>In Date</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Status</th>
                        <th>Enter By</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Visitor Name</th>
                        <th>Visitor Mobile Number</th>
                        <th>Visitor Token</th>
                        <th>Meet Person Name</th>
                        <th>Department</th>
                        <th>In Date</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Status</th>
                        <th>Enter By</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($collection_visitors as $visitor)
                    <tr>
                        <td> {{ $visitor->visitor->visitor_name }}</td>
                        <td> {{ $visitor->visitor->visitor_mobile_no }}</td>
                        <td> {{ $visitor->visitor_token }}</td>

                        <td>

                            @foreach($visitor->visitordeptemp as $emp)
                            {{-- @dd($depart->employee) --}}

                                <li>{{$emp->employee->name }}</li><hr>

                            @endforeach
                        </td>
                        <td>
                            @foreach($visitor->visitordeptemp as $depart)
                            <ul>
                                <li>{{ $depart->department->department_name }}</li><hr>
                            </ul>
                            @endforeach
                        </td>
                       <td>{{ date('Y-m-d', strtotime($visitor->visitor_enter_time)) }}</td>
                        <td> {{ date('H:m:s', strtotime($visitor->visitor_enter_time)) }}</td>
                        <td> {{ $visitor->visitor_out_time }}</td>
                        <td> {{ $visitor->visitor_status }}</td>
                        {{-- @dd($visitor->users->name) --}}
                        <td> {{ $visitor->users->name}}</td>
                       {{-- <td>
                            @if ($visitor->visitor_status == 'Out')
                                {{ '' }}
                            @else
                                <form action="/visitor/out/{{ $visitor->id }}" method="post">
                                    @csrf

                                    <button class="btn btn-danger btn-sm">Out</button>
                                </form>
                            @endif
                             </td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- <script type="text/javascript">
    $(function() {
        $('#visitor_table').DataTable({
            pageLength: 10,
            ordering: false ,
            responsive: true,
            scrollX: true,

        });
    })
</script> --}}
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $("div.alert").remove();
        }, 5000 ); // 5 secs

    });
    </script>
<script>



        $(document).ready(function(){

            var table =  $('#visitor_table').DataTable({
            pageLength: 10,
            ordering: false ,
            responsive: true,
            scrollX: true,

        });


    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min1,max1;
            min1 = $('#min_date').val();
                 var min =new Date(min1);
                 max1 =$('#max_date').val();
                 var max = new Date(max1);

            if( min == "Invalid Date"){
                 min = max;
            }
            if(max == "Invalid Date" )
            {
                 max = min;
            }



            var date = new Date(data[5]);

            console.log(min);
            if (
                (min == "Invalid Date" && max == "Invalid Date") ||
                (min == "Invalid Date" && date <= max) ||
                (min <= date && max == "Invalid Date") ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }

    );





        $("#min_date, #max_date").on('change', function() {
            if($('#min_date').val()){
                $("#max_date").attr("min",$('#min_date').val());
            }
            if($('#max_date').val()){
                $("#min_date").attr("max",$('#max_date').val());
            }
            table.draw();
        console.log("hello");

            var info4 = $('#visitor_table').DataTable().page.info();
            $("#table_info").text("Total Count:"+info4.recordsDisplay);

        });

        console.log("|aa");

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

    $("#visitor_meet").append('<option value="" selected>Select Any</option>');
    $.each(result.dept, function (key, value) {

        $("#visitor_meet").append('<option  value="' + value['id'] + '">' + value['name'] + '</option>');

        console.log(value['id']);
        });


    console.log(result.dept);
    }
 });
});


        $('#visitor_name1').on('keyup', function() {

            table.columns(0).search(this.value).draw();
            var info1 = $('#visitor_table').DataTable().page.info();
            $("#table_info").text("Total Count:"+info1.recordsDisplay);
        });
        $('#visitor_mobile_2').on('input', function() {

            table.columns(1).search(this.value).draw();
            var info2 = $('#visitor_table').DataTable().page.info();
            $("#table_info").text("Total Count:"+info2.recordsDisplay);
        });
        $('#depart-dd').on('change', function() {


            table.columns(4).search(this.options[this.selectedIndex].text) .draw();
            var info3 = $('#visitor_table').DataTable().page.info();
            $("#table_info").text("Total Count:"+info3.recordsDisplay);

        });
        $('#visitor_meet').on('change', function() {

            table .columns(3).search(this.options[this.selectedIndex].text).draw();
            var info0 = $('#visitor_table').DataTable().page.info();
            $("#table_info").text("Total Count:"+info0.recordsDisplay);

        });
        $('#visitor_status').on('change', function() {

            table .columns(8).search(this.value).draw();
            var info5 = $('#visitor_table').DataTable().page.info();
            $("#table_info").text("Total Count:"+info5.recordsDisplay);

        });




    });


</script>

@endsection
