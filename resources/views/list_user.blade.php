@extends('layouts.user.user')
@section('content')
    <section class="container mt-5 p-lg-3">
        <div class="row">
        <div class="col-lg-2"></div>
            <div class="col-lg-8 col-md-8">
                @foreach($user as $data)
                    <div class="box p-4 mt-3">
                        <div class="row">
                            <div class="col-lg-2 text-lg-right text-center">
                                <a href="#">
                                    <img src="{{url('image/user/'.$data->img)}}" class="img-fluid rounded-circle mb-lg-0 mb-3" />
                                </a>
                            </div>
                            <div class="col-lg-10 pr-lg-3 text-lg-right text-center">
                                <ul>
                                    <li>
                                        <a href="#"><h5 class="IRANSansWeb_Medium">{{$data->name}} {{$data->last_name}}</h5></a>
                                    </li>
                                    <li>
                                        <p>{{$data->getCategory->name}}</p>
                                    </li>
                                    <li>
                                        <a href="{{url('/consultation/'.$data->id)}}" class="btn btn-danger float-lg-left text-white rad25">جزییات بیشتر</a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection