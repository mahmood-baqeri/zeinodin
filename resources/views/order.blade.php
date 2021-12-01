@extends('layouts.user.user')
@section('content')
    <section class="container-fluid">
        <div class="container p-md-5 p-4">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 text-right">
                    @if($status == '1')
                        <p style="color: darkgreen;font-weight: 600;">وضعیت پرداخت: موفق</p>
                        <table class="table table-dark table-striped text-center" >
                            <thead>
                                <tr>
                                    <th>عنوان رویداد</th>
                                    <th>هزینه رویداد (تومان)</th>
                                    <th>درصد تخفیف</th>
                                    <th>مبلغ پرداختی (تومان)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$course->title}}</td>
                                    <td>{{number_format($auth->price)}}</td>
                                    <td>{{$auth->discount}} %</td>
                                    <td>{{number_format($auth->discount_price)}}</td>
                                </tr>
                            </tbody>
                        </table>

                    @elseif($status == '0') <p class="text-center" style="color: darkred;font-weight: 600;font-size: 20px">
                        {{$returnMsg}}
                    </p> @endif
{{--                    <a class="btn btn-danger text-white text-center" href="{{url('/')}}">بازگشت به سایت</a>--}}
                </div>
            </div>
        </div>
        {{--<object class="d-none d-xl-block" type="image/svg+xml" data="{{url('user/Images/Svg/desktop-wave.svg')}}"></object>--}}
    </section>
@endsection
