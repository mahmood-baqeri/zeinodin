@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">جستجوی مقالات</h5>
        <div class="row px-md-3 grad-hover ">


            <div class="col-md-3">
                <div class="box_1">

                    <form action="{{route('blogSearch')}}" class="search">
                        <input type="search" name="text" class="form-control" placeholder="جستجو ... " value="{{$searchText}}">
                        <i class="fa fa-search"></i>
                    </form>

                    <h1>دسته بندی ها : </h1>
                    <ul>
                        @foreach(\App\BlogCategory::where('status' , 1)->where('parent_id' ,0 )->get() as $item)
                            <li><a href="{{route('blogCategory' , $item->slug)}}">{{$item->name}}</a></li>
                            @foreach($item->child as $sumCate)
                                <li class="sub"><a
                                        href="{{route('blogCategory' , $sumCate->slug)}}">{{$sumCate->name}}</a></li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>


            <div class="col-md-9">
                <div class="row">
                    @foreach($blogs as $item)
                        <div class="col-lg-4 col-sm-6 mt-5 blogItem">
                            <a href="{{route('blogDetail' , $item->slug)}}" class="card m-2" title="{{$item->title}}">
                                <img height='300' class="card-img-top" src="{{asset($item->photo)}}"
                                     alt="{{$item->title}}">
                                <div class="card-body">
                                    <h6>{{$item->name}}</h6>
                                    <p>{{$item->summer}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
