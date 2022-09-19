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
    <h2 class="mt-5">Visitor Report</h2>
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
            <div class="table-responsive">
                <form action="">
                    <h4><div class="col col-md-1 bg-success text-center">Filter</div></h4>
                    <div class="row">
                        <div class="col-sm-4">
                            Minimum date:
                            {{-- <input type="text" class="form-control"   id="min_date" name="min"> --}}
                            <input type='date' class="form-control"  min='1990-01-20'  id='min_date'  max='2122-01-01'>
                        </div>
                        <div class="col-sm-4">
                            Maximum date:
                            {{-- <input type="text" class="form-control" id="max_date" name="max"> --}}
                            <input type='date' class="form-control"  min='1990-01-20'  id='max_date'  max='2122-01-01'>
                        </div>
                        <div class="col-sm-4">

                            Visitor name:
                            <input type="text" class="form-control" id="visitor_name1" name="visitor_name1">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-4">
                            Visitor mobile:
                            {{-- <input type="text" class="form-control" list="visitor_mobile1" id="visitor_mobile1" name="visitor_mobile1"> --}}
                            <input type="text" id="visitor_mobile_2" class="form-control" list="visitor_mobile1" />
                            <datalist id="visitor_mobile1">
                            @foreach($visitor_mob_distinct as $vmob)
                                <option>{{$vmob}}</option>
                            @endforeach
                            </datalist>
                        </div>
                        <div class="col-sm-4">

                            Department:
                            <select name="dept" id="depart-dd" class="form-control">
                                <option value="" selected>Select Any</option>
                                @foreach ($dept as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-sm-4">
                            Visitor meet person name:
                            <select id="visitor_meet" name="visitor_meet" class="form-control ">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">


                                Visitor Status:
                                <select name="visitor_status" id="visitor_status" class="form-control">
                                    <option value="" selected>Select Any</option>
                                    <option value="In" >In</option>
                                    <option value="Out" >Out</option>
                                </select>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2" style="margin:5px 0px;">
                            {{-- <input type="reset"  id="reset1" class="btn btn-danger btn-sm" value="Reset" > --}}
                            <input type="button" class="btn btn-danger btn-sm" value="Reset" onClick="window.location.reload()">
                            {{-- <input type="reset" id="reset1" class="btn btn-danger" value="Reset"> --}}

                        </div>
                    </div>
                </form>
                {{-- <div style="margin:5px 0px;">

                    <input type="input" id="count" class="form-control"  value="Reset">
               </div> --}}
                <table class="table table-bordered" id="visitor_table">
                    {{-- <table id="visitor_table" class="display nowrap" style="width:100%"> --}}
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
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
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
                    {{-- <tfoot>
                        <tr>
							<th>Visitor Name</th>
                            <th>Visitor Mobile Number</th>
                            <th>Visitor Token</th>
							<th>Meet Person Name</th>
                            <th>Department</th>
							<th>In Time</th>
							<th>Out Time</th>
							<th>Status</th>
							<th>Enter By</th>
							<th>Action</th>
						</tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
    </div>
    <script>

        // < div >

            $(document).ready(function(){

                var table = $('#visitor_table').DataTable({ "ordering": false });
                // table.draw();

            // var minDate, maxDate;

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



                // var min1 = $('#min_date').val();
                 // //////
                //  var event = new Date(min);

                // let date1 = JSON.stringify(event)
                // date1 = date1.slice(1,11)
                // console.log("Roshan "+date1);

                // ////
                // console.log(min);
                // var max = maxDate.val();
                // var max1 =$('#max_date').val();
                // console.log(max1);

                // console.log(max);
                var date = new Date(data[5]);
                // var date=date1.getDate();
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

            // var date1= $('#min_date').val();
                ////////
            // minDate = new DateTime($('#min_date'), {
            //     format: 'MMMM Do YYYY'
            // });
            ///////blocked now
            // console.log(minDate.val());
            // minDate = new DateTime(date1, {
            //     format: 'MMMM Do YYYY'
            // });
            // console.log

            // maxDate = new DateTime($('#max_date'), {
            //     format: 'MMMM Do YYYY'
            // });


            // var table = $('#visitor_table').DataTable({ "ordering": false });
            // table.draw();



            // $('#reset1').on('click', function() {
            //     console.log("Roshan 78695849");
            //      table.draw();
            // });
            // var info = table.page.info();
            // console.log(info);
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
                //     var info = table.page.info();
                // console.log(info);
            });
            // $("#max_date").on('change', function() {
            //     table.draw();
            //     var info6 = $('#visitor_table').DataTable().page.info();
            //     $("#table_info").text("Total Count:"+info6.recordsDisplay);
            //     //     var info = table.page.info();
            //     // console.log(info);
            // });

            // DataTables initialisation


            // Refilter the table
            console.log("|aa");

            // ///////////
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
        $("#visitor_meet").append('<option value="" selected>Select Any</option>');
        $.each(result.dept, function (key, value) {
            // var nameArr = $(this).split(',');
            // console.log(nameArr);
            //
            // if(j==value['name']){
            $("#visitor_meet").append('<option  value="' + value['id'] + '">' + value['name'] + '</option>');
            // }
            // else{
            //     $("#visitor_meet").append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
            // }
            console.log(value['id']);
            });


        console.log(result.dept);
        }
     });
  });

            // ///////////////////
            // var table = $('#visitor_table').DataTable();

            // #column3_search is a <input type="text"> element
            $('#visitor_name1').on('keyup', function() {
                // console.log(this.value);
                // var table = $('#visitor_table').DataTable({ "ordering": false });
                table.columns(0).search(this.value).draw();
                var info1 = $('#visitor_table').DataTable().page.info();
                $("#table_info").text("Total Count:"+info1.recordsDisplay);
            });
            $('#visitor_mobile_2').on('input', function() {
                // console.log("Roshan "+this.value);
                table.columns(1).search(this.value).draw();
                var info2 = $('#visitor_table').DataTable().page.info();
                $("#table_info").text("Total Count:"+info2.recordsDisplay);
            });
            $('#depart-dd').on('change', function() {

                // console.log("Roshan"+this.options[this.selectedIndex].text);
                table.columns(4).search(this.options[this.selectedIndex].text) .draw();
                var info3 = $('#visitor_table').DataTable().page.info();
                $("#table_info").text("Total Count:"+info3.recordsDisplay);
                // console.log("Roshan"+info.recordsDisplay);
            });
            $('#visitor_meet').on('change', function() {
                // console.log("Roshan"+this.options[this.selectedIndex].text);
                table .columns(3).search(this.options[this.selectedIndex].text).draw();
                var info0 = $('#visitor_table').DataTable().page.info();
                $("#table_info").text("Total Count:"+info0.recordsDisplay);

            });
            $('#visitor_status').on('change', function() {
                // console.log("Roshan"+this.options[this.selectedIndex].text);
                table .columns(8).search(this.value).draw();
                var info5 = $('#visitor_table').DataTable().page.info();
                $("#table_info").text("Total Count:"+info5.recordsDisplay);

            });



            // $("#reset1").on('click',function(){
            //     var table = $('#visitor_table').DataTable();
            //     table.search('');
            //     table.columns().search('').draw();
            //     // $("#visitor_table").DataTable().search("").draw()
            // });
            // function funClick(val) {
            //     var table = $('#visitor_table').DataTable();
            //     console.log("Hello");
            //     table.draw();
            // }
            // $("#reset1").on('click', function () {
            //         table.draw();
            //     });
            // $('#reset1').on('click', function () {
            //      table.draw();

            //         // .search( this.value )

            // } );
            // var table = $('#visitor_table').DataTable();

        });

        // $( document ).ready(function() {
        // var table1 = $('#visitor_table').DataTable({ "ordering": false });
        //     table1.draw();

        // });
    </script>


<script>
        // function myFunction() {
        //     var table = $('#visitor_table').DataTable();
        //     console.log("Hello");
        //     table.draw();
        // }
        // var table = $('#visitor_table').DataTable();
        // alert(
        //     'Number of row entries: '+
        //     table
        //         .column( 0 )
        //         .data()
        //         .length
        // );
        // $('#button_1').on('clicl',function(){
        //     $("#max_date").html('');
        //     $("#min_date").html('');
        //     $("#visitor_meet").html('');
        //     $("#depart-dd").html('');
        // })

        // ///////////

        // each search1 filter
        // ///////////
        // $('.search1').each(function () {
        //     var title = $(this).text();
        //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        // });

        // DataTable
        // var table = $('#visitor_table').DataTable({
        //     initComplete: function () {
        //         // Apply the search
        //         this.api()
        //             .columns()
        //             .every(function () {
        //                 var that = this;

        //                 $('input:text .search1', this).on('keyup change clear', function () {
        //                     if (that.search() !== this.value) {
        //                         that.search(this.value).draw();
        //                     }
        //                 });
        //             });
        //     },
        // });




        //        initComplete: function () {
        //             this.api().columns().every( function () {
        //                 var column = this;
        //                 var select = $('<select><option value=""></option></select>')
        //                     .appendTo( $(column.footer()).empty() )
        //                     .on( 'change', function () {
        //                         var val = $.fn.dataTable.util.escapeRegex(
        //                             $(this).val()
        //                         );

        //                         column
        //                             .search( val ? '^'+val+'$' : '', true, false )
        //                             .draw();
        //                     } );

        //                 column.data().unique().sort().each( function ( d, j ) {
        //                     select.append( '<option value="'+d+'">'+d+'</option>' );
        //                 } );
        //             } );
        //         }
        // 	} );
        // } );


        // $(document).ready(function() {
        //     // Create date inputs
        //     minDate = new DateTime($('#min'), {
        //         format: 'MMMM Do YYYY'
        //     });

        //     maxDate = new DateTime($('#max'), {
        //         format: 'MMMM Do YYYY'
        //     });

        //     // DataTables initialisation
        //     var table = $('#visitor_table').DataTable();

        //     // Refilter the table
        //     $('#min, #max').on('change', function () {
        //         alert("haer")
        //         console.log(minDate.val());
        //         table.draw();
        //     });
        // });

        // $('#min, #max').on('change', function () {
        // var dateTimeMin = document.getElementById("min").value;
        // var dateTimeMax = document.getElementById("max").value;
        // var minDate=dateTimeMin;
        // var maxDate=dateTimeMax;
        //     // console.log("////////////Roshan dateTime="+dateTime);
        // });

        // console.log(minDate);
        // var minDate, maxDate;

        // // Custom filtering function which will search data in column four between two values
        // $.fn.dataTable.ext.search.push(
        //     function( settings, data, dataIndex ) {
        //         var min = minDate.val();
        //         // var min = minDate;
        //         var max = maxDate.val();
        //         // var max = maxDate;
        //         // console.log("/////minDate="+minDate);
        //          var date = new Date( data[5] );
        //         // var date1 = new Date(data[5] );
        //         // const year = date1.getFullYear();
        //         // const month = date1.getMonth() + 1;
        //         // const day = date1.getDate();
        //         // const date = [year, month, day].join('-');
        //         // console.log(date);
        //         // console.log("////////////Roshan "+min);
        //         if (
        //             ( min === null && max === null ) ||
        //             ( min === null && date <= max ) ||
        //             ( min <= date   && max === null ) ||
        //             ( min <= date   && date <= max )
        //         ) {
        //             return true;
        //         }
        //         return false;
        //     }
        // );

        // // $('#min, #max').on('change', function () {
        // // var dateTimeMin = document.getElementById("min").value;
        // // var dateTimeMax = document.getElementById("max").value;
        // // var minDate=dateTimeMin;
        // // var maxDate=dateTimeMax;
        // //     // console.log("////////////Roshan dateTime="+dateTime);
        // // });

        // $(document).ready(function() {
        //     // Create date inputs
        //     // $('#min, #max').on('change', function () {
        //     minDate = new DateTime($('#min'), {
        //         format: 'MMMM Do YYYY'
        //     });

        //     // var dateTime = document.getElementById("min").value;
        //     // console.log("////////////Roshan dateTime="+dateTime);
        // // // Use it here
        //     // var countDownDate = new Date(dateTime);
        //     // const year1 = countDownDate.getFullYear();
        //     // console.log("year1 ="+year1);
        //     //     const month1 = countDownDate.getMonth() + 1;
        //     //     const day1 = countDownDate.getDate();
        //     //     const date2 = [year1, month1, day1].join('-');
        //     // console.log("////////////Roshan minDate "+date2);
        //     maxDate = new DateTime($('#max'), {
        //         format: 'MMMM Do YYYY'
        //     });
        //     // });
        //     // DataTables initialisation
        //     var table = $('#visitor_table').DataTable();

        //     // Refilter the table
        //     $('#min, #max').on('change', function () {
        //         //////
        //     //     var dateTimeMin = document.getElementById("min").value;
        //     // var dateTimeMax = document.getElementById("max").value;
        //     // var minDate=dateTimeMin;
        //     // var maxDate=dateTimeMax;
        //         //////
        //         table.draw();
        //     });
        // });



        // $("document").ready(function(){
        //     setTimeout(function(){
        //        $("div.alert").remove();
        //     }, 5000 ); // 5 secs

        // });
    //
</script>
@endsection
