@extends('layouts.user.user')
@section('content')

    @include('include.slider')
    @include('include.site')
    @include('include.service')
    @include('include.about')
    @include('include.boniad_news')
{{--    @include('include.news')--}}
    @include('include.user')
    @include('include.course')
    @include('include.customer')
@endsection
