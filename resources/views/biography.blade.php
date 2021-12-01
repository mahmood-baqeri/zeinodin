@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">{{str_replace('-' , ' ' , $biography->slug)}}</h5>

        <div class="row">
            <div class="col-lg-12 pageTitleSection">
                <ul>
                    <li><a href="{{url('/') }}">صفحه اصلی </a></li>
                    <li>/</li>
                    <li><a>زندگی نامه </a></li>
                    <li>/</li>
                    <li>{{str_replace('-' , ' ' , $biography->slug)}}</li>
                </ul>
            </div>
        </div>
        <div class="row px-md-3 grad-hover box p-4 text-justify">
            <div class="col-lg-12 text-justify">
                {!! $biography->description !!}
            </div>
        </div>
    </section>
@endsection
