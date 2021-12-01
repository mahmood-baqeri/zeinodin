<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div id="owl-slider" class="owl-carousel">
                @foreach($slider as $data)
                    <?php
                    if ($data->img == 'image.png') $src = url('/image/page/' . $data->img); else $src = url('/image/page/slider/' . $data->img);
                    if ($data->text != '') $href = url('/page/' . $data->url); else $href = $data->link;
                    ?>
                    <div class="item" style="height: 500px !important;">
                        <a href="{{$href}}" target="_blank">
                            <img src="{{$src}}" alt="" class="img-fluid" style='width:100%;height: 500px !important;'/>
                            <div class="caption"><p>@if($data->show  == '1'){{$data->title}}@endif</p></div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
