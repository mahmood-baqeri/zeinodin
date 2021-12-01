<section class="container mt-5" id="boniadNews">
    <h5 class="IRANSansWeb_Medium  text-center bt-color"> اخبار بنیاد </h5>
    <div class="row">
        <div class="col-md-5 col-12">
            <div  class=" text-right box__2 ">
                <a  title="{{$boniadNewsSingle->name}}" href="{{route('boniadNewsFront' , $boniadNewsSingle->slug)}}" class="card m-2">
                    <img class="card-img-top" src="{{asset($boniadNewsSingle->photo)}}" width='100' height='300'>
                    <div class="card-body">
                        <h6 class="IRANSansWeb_Medium">{{ $boniadNewsSingle->name }}</h6>
                    </div>

                    <span class="date">{{  \Verta::instance($boniadNewsSingle->created_at)->format('%B %d، %Y') }}</span>
                </a>
            </div>
        </div>


        <div class="col-md-7 col-12">
            <div id="owl-boniadNews" class="owl-carousel owl-theme text-right box__2 ">
                @foreach($boniadNews as $item)
                    <a  title="{{$item->name}}" href="{{route('boniadNewsFront' , $item->slug)}}" class="card m-2">
                        <img class="card-img-top" src="{{asset($item->photo)}}" width='100' height='300'>
                        <div class="card-body">
                            <h6 class="IRANSansWeb_Medium">{{ $item->name }}</h6>
                        </div>

                        <span class="date">{{  \Verta::instance($item->created_at)->format('%B %d، %Y') }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{--'name',--}}
{{--'slug',--}}
{{--'summer',--}}
{{--'description',--}}
{{--'photo',--}}
{{--'status',--}}
{{--'metaKeywords',--}}
{{--'metaDescription'--}}
