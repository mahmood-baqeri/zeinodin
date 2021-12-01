@if($service != '0')
    @if($service->count() != '0')
        <section class="container py-3 py-sm-3 ">
            <div class="row  mt-4 mx-1">
                @foreach($service as $data)
                    <?php
                    if ($data->img != 'image.png') $src = url('/image/page/main/'.$data->img); else $src = url('/image/page/'.$data->img);
                    if ($data->text == '') $href = ''; else $href = url('/blog_detail/'.$data->url);
                    ?>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="value-body d-flex flex-column text-center">
                            <a href="{{$href}}">
                                <img src="{{$src}}" height="100px" />
                                <div class="p-3">
                                    <h6 class="IRANSansWeb_Medium">{{$data->title}}</h6>
                                    <p>{{$data->text_short}} </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endif