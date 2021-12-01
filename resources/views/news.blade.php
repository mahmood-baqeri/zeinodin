@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">اخبار نوآوری</h5>
        <div class="row px-md-4 grad-hover ">
            @foreach($blog as $data)
                <div class="col-lg-4 col-sm-6 mt-5 newsItem box__2">
                    <?php
                    if ($data->img != 'image.png') $src = url('/image/page/main/'.$data->img); else $src = url('/image/page/'.$data->img);
                    if ($data->url_default != '') $href = $data->url_default; elseif ($data->url_file != '') $href = $data->url_file; else $href= url('/news_detail/'.$data->url);
                    ?>
                    <a href="{{$href}}" @if ($data->url_default!= '') target="_blank" @elseif ($data->url_file != '') download @endif class="card m-2" title="{{$data->title}}">
                        <img height='300' class="card-img-top" src="{{$src}}" alt="{{$data->title}}">
                        <div class="card-body newsBody height168">
                            <span class="date__2" style="margin-top: -10% !important;">تاریخ انتشار :  {{\Verta::instance($data->created_at)
                            ->format('%B %d، %Y')}}</span>
                            <h6 class="title">{{$data->title}}</h6>
                            <p class="textShort">{{$data->text_short}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
