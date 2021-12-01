@extends('layouts.user.user')
@section('content')
    <div class="container mt-5 px-md-5 pt-3 pb-5 rad25">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">{{$category->name}}</h5>
        <div class="row px-md-4 grad-hover ">
            @foreach($category_all as $data)
                <div class="col-lg-4 col-sm-6 box__2">
                    <a href="{{url('/blog/'.$data->url)}}">
                        <?php if ($data->img != 'image.png') $src = url('/image/page/menu/'.$data->img); else $src = url('/image/page/'.$data->img); ?>
                        <img src="{{$src}}" class="img-fluid pb-3 rounded rad12" />
                        <h6 class="text-center">{{$data->name}}</h6>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
