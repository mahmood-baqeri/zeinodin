@extends('layouts.admin.admin')
@section('content_admin')
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> تعداد مشاوران</span>
            <div class="count">{{$user->count()}}</div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-list"></i> تعداد کل رویداد ها</span>
            <div class="count">{{$course->count()}}</div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-newspaper-o"></i>  تعداد کل خبر ها </span>
            <div class="count">{{$news->count()}}</div>
        </div>
    </div>
    <!-- /top tiles -->
    {{--<div class="row">--}}
        {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
            {{--<div class="dashboard_graph">--}}
                {{--<div class="row x_title">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<h3>فعالیت های شبکه--}}
                            {{--<small>عنوان نمودار زیر عنوان</small>--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div id="reportrange" class="pull-left"--}}
                             {{--style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">--}}
                            {{--<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>--}}
                            {{--<span>اسفند 29, 1394 - فروردین 28, 1395</span> <b class="caret"></b>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-md-9 col-sm-9 col-xs-12">--}}
                    {{--<div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>--}}
                    {{--<div style="width: 100%;">--}}
                        {{--<div id="chart_plot_01" class="demo-placeholder" style="width: 100%; height:270px;"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-3 col-sm-3 col-xs-12 bg-white">--}}
                    {{--<div class="x_title">--}}
                        {{--<h2>بالاترین عملکرد در کمپین</h2>--}}
                        {{--<div class="clearfix"></div>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-12 col-sm-12 col-xs-6">--}}
                        {{--<div>--}}
                            {{--<p>کمپین فیسبوک</p>--}}
                            {{--<div class="">--}}
                                {{--<div class="progress progress_sm" style="width: 76%;">--}}
                                    {{--<div class="progress-bar bg-green" role="progressbar"--}}
                                         {{--data-transitiongoal="80"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<p>کمپین تویتتر</p>--}}
                            {{--<div class="">--}}
                                {{--<div class="progress progress_sm" style="width: 76%;">--}}
                                    {{--<div class="progress-bar bg-green" role="progressbar"--}}
                                         {{--data-transitiongoal="60"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-12 col-sm-12 col-xs-6">--}}
                        {{--<div>--}}
                            {{--<p>رسانه های متعارف</p>--}}
                            {{--<div class="">--}}
                                {{--<div class="progress progress_sm" style="width: 76%;">--}}
                                    {{--<div class="progress-bar bg-green" role="progressbar"--}}
                                         {{--data-transitiongoal="40"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<p>بیلبوردهای تبلیغاتی</p>--}}
                            {{--<div class="">--}}
                                {{--<div class="progress progress_sm" style="width: 76%;">--}}
                                    {{--<div class="progress-bar bg-green" role="progressbar"--}}
                                         {{--data-transitiongoal="50"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}

                {{--<div class="clearfix"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<br/>--}}
@endsection
