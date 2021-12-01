@extends('layouts.user.user')
@section('content')
    <section class="container mt-5">
        <h5 class="IRANSansWeb_Medium  text-center bt-color">محصولات</h5>
        <div class="row px-md-3 grad-hover ">


            <div class="col-md-3">
                @include('components.productSide' , ['min' => $data['min'] , 'max' => $data['max'] , 'sort' => $data['sort'] , 'text' => $data['text'] ])
            </div>


            <div class="col-md-9">

                @if (session('paySuccess'))
                    <div class="col-md-12 p-0">
                        <div class="alert alert-success"
                             style=" padding-bottom: 10px !important;text-align: center;font-weight: 600">محصول با موفقیت خریداری شد ، لینک آن برای ایمیل شما ارسال می شود</div>
                    </div>
                @endif


                @if (session('payError'))
                    <div class="col-md-12 p-0">
                        <div class="alert alert-danger"
                             style=" padding-bottom: 10px !important;text-align: center;font-weight: 600"> خرید شکست خورد ، دوباره اقدام فرمایید </div>
                    </div>
                @endif


                <div class="row">
                    @forelse($products as $item)
                        <div class="col-lg-4 col-sm-6 mt-5 blogItem box__2">
                            <a href="{{route('product.detail' , $item->slug)}}" class="card m-2" title="{{$item->title}}">
                                <img height='300' class="card-img-top" src="{{asset($item->photo)}}"
                                     alt="{{$item->title}}">
                                <div class="card-body">
                                    <h6>{{$item->name}}</h6>
                                    <p>{{number_format($item->price)}} تومان </p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h1 class="notFound">موردی یافت نشد</h1>
                    @endforelse
                </div>
            </div>



        </div>
    </section>
@endsection
