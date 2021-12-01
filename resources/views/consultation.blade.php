@extends('layouts.user.user')
@section('content')
    <section class="d-flex justify-content-center m-sm-4 m-3 ">

        <div class="container">
            <div class="row box  mx-wh  p-4  bg-half">
                <div class="col-md-3  text-center">
                    <img src="{{url('image/user/'.$data->img)}}" class="img-fluid rounded-circle border pic160" /><br />
                </div>
                <div class="col-md-9 text-md-right text-center">
                    <h3 class="IRANSansWeb_Medium text-white b-dark mb-0">{{$data->name}} {{$data->last_name}}</h3>
                    <p class="text-sm-white IRANSansWeb_Medium text-white b-dark">{{$data->getCategory->name}}</p>
                </div>
            </div>

            <div class="row mt-4 p-4  mx-wh box">
                <div class="col-md-12">
                    <h6 class="IRANSansWeb_Medium bg-light rad25 py-2 px-3 ">درباره مشاور</h6>
                    <br><p class="text-justify">{!! $data->text !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection