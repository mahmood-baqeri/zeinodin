@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">رویدادهای من</h5>
        <div class="row px-md-3 grad-hover ">


            <div class="col-md-3 mb-5">
                <div class="box_1">
                    <ul>
                        <li class="sub"><a class="dropdown-item" href="{{url('user/profile')}}">پروفایل</a></li>
                        <li class="sub"><a class="dropdown-item" href="{{url('user/myCourse')}}">رویدادهای من</a></li>
                        <li class="sub"><a class="dropdown-item" href="{{url('user/myProducts')}}">محصولات من</a></li>
                        <li class="sub"><a class="dropdown-item" href="{{url('user/logout')}}">خروج</a></li>
                    </ul>
                </div>
            </div>



            <div class="col-md-9 mb-5">
                @foreach($user->courses as $key => $item)
                    <div class=" box_1 mb-4">
                        <ul>
                            <li><b>شماره : </b> <span>{{$key + 1}}</span></li>
                            <li><b>نام رویداد : </b> <span>{{$item->course->title}}</span></li>
                            <li><b>قمیت : </b> <span>{{number_format($item->price)}} تومان </span></li>
                            <li><b>تاریخ خرید : </b> <span>{{  \Verta::instance($item->created_at)->format('%B %d، %Y') }}</span></li>
                            <li><b>اسپات پلیر : </b> <span style="font-size: 10px">{{$item->spotPlayerKey}}</span></li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
