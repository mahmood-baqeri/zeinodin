@if($news != '0')
    @if($news->count() != '0')
        <section class="container mt-5">
            <h5 class="IRANSansWeb_Medium  text-center bt-color">جدیدترین اخبار</h5>
            <div id="owl-toparticle" class="owl-carousel owl-theme text-right box__2">
                @foreach($news as $data)
                    <?php
                    if ($data->img != 'image.png') $src = url('/image/page/main/'.$data->img); else $src = url('/image/page/'.$data->img);
                    if ($data->text == '') $href = '#'; else $href = url('/news_detail/'.$data->url);
                    ?>
                    <a  title="{{$data->title}}" href="{{$href}}" class="card m-2">
                        <img class="card-img-top" src="{{$src}}" width='100' height='300'>
                        <div class="card-body">
                            <h6 class="IRANSansWeb_Medium">{{ $data->title }}</h6>
                            <span class="date" style="margin-top: -44%; !important;">تاریخ انتشار :  {{\Verta::instance($data->created_at)->format('%B %d، %Y')}}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endif
