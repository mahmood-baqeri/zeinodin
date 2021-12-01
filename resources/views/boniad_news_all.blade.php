@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">اخبار بنیاد</h5>
        <div class="row px-md-4 grad-hover ">
            @foreach($boniadNews as $data)
                <div class="col-lg-3 col-sm-6 mt-5 newsItem box__2">
                    <a  title="{{$data->name}}" href="{{route('boniadNewsFront' , $data->slug)}}" class="card m-2">
                        <img class="card-img-top" src="{{asset($data->photo)}}" width='100' height='300'>
                        <div class="card-body">
                            <h6 class="IRANSansWeb_Medium">{{ $data->name }}</h6>
                        </div>

                        <span class="date__2" style="text-align: left;margin: 15px;">{{  \Verta::instance($data->created_at)->format('%B %d، %Y') }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
