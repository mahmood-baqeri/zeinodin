@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-12 pageTitleSection">
                <ul>
                    <li><a href="{{url('/') }}">صفحه اصلی </a></li>
                    <li>/</li>
                    <li><a href="{{url('/news/اخبار')}}">اخبار نوآوری </a></li>
                    <li>/</li>
                    <li>{{$blog->title}}</li>
                </ul>
            </div>
            <div class="col-lg-12 mb-5 order-1 order-lg-0">
                <div class="box p-4 text-justify">
                    <h5 class="pt-3 IRANSansWeb_Medium">{{$blog->title}}</h5>
                    <p><i class="fas fa-history pl-1"></i>تاریخ ارسال : {{$blog->date}} </p>
                    <?php if ($blog->img != 'image.png') $src = url('/image/page/main/'.$blog->img); else $src = url('/image/page/'.$blog->img); ?>
                    <img src="{{$src}}" class="img-fluid pb-3 w-100" alt="{{$blog->title}}"/>
                    <p>{!! $blog->text !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
