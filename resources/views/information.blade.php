@extends('dashboard')

@section('content')
   <!-- START PAGE CONTENT-->
   <div  hhclass="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$todayCount}}</h2>
                    <div class="m-b-5">Total Today Visitor</div><i class="ti-bar-chart widget-stat-icon"></i>
                    {{-- <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$yesterdayCount}}</h2>
                    <div class="m-b-5">Total Yesterday Visitor</div><i class="ti-bar-chart widget-stat-icon"></i>
                    {{-- <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$weekCount}}</h2>
                    <div class="m-b-5">Total Last 7 Days Visitors</div><i class="ti-bar-chart widget-stat-icon"></i>
                    {{-- <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$totalCount}}</h2>
                    <div class="m-b-5">Total Visitor Till Day</div><i class="ti-bar-chart widget-stat-icon"></i>
                    {{-- <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
