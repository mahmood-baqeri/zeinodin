@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">پروفایل</h5>
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
                <div class=" box_1">
                    <form action="{{url('user/updateProfile')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}"   placeholder="نام">
                        </div>

                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{Auth::user()->last_name}}"
                                   placeholder="نام خانوادگی">
                        </div>

                        <div class="form-group">
                            <label for="mobile">تلفن همراه</label>
                            <input type="number" class="form-control" id="mobile" name="mobile" value="{{Auth::user()->mobile}}"  placeholder="تلفن همراه">
                        </div>
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}"  placeholder="ایمیل">
                        </div>
                        <div class="form-group">
                            <label for="password">رمز عبور</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
                        </div>


                        <button type="submit" class="btn btn-primary">بروزرسانی</button>


                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
