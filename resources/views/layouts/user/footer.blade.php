<footer class="container-footer">
    <section id="footer-content">
        <div class="container">
            <div class="row pt-4">
                <div class="col-md-2  col-sm-4 col-6 py-3">
                    <img src="{{url('image/page/contacts/'.$contact_data->logo)}}" class="img-fluid">
                </div>
                <div class="col-md-2 col-sm-4 col-6  py-3">
                    <h6 class="IRANSansWeb_Medium"> صفحات ما : </h6>
                    <ul>
                        <li><a href="{{url('/news/اخبار')}}" target="_blank" title="اخبار">اخبار</a></li>
                        <li><a href="{{url('/about')}}" target="_blank" title="درباره ما">درباره ما</a></li>
                        <li><a href="{{url('/contact')}}" target="_blank" title="تماس با ما">تماس با ما </a></li>
                    </ul>
                </div>
                <div class="col-md-5 col-sm-4 py-3">
                    <h6 class="IRANSansWeb_Medium">راه های ارتباطی با ما:</h6>

                    @if(!empty($contact_data->address))<p class="mt-0"><span class="IRANSansWeb_Medium  text-lightgreen"><i class="fa fa-map-marker ml-2"></i></span>{!! $contact_data->address !!}</p>@endif
                    @if(!empty($contact_data->phone))<p class="mt-0"><span class="IRANSansWeb_Medium  text-lightgreen"><i class="fa fa-phone pl-2"></i></span>{{$contact_data->phone}}</p></p>@endif
                    @if(!empty($contact_data->mobile))<p class="mt-0"><span class="IRANSansWeb_Medium  text-lightgreen"><i class="fa fa-mobile-phone pl-2"></i></span>{{$contact_data->mobile}}</p>@endif
                    @if(!empty($contact_data->fax))<p class="mt-0"><span class="IRANSansWeb_Medium  text-lightgreen"><i class="fa fa-fax pl-2"></i></span>{{$contact_data->fax}}</p>@endif

                </div>
                <div class="col-md-3 col-sm-4 py-3">
                    <h6 class="IRANSansWeb_Medium">ما را در شبکه های اجتماعی دنبال کنید:</h6>
                    <p>
                        @if(!empty($contact_data->telegram))<a href="{{$contact_data->telegram}}" title="telegram"><i class="fa fa-paper-plane-o pl-2 text-lightgreen"></i> </a>@endif
                        @if(!empty($contact_data->whatsapp))<a href="{{$contact_data->whatsapp}}" title="whatsapp"><i class="fa fa-whatsapp pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->instagram))<a href="{{$contact_data->instagram}}" title="instagram"><i class="fa fa-instagram pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->facebook))<a href="{{$contact_data->facebook}}" title="facebook"><i class="fa fa-facebook pl-2 text-lightgreen"></i></a>@endif
                        <a href="https://www.linkedin.com/in/بنیاد-دکتر-محمود-شیخ-زین-الدین-303211212" title="linedin"><i class="fa fa-linkedin-square pl-2 text-lightgreen"></i></a>
                        @if(!empty($contact_data->youtube))<a href="{{$contact_data->youtube}}" title="youtube"><i class="fa fa-youtube pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->twitter))<a href="{{$contact_data->twitter}}" title="twitter"><i class="fa fa-twitter pl-2 text-lightgreen"></i></a>@endif
                        @if(!empty($contact_data->aparat))<a href="{{$contact_data->aparat}}" title="aparat"><i class="fa fa-play-circle pl-2 text-lightgreen"></i></a>@endif

                    </p>
                <a target="_blank" rel="origin" href="https://trustseal.enamad.ir/?id=157805&amp;Code=ABrr0FLhcCPDAg9mqCei"><img src="https://Trustseal.eNamad.ir/logo.aspx?id=157805&amp;Code=ABrr0FLhcCPDAg9mqCei" alt="" style="cursor:pointer" id="ABrr0FLhcCPDAg9mqCei"></a>

                </div>

            </div>
        </div>
    </section>
    <section id="footer-allright">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 text-center text-white">کلیه حقوق مادی و معنوی این وب سایت توسط
                    <a href="{{url('/')}}" class="text-white"> {{$contact_data->name_site}}  </a>
                    محفوظ می باشد. | طراحی شده توسط
                    <a href="http://baclass.org" target='_blank' class="text-white"> تیم باکلاس </a>
                </div>
            </div>
        </div>
    </section>
</footer>
