@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">جستجوی مطالب</h5>
        <div class="row px-md-3 grad-hover ">


            <div class="col-md-6">
                <div class="box_1">

                    <form action="{{route('search')}}" class="search">
                        <input type="search" name="text" class="form-control" placeholder="جستجو ... " value="{{$searchText}}">
                        <i class="fa fa-search"></i>
                        <select name="type">
                            <option value="0" @if($searchType == 0) selected @endif>اخبار</option>
                            <option value="1" @if($searchType == 1) selected @endif>وبینار</option>
                            <option value="2" @if($searchType == 2) selected @endif>وبلاگ</option>
                            <option value="3" @if($searchType == 3) selected @endif>محصول</option>
                            <option value="4" @if($searchType == 4) selected @endif>زندگی نامه</option>
                            <option value="5" @if($searchType == 5) selected @endif>درباره ما</option>
                            <option value="6" @if($searchType == 6) selected @endif>عکس</option>
                            <option value="7" @if($searchType == 7) selected @endif>فیلم</option>
                        </select>
                    </form>

                </div>
            </div>


            <div class="col-md-12">
                <div class="row">
                    @foreach($all as $data)
                        <div class="col-lg-4 col-sm-6 mt-5 newsItem">
                            @if($searchType == 1)
                                <a href="{{url('/events_detail/'.$data->url)}}" class="card m-2" title="{{$data->title}}">
                                    <img height="300" class="card-img-top" src="{{ url('/image/course/'.$data->img)}}" alt="{{$data->title}}">
                                    <div class="card-body">
                                        <h6 class="IRANSansWeb_Medium">{{$data->title}}</h6>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex flex-row">
                                            <img src="{{ url('/image/user/'.$data->getUser->img)}}" style="height: 55px !important;" class="img-fluid rounded-circle ml-3 pic55" />
                                            <div>
                                                <p class="text-dark IRANSansWeb_Medium bottom_p">{{$data->getUser->name}} {{$data->getUser->last_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>



                            @elseif($searchType == 2)
                                <a href="{{route('blogDetail' , $data->slug)}}" class="card m-2" title="{{$data->title}}">
                                    <img height='300' class="card-img-top" src="{{asset($data->photo)}}"
                                         alt="{{$data->title}}">
                                    <div class="card-body">
                                        <h6>{{$data->name}}</h6>
                                        <p>{{$data->summer}}</p>
                                    </div>
                                </a>



                            @elseif($searchType == 3)
                                <a href="{{route('product.detail' , $data->slug)}}" class="card m-2" title="{{$data->title}}">
                                    <img height='300' class="card-img-top" src="{{asset($data->photo)}}"
                                         alt="{{$data->title}}">
                                    <div class="card-body">
                                        <h6>{{$data->name}}</h6>
                                        <p>{{number_format($data->price)}} تومان </p>
                                    </div>
                                </a>

                            @elseif($searchType == 4)
                                @if( $data->type == 1)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{route('biographyShow' , 'شرح-زندگی' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if($data->type == 2)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{route('biographyShow' , 'دوران-کاری' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if($data->type == 3)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{route('biographyShow' , 'خدمات-ماندگار' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if($data->type == 4)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{route('biographyShow' , 'افتخارات' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if($data->type == 5)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{route('biographyShow' , 'کنفرانس-ها' )}}"> <i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if($data->type == 6)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{route('biographyShow' , 'عضویت-ها' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif

                            @elseif($searchType == 5)
                                @if( $data->type == 0)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{url('/about' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if( $data->type == 2)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{url('/vision' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if( $data->type == 3)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{url('/mission' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif
                                @if( $data->type == 10)
                                    <a style="background: #eee;padding: 10px 15px 10px 75px;" href="{{url('/guide' )}}"><i class="fa fa-arrow-left"></i>  {{$searchText}}</a>
                                @endif

                            @elseif($searchType == 6)
                                <a href="{{asset($data->file)}}" class="card m-2" title="{{$data->title}}">
                                    <img height='300' class="card-img-top" src="{{asset($data->file)}}"
                                         alt="{{$data->title}}">
                                </a>
                            @elseif($searchType == 7)
                                <video width="320" height="240" controls>
                                    <source src="{{asset($data->file)}}" type="video/mp4" />
                                </video>
                            @else
                                <?php
                                if ($data->img != 'image.png') $src = url('/image/page/main/'.$data->img); else $src = url('/image/page/'.$data->img);
                                if ($data->url_default != '') $href = $data->url_default; elseif ($data->url_file != '') $href = $data->url_file; else $href= url('/news_detail/'.$data->url);
                                ?>
                                <a href="{{$href}}" @if ($data->url_default!= '') target="_blank" @elseif ($data->url_file != '') download @endif class="card m-2" title="{{$data->title}}">
                                    <img height='300' class="card-img-top" src="{{$src}}" alt="{{$data->title}}">
                                    <div class="card-body newsBody">
                                        <h6 class="title">{{$data->title}}</h6>
                                        <p class="textShort">{{$data->text_short}}</p>
                                    </div>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
