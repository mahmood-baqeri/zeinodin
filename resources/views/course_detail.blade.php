@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-12 pageTitleSection">
                <ul>
                    <li><a href="{{url('/') }}">صفحه اصلی </a></li>
                    <li>/</li>
                    <li><a href="{{url('/events')}}">رویدادها </a></li>
                    <li>/</li>
                    <li>{{$course->title}}</li>
                </ul>
            </div>

            <div class="col-lg-8 mb-5 order-1 order-lg-0">

                @if (session('error'))
                    <div class="col-md-12 p-0">
                        <div class="alert alert-danger"
                             style=" padding-bottom: 10px !important;text-align: center;font-weight: 600">{{ session('error') }} </div>
                    </div>
                @endif


                <div class="box p-4 text-justify">
                    <h5 class="pt-3 pb-5 IRANSansWeb_Medium text-center">{{$course->title}}</h5>
                    <img src="{{url('/image/course/'.$course->img)}}" class="img-fluid rad25 pb-3 w-100"/>
                    <p>{!! $course->text !!}</p>
                </div>
            </div>
            <div class="col-lg-4 order-0 order-lg-1 ">
                <div class="box card text-center">
                    <div id="prof" class="card-body relative">
                        @if(file_exists(url('image/user/'.$course->getUser->img)))
                            <img class="pic90 rounded-circle absolute" src="{{url('image/user/'.$course->getUser->img)}}"
                                 alt="" style="top:-30px;right:40%">
                        @else
                            <img src="{{url('image/page/contacts/'.$contact_data->logo)}}" class="pic90 rounded-circle absolute"
                                 alt="" style="top:-30px;right:40%"/>
                        @endif

                        @isset($course->getUser->last_name)
                            @if($course->getUser->last_name != "دکتر شیخ زین الدین")
                                <p class="IRANSansWeb_Medium mt-5">
                                    مدرس: {{$course->getUser->name}} {{$course->getUser->last_name}}</p>
                            @else
                                <p class="IRANSansWeb_Medium mt-5"> برگزار کننده : بنیاد نوآوری و توسعه فناوری دکتر شیخ زین الدین </p>
                            @endif
                        @else
                            <p class="IRANSansWeb_Medium mt-5"> برگزار کننده : بنیاد نوآوری و توسعه فناوری دکتر شیخ زین الدین </p>
                        @endisset
                        <p class="bottom_p IRANSansWeb_Medium">{{$course->getCategory->name}}</p><br>
                        <p class="IRANSansWeb_Medium ">زمان برگزاری: {{$course->time}}</p>
                        <p class="IRANSansWeb_Medium ">ظرفیت باقی مانده:
                            @if($course->capacity > 0)
                                {{$course->capacity}} نفر
                            @else
                                <span class="color-text"> تکمیل شده</span>
                            @endif
                        </p>
                        <p class="IRANSansWeb_Medium ">تاریخ اتمام ثبت نام: {{$course->date_insert}}</p>
                            @if($course->price != 0 || $course->price != null )
                        <p class="IRANSansWeb_Medium">هزینه : {{$course->price}} تومان</p>
                            @else
                        <p class="IRANSansWeb_Medium">هزینه : رایگان </p>
                            @endif
                        <div class="d-flex flex-md-row flex-column">


                            @isset($course->getUser->last_name)
                                @if($course->getUser->last_name != "دکتر شیخ زین الدین")
                                    <a target="_blank" href="{{url('/consultation/'.$course->getUser->id)}}"
                                       class="btn btn-danger btn-block text-white m-2 rad25"> جزییات مدرس</a>
                                @endif
                            @endisset


                            @if($date_day <= $course->date_insert && $course->capacity > 0)
                                <a data-toggle="modal" data-target="#myModal"
                                   class="btn btn-success btn-block text-white m-2 rad25">
                                    ثبت نام در رویداد
                                </a>@endif
                        </div>
                    </div>
                </div>

                <div class="blogpost">
                    <h5 class="IRANSansWeb_Medium p-3">جدیدترین رویداد ها</h5>
                    <ul class="box pt-3">
                        @foreach($all_course as $data)
                            <li>
                                <div class="px-3 d-flex flex-row">
                                    <a href="{{url('events_detail/'.$data->url)}}" class="bg-red rounded"
                                       title="{{$data->title}}">
                                        <img src="{{url('/image/course/'.$data->img)}}" class="img-fluid"
                                             alt="{{$data->title}}"/>
                                    </a>
                                    <a href="{{url('events_detail/'.$data->url)}}" class="pr-3 flex-fill"
                                       title="{{$data->title}}">
                                        <h3 class="IRANSansWeb_Medium blog-item-title text-justify"><i
                                                class="fas fa-microphone-alt fa-2x text-danger ml-2"></i>{{limitWord($data->title , 4)}}
                                            ... </h3>
                                        <span
                                            class="float-right gray11">{{$data->getUser->name}} {{$data->getUser->last_name}}</span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>

            </div>
        </div>
        @if($course_user->count() != '0')
            <div class="row ">
                <div class="col-md-12 box mt-2 p-4 ">
                    <h5 class="IRANSansWeb_Medium mb-4 bt-color">رویداد های
                        دیگر {{$course->getUser->name}} {{$course->getUser->last_name}} </h5>
                    <div id="owl-toppost" class="owl-carousel owl-theme text-right ">
                        @foreach($course_user as $data)
                            <div class="mx-2">
                                <a href="{{url('events_detail/'.$data->url)}}" title="{{$data->title}}">
                                    <img src="{{url('/image/course/'.$data->img)}}" class="img-fluid rad25 bigpic"
                                         alt="{{$data->title}}"/>
                                    <div class="blogdiv">
                                        <h6 class="IRANSansWeb_Medium text-white text-shadow">{{$data->title}} </h6>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    @endif

    <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">{{$course->title}}</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="login" class="box border-top-0 p-lg-4 p-3">
                            <p class="text-dark my-3">ثبت نام در رویداد</p>
                            <p class="text-dark my-3">لطفا جهت ثبت نام در این رویداد، اطلاعات زیر را وارد نمایید</p>
                            <div class="alert alert-danger" style="display: none;"></div>
                            <div class="alert alert-success" style="display: none;"></div>
                            <form id="form1" action="{{route('insert_course')}}">
                                <input type="hidden" value="0" id="type" name="type"/>
                                <input type="hidden" value="{{$course->id}}" id="course_id" name="course_id"/>
                                <input type="hidden" value="" id="slider_id"/>
                                <input class="form-control mb-3" type="text" id="name" name="name" placeholder="نام و نام خانوادگی" required
                                       title="نام و نام خانوادگی الزامی است"/>
                                <input class="form-control mb-3" type="text" id="nationalCode" name="nationalCode" placeholder="کد ملی" required
                                       pattern="[0-9]{10}" title="لطفا کد ملی را به صورت صحیح وارد کنید"/>
                                <input class="form-control mb-3" type="tel" id="mobile" name="mobile" placeholder="تلفن همراه"
                                       pattern="[0][9][0-9]{9}" required title="لطفا شماره موبایل را به صورت صحیح وارد کنید"/>
                                <input class="form-control mb-3" type="text" id="phone" name="phone" placeholder="تلفن ثابت"/>
                                <input class="form-control mb-3" type="email" id="email" name="email" placeholder="ایمیل" required
                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="لطفا ایمیل را به صورت صحیح وارد کنید"/>

                                @if($course->price != 0 || $course->price != null )
                                <div class="col-lg-12">
                                    <input class="col-lg-8 mb-3" type="text" id="code" name="code"
                                           placeholder="در صورت داشتن کد تخفیف وارد کنید"/>
                                    <a class="btn btn-success col-lg-2" onclick="check_code()">ثبت کد</a>
                                    <p class="color-text" id="show_discount"></p>
                                </div>
                                @endif

                                @if(Auth::user())
                                <button class="btn btn-danger btn-block mb-3 py-3 text-white" type="submit">ثبت نام در رویداد</button>
                                @else
                                <button class="btn btn-danger btn-block mb-3 py-3 text-white" type="button" id="registerInEvent"
                                        data-toggle="modal" data-target="#loginModal">ثبت نام در رویداد</button>
                                @endif

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection



<div class="modal" id="IsUser">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
                {{ session('IsUser') }}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>

        </div>
    </div>
</div>

@section('js')
    <script>
        @if (session('IsUser'))
        $("#IsUser").modal()
        @endif
    </script>
@stop
