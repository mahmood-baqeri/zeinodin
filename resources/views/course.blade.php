@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <a style="position: absolute;left: 34px;background-color: #b50202;color: #fff !important;padding: 10px 25px;border-radius: 5px;"
           href="{{url('/guide')}}">راهنمای وبینار</a>
        <h5 class="IRANSansWeb_Medium  text-center bt-color"> رویداد ها</h5>
        <div class="row px-md-3 grad-hover ">
            @foreach($course as $data)
                <div class="col-lg-4 col-sm-6 mt-5 box__2">
                    <a href="{{url('/events_detail/'.$data->url)}}" class="card m-2" title="{{$data->title}}">
                        <img height="300" class="card-img-top" src="{{ url('/image/course/'.$data->img)}}" alt="{{$data->title}}">
                        <div class="card-body">
                            <h6 class="IRANSansWeb_Medium">{{$data->title}}</h6>

                            <span class="date__2">تاریخ برگزاری : {{$data->time}}</span>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-row">
                                <img src="{{ url('/image/user/'.$data->getUser->img)}}" class="img-fluid rounded-circle ml-3 pic55" />
                                <div>
                                    <p class="text-dark IRANSansWeb_Medium bottom_p">{{$data->getUser->name}} {{$data->getUser->last_name}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
