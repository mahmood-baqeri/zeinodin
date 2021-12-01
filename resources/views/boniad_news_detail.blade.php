@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-12 pageTitleSection">
                <ul>
                    <li><a href="{{url('/') }}">صفحه اصلی </a></li>
                    <li>/</li>
                    <li><a href="{{route('boniadNews')}}">اخبار بنیاد </a></li>
                    <li>/</li>
                    <li>{{$boniadNews->name}}</li>
                </ul>
            </div>
            <div class="col-lg-12 mb-5 order-1 order-lg-0">
                <div class="box p-4 text-justify">
                    <h5 class="pt-3 IRANSansWeb_Medium">{{$boniadNews->name}}</h5>
                    <p><i class="fa fa-history pl-1"></i> تاریخ ارسال : {{\Verta::instance($boniadNews->created_at)->format('%B %d، %Y')}} </p>
                    <img src="{{asset($boniadNews->photo)}}" class="img-fluid pb-3 w-100" alt="{{$boniadNews->name}}"/>
                    <p>{!! $boniadNews->description !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
