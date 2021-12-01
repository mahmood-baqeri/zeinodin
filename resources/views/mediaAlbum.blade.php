@extends('layouts.user.user')

@section('css')@stop
@section('js')@stop

@section('content')

    <div class="container page-top">
        <h5 class="IRANSansWeb_Medium  text-center bt-color mt-5">
            @if($type == 1)آلبوم های عکس
            @elseif($type == 2)آلبوم های فیلم
            @elseif($type == 3) آلبوم های سخنرانی
            @else آلبوم های وبینار
            @endif
        </h5>
        <div class="row mediaAlbum">
            @foreach($category as $key => $item)
                @if(\App\Media::where('category_id' , $item->id)->where('type' , $type)->first())
                    @php $slug = str_replace(" ","-" ,"$item->name");  @endphp
                    <div class="col-md-3" style="background-image: url({{asset($item->photo)}})">
                        <a href="{{route('mediaShow' ,['id' =>$item->id , 'type' => $type , 'slug' => $slug])}}">{{$item->name}}</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection


