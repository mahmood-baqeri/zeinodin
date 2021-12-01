@if($customer->count() != '0')
    <section class="container-fluid mt-5 grad-bg px-md-5 pt-3 pb-5">
        <h5 class="IRANSansWeb_Medium  text-white pb-3">سازمان های همکار</h5>
        <div id="owl-secondevent" class="owl-carousel owl-theme text-right ">
            @foreach($customer as $data)
                <?php if($data->link != '') $href = $data->link; else $href = '#'; ?>
                <div class="mx-2">
                    <a href="{{$href}}" target="_blank">
                        <?php if ($data->img == 'image.png') $src = url('image/page/'.$data->img); else $src = url('image/page/customer/'.$data->img); ?>
                        <img src="{{$src}}" class="img-responsive " width='150' height='150'/>
                        {{--<div class="blogdiv">--}}
                            {{--<h6 class="IRANSansWeb_Medium text-white text-shadow">{{$data->title}}</h6>--}}
                        {{--</div>--}}
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endif
