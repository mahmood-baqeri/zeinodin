@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-12 pageTitleSection">
                <ul>
                    <li><a href="{{url('/') }}">صفحه اصلی </a></li>
                    <li>/</li>
                    <li><a href="{{route('blog')}}">مقالات </a></li>
                    <li>/</li>
                    <li>{{$blog->name}}</li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="box_1" style="margin-top: 0">

                    <form action="{{route('blogSearch')}}" class="search two">
                        <input type="search" name="text" class="form-control" placeholder="جستجو ... ">
                        <i class="fa fa-search"></i>
                        <select name="category_id">
                            <option value="0">همه</option>
                            @foreach(\App\BlogCategory::where('status' , 1)->where('parent_id' ,0 )->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @foreach($item->child as $sumCate)
                                    <option value="{{$sumCate->id}}">{{$sumCate->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
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

            <div class="col-md-9 mb-5 order-1 order-lg-0">
                <div class="box p-4 text-justify blogContentSection">
                    <h5 class="pt-3 IRANSansWeb_Medium">{{$blog->name}}</h5>
                    <p><i class="fa fa-history pl-1"></i> تاریخ ارسال
                        : {{  \Verta::instance($blog->created_at)->format('%B %d، %Y') }} </p>
                    <img src="{{asset($blog->photo)}}" class="img-fluid pb-3 w-100" alt="{{$blog->name}}"/>

                    {!! $blog->description !!}


                    <h1 class="userComment">نظرات کاربران</h1>
                    @include('admin.messages')
                    <div class="row newComment">
                        <form action="{{route('blogCommentStore')}}" method="post">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                            <input type="text" name="user_name" class="form-control" placeholder="نام و نام خانوادگی">
                            <input type="email" name="user_mail" class="form-control" placeholder="ایمیل">
                            <textarea name="comment" class="form-control" cols="30" rows="10"></textarea>
                            <button class="btn btn-success">ثبت</button>
                        </form>
                    </div>

                    <div class="row userComments">
                        <ul>
                            @foreach($blog->comments as $comment)
                                <li>
                                    <i class="fa fa-user"></i>
                                    <b>{{$comment->user_name}}</b>
                                    <p>{{$comment->comment}}</p>
                                    <small>{{  \Verta::instance($comment->created_at)->format('%B %d، %Y') }} </small>
                                </li>

                                @foreach($comment->child as $replay)
                                    <li>
                                        <i class="fa fa-user"></i>
                                        <b>{{$replay->user_name}}</b>
                                        <p>{{$replay->comment}}</p>
                                        <small>{{  \Verta::instance($replay->created_at)->format('%B %d، %Y') }} </small>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>


                </div>
            </div>
        </div>


    </section>
@endsection
