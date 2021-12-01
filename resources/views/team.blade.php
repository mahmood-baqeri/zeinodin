@extends('layouts.user.user')
@section('content')
    <section class="container-fluid intro-section">
        <div class="container p-md-5 p-4">
            <div class="row">
                <div class="col-lg-9 text-justify text-white">
                    {!! $data->text !!}
                </div>
{{--                <div class="col-lg-3 pt-4">--}}
{{--                    <img src="{{asset($data->img)}}" class="float-lg-left d-none d-lg-block img-fluid" style="width:250px;height:auto" />--}}
{{--                </div>--}}
            </div>
        </div>



        <section class="container mt-5">
            <h5 class="IRANSansWeb_Medium  text-center bt-color text-white">هیئت امنا</h5>
            <div class="owl-topnevis owl-carousel owl-theme pt-3 text-right">
                @foreach($user['user0'] as $data)
                    <div class="card mx-1 text-center">
                        <div class="card-body relative">
                            <img class="usersPic1" src="{{url('image/page/about/'.$data->img)}}" alt="">
                            <h6 class="IRANSansWeb_Medium">{{$data->name}}</h6>
                            <p class="IRANSansWeb_Medium mt-4">{{$data->title}}</p>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{$data->id}}">&#1580;&#1586;&#1740;&#1740;&#1575;&#1578; &#1576;&#1740;&#1588;&#1578;&#1585;</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <br><br><br>
        <section class="container mt-5">
            <h5 class="IRANSansWeb_Medium  text-center bt-color text-white">تیم اجرایی</h5>
            <div class="owl-topnevis owl-carousel owl-theme pt-3 text-right">
                @foreach($user['user1'] as $data)
                    <div class="card mx-1 text-center">
                        <div class="card-body relative">
                            <img class="usersPic1" src="{{url('image/page/about/'.$data->img)}}" alt="">
                            <h6 class="IRANSansWeb_Medium">{{$data->name}}</h6>
                            <p class="IRANSansWeb_Medium mt-4">{{$data->title}}</p>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{$data->id}}">&#1580;&#1586;&#1740;&#1740;&#1575;&#1578; &#1576;&#1740;&#1588;&#1578;&#1585;</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        <br><br><br>
        <section class="container mt-5">
            <h5 class="IRANSansWeb_Medium  text-center bt-color text-white">مدیر اجرایی</h5>
{{--            <div class="owl-topnevis owl-carousel owl-theme pt-3 text-right">--}}
            <div class="row pt-3 text-right justify-content-center">
                @foreach($user['user2'] as $data)
                    <div class="col-md-3">
                    <div class="card mx-1 text-center">
                        <div class="card-body relative">
                            <img class="usersPic1" src="{{url('image/page/about/'.$data->img)}}" alt="">
                            <h6 class="IRANSansWeb_Medium">{{$data->name}}</h6>
                            <p class="IRANSansWeb_Medium mt-4">{{$data->title}}</p>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{$data->id}}">&#1580;&#1586;&#1740;&#1740;&#1575;&#1578; &#1576;&#1740;&#1588;&#1578;&#1585;</button>
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
        </section>

        @foreach($user['all'] as $data)
            <div id="myModal{{$data->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg" dir="rtl">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" dir="ltr">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-right">{{$data->name}}</h4>
                        </div>
                        <div class="modal-body">
                            <p class="bottom_p text-justify">{{$data->detail}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">&#1576;&#1587;&#1578;&#1606;</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
