@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">

        <div class="row">
            <div class="col-lg-12 pageTitleSection">
                <ul>
                    <li><a href="{{url('/') }}">صفحه اصلی </a></li>
                    <li>/</li>
                    <li><a>فعالیت های بنیاد </a></li>
                    <li>/</li>
                    <li>{{$boniadWorks->name}}</li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12 mb-5 order-1 order-lg-0">
                <div class="box p-4 text-justify blogContentSection">
                    <h5 class="pt-3 IRANSansWeb_Medium">{{$boniadWorks->name}}</h5>

                    {!! $boniadWorks->description !!}

                </div>
            </div>
        </div>


    </section>
@endsection
