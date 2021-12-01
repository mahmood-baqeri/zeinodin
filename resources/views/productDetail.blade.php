@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-12 pageTitleSection">
                <ul>
                    <li><a href="{{url('/') }}">صفحه اصلی </a></li>
                    <li>/</li>
                    <li><a href="{{route('product.all')}}">فروشگاه محتوا </a></li>
                    <li>/</li>
                    <li>{{$product->name}}</li>
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
                    <h5 class="pt-3 pb-5 IRANSansWeb_Medium text-center">{{$product->name}}</h5>
                    <img src="{{asset($product->photo)}}" class="img-fluid pb-3 w-100" alt="{{$product->name}}"/>
                    <p>{!! $product->description !!}</p>
                </div>
            </div>


            <div class="col-lg-4 order-0 order-lg-1 ">
                <div class="box card text-center">
                    <div id="prof" class="card-body relative">

                        <img class="pic90 rounded-circle absolute mb-4" src="{{asset($product->photo)}}" alt="" style="top:-30px;right:40%">

                        <p class="IRANSansWeb_Medium mt-5">هزینه : {{number_format($product->price)}} تومان</p>

                        <div class="d-flex flex-md-row flex-column">
                            <a data-toggle="modal" data-target="#myModal"
                               class="btn btn-success btn-block text-white m-2 rad25">
                                خرید محصول
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">{{$product->name}}</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="login" class="box border-top-0 p-lg-4 p-3">
                            <p class="text-dark my-3">لطفا جهت خرید محصول ، اطلاعات زیر را وارد نمایید</p>
                            <div class="alert alert-danger" style="display: none;"></div>
                            <div class="alert alert-success" style="display: none;"></div>
                            <form id="form1" action="{{route('product.pay')}}">
                                <input type="hidden" value="{{$product->id}}" id="product_id" name="product_id"/>
                                <input class="form-control mb-3" type="text" id="name" name="name" placeholder="نام و نام خانوادگی" required/>
                                <input class="form-control mb-3" type="text" id="mobile" name="mobile" placeholder="تلفن همراه" required/>
                                <input class="form-control mb-3" type="email" id="email" name="email" placeholder="ایمیل" required/>
                                <div class="col-lg-12">
                                    <input class="col-lg-8 mb-3" type="text" id="code" name="code"
                                           placeholder="در صورت داشتن کد تخفیف وارد کنید"/>
                                    <a class="btn btn-success col-lg-2" onclick="check_product_discount_code()">ثبت کد</a>
                                    <p class="color-text" id="show_discount"></p>
                                </div>

                                <p>پس از اتمام فرآیند خرید <b>لینک دانلود محصول</b> به شما نمایش داده میشود </p>
                                <button class="btn btn-danger btn-block mb-3 py-3 text-white" type="submit">خرید</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
