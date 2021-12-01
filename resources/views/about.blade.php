@extends('layouts.user.user')
@section('content')
    <section class="container-fluid intro-section">
        <div class="container p-md-5 p-4">
            <div class="row">
                <div class="col-lg-9 text-justify text-white">
                    {!! $data->text !!}
                </div>
                <div class="col-lg-3 pt-4">
                    <img src="{{asset($data->img)}}" class="float-lg-left d-none d-lg-block img-fluid" style="width:250px;height:auto" />
                </div>
            </div>
        </div>
    </section>
@endsection
