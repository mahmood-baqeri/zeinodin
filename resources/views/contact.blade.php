@extends('layouts.user.user')
@section('content')
    <section class="container-fluid pt-5 pb-4 pb-lg-0 intro-section">

        <div class="container mb-5  box br-top p-5 ">
            <p class="mb-4 bt-color text-right">ارتباط با ما</p>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <p class="mb-3">جهت ارتباط با ما و ارسال نظـرات و پیشنهادات خود می توانید از فرم زیر استفاده
                        نمایید</p>

                    <div class="form-group">
                        <div class="alert alert-danger" style="display: none;"></div>
                        <div class="alert alert-success" style="display: none;"></div>
                        <form id="form1">
                            <input class="form-control w-75 mb-2" type="text" id="name" placeholder="نـام "/>
                            <input class="form-control w-75 mb-2" type="email" id="email" placeholder="ایمیل "/>
                            <input class="form-control w-75 mb-2" type="tel" id="mobile" placeholder="شمـاره موبایل"/>
                            <input class="form-control w-75 mb-2" type="text" id="subject" placeholder="موضوع پیام"/>
                            <textarea class="form-control area mb-2" cols="60" id="text" rows="9" placeholder="متن پیام"
                                      style="height: 150px!important"></textarea>
                        </form>
                    </div>

                    <a href="#" onclick="insert_contact_user()" class="btn btn-danger mb-3 text-white">ارسـال پیـام<i
                            class="fa fa-paper-plane pr-2"></i></a>
                </div>
                <div class="col-md-6 pr-md-4">
                    @if(!empty($contact_data->address))
                        <p style="position: relative;top: 15px;">
                            <span class="IRANSansWeb_Medium  text-lightgreen">
                                <i class="fa fa-map-marker ml-2"></i>آدرس: </span>
                            {!! $contact_data->address !!}
                        </p>
                    @endif
                    @if(!empty($contact_data->phone))
                        <p>
                            <span class="IRANSansWeb_Medium  text-lightgreen">
                                <i class="fa fa-phone pl-2"></i>تلفن ثابت: </span>
                            {{$contact_data->phone}}
                        </p>
                    @endif
                    @if(!empty($contact_data->mobile))
                        <p>
                            <span class="IRANSansWeb_Medium  text-lightgreen">
                                <i class="fa fa-mobile-phone pl-2"></i>تلفن همراه:  </span>
                            {{$contact_data->mobile}}
                        </p>
                    @endif
                    @if(!empty($contact_data->fax))
                        <p>
                            <span class="IRANSansWeb_Medium  text-lightgreen">
                                <i class="fa fa-fax pl-2"></i>فاکس: </span>
                            {{$contact_data->fax}}
                        </p>
                    @endif

                    <p>{{$contact_data->text}}</p>
                    <p>ما را در شبکه های اجتماعی دنبال کنید:
                        @if(!empty($contact_data->telegram))<a href="{{$contact_data->telegram}}" title="telegram"><i
                                class="fa fa-paper-plane-o pl-2 text-lightgreen"></i> </a>@endif
                        @if(!empty($contact_data->whatsapp))<a href="{{$contact_data->whatsapp}}" title="whatsapp"><i
                                class="fa fa-whatsapp pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->instagram))<a href="{{$contact_data->instagram}}" title="instagram"><i
                                class="fa fa-instagram pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->facebook))<a href="{{$contact_data->facebook}}" title="facebook"><i
                                class="fa fa-facebook pl-2 text-lightgreen"></i></a>@endif
                        <a href="https://www.linkedin.com/in/بنیاد-دکتر-محمود-شیخ-زین-الدین-303211212"
                           title="linedin"><i class="fa fa-linkedin-square pl-2 text-lightgreen"></i></a>
                        @if(!empty($contact_data->youtube))<a href="{{$contact_data->youtube}}" title="youtube"><i
                                class="fa fa-youtube pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->twitter))<a href="{{$contact_data->twitter}}" title="twitter"><i
                                class="fa fa-twitter pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->aparat))<a href="{{$contact_data->aparat}}" title="aparat"><i
                                class="fa fa-play-circle pl-2 text-lightgreen"></i></a>@endif
                    </p>
                    <div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="map1"></div>
                        </div>
                        {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3175.7976205896916!2d55.17228501478392!3d37.2525088798578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f82bf1ba6cc2105%3A0x6f7802585af2473f!2zVGFsZWdoYW5pIEhvc3BpdGFsINio24zZhdin2LHYs9iq2KfZhiDYt9in2YTZgtin2YbbjCDar9mG2KjYrw!5e0!3m2!1sen!2s!4v1571678211268!5m2!1sen!2s" class="my-4" allowfullscreen="" frameborder="0" style="width:100%"></iframe>--}}
                    </div>
                </div>
            </div>

        </div>

        <object class="d-none d-xl-block" type="image/svg+xml"
                data="{{url('user/Images/Svg/desktop-wave.svg')}}"></object>


    </section>
    <script
        src="https://maps.googleapis.com/maps/api/js?language=fa&key=AIzaSyAKefvkV0v696yGIlPgh2fzLw3ohN982U0"></script>
    <script>
        var myCenter = new google.maps.LatLng({{$contact_data->length}}, {{$contact_data->width}});

        function initialize() {
            var mapProp = {
                center: myCenter,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("map1"), mapProp);

            var marker = new google.maps.Marker({
                position: myCenter,
            });

            marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
