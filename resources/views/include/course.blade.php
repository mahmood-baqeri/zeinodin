@if($course->count() != '0')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">آخرین رویدادها </h5>
        <div id="owl-Comments" class="owl-carousel owl-theme pt-3 text-right box__2">
            @foreach($course as $data)
                <?php if ($data->text == '') $href = '#'; else $href = url('/events_detail/'.$data->url);?>
                    <a  title="{{$data->title}}" href="{{$href}}" class="card m-2" title="{{$data->title}}">
                        <img  class="card-img-top" src="{{url('image/course/'.$data->img)}}" height='300'>
                        <div class="card-body">
                            <h6 class="IRANSansWeb_Medium">{{$data->title}}</h6>
                            <span class="date__2">تاریخ برگزاری : {{$data->time}}</span>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-row">

                                @if(file_exists(url('image/user/'.$data->getUser->img)))
                                    <img  src="{{url('image/user/'.$data->getUser->img)}}" class="img-fluid rounded-circle ml-3 pic55" />
                                @else
                                    <img src="{{url('image/page/contacts/'.$contact_data->logo)}}" class="img-fluid rounded-circle ml-3 pic55"/>
                                @endif

                                <div>
                                    <p class="text-dark IRANSansWeb_Medium bottom_p">{{$data->getUser->name}} {{$data->getUser->last_name}}</p>
{{--                                    <span class="IRANSansWeb_Medium text-dark"><i class="fas fa-clock"></i>{{$data->date_insert}}</span>--}}
                                </div>
                            </div>
                        </div>
                    </a>
            @endforeach
        </div>
    </section>
@endif
