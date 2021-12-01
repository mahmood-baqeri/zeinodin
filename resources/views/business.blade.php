@extends('layouts.user.user')
@section('content')
    <div class="container mt-5  px-md-5 pt-3 pb-5 rad25">
        {{--<h5 class="text-center grad-bg text-white rad12 mb-5">مشاوره کسب و کار</h5>--}}

        <div class="row px-md-4 grad-hover ">

            <div class="col-lg-4 col-sm-6">
                <a href="" download>
                    <img src="{{url('image/img/pic1.png')}}" class="img-fluid pb-3 rounded rad12" />
                    <h5 class="text-center grad-bg text-white">راهنمای استفاده از سامانه مشاوره</h5>
                </a>
            </div>

            <div class="col-lg-4 col-sm-6">
                <a href="#">
                    <img src="{{url('image/img/pic2.png')}}" class="img-fluid pb-3 rounded rad12" />
                    <h5 class="text-center grad-bg text-white">رزرو آنلاین مشاوره</h5>
                </a>
            </div>


            <div class="col-lg-4 col-sm-6">
                <a href="{{url('/list_user')}}">
                    <img src="{{url('image/img/pic3.png')}}" class="img-fluid pb-3 rounded rad12" />
                    <h5 class="text-center grad-bg text-white">آشنایی با مشاوران</h5>
                </a>
            </div>
        </div>
    </div>

@endsection
