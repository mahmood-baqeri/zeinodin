@if($user->count() != '0')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">مشاوران</h5>
        <div id="owl-topnevis" class="owl-carousel owl-theme pt-3 text-right ">
            @foreach($user as $data)
                <div class="card mx-1 text-center">
                    <div class="card-body relative">
                        <img class="pic70 rounded-circle absolute" src="{{url('image/user/'.$data->img)}}" alt="" style="top:-17px;right:35%">
                        <h6 class="IRANSansWeb_Medium mt-5">{{$data->name}} {{$data->last_name}}</h6>
                        <p class="bottom_p">{{$data->getCategory->name}}</p>
                        <a href="{{url('/consultation/'.$data->id)}}" class="btn btn-danger btn-block text-white mt-3">مشاهده جزییات </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
