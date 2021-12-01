@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10 mb-5 order-1 order-lg-0">
                <div class="box p-4 text-justify">
                    <h5 class="pt-3 pb-5 IRANSansWeb_Medium text-center">{{$slider->title}}</h5>
                    <img src="{{url('/image/page/slider/'.$slider->img)}}" class="img-fluid rad50 pb-3 w-100" />
                    <div class="d-flex flex-md-row flex-column col-md-3">
                    </div>
                    <p>{!! $slider->text !!}</p>
                </div>
            </div>
        </div>
    </section>

@endsection
