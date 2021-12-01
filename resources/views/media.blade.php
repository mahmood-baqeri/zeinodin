@extends('layouts.user.user')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">

    <style>
        #demo {
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .green {
            background-color: #6fb936;
        }

        .thumb {
            margin-bottom: 30px;
        }

        .page-top {
            margin-top: 40px;
        }

        img.zoom, video.img-fluid {
            cursor: pointer;
            width: 100%;
            height: 200px !important;
            border-radius: 5px 5px 0 0;
            object-fit: cover;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
        }

        .transition {
            -webkit-transform: scale(1.08);
            -moz-transform: scale(1.08);
            -o-transform: scale(1.08);
            transform: scale(1.08);
        }

        .modal-header {

            border-bottom: none;
        }

        .modal-title {
            color: #000;
        }

        .modal-footer {
            display: none;
        }

        h1 {

        }
    </style>
@stop

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
            $(".zoom").hover(function () {
                $(this).addClass('transition');
            }, function () {
                $(this).removeClass('transition');
            });

        });

        @foreach($media as $key => $item)
        $('#modal_{{$key}}').on('hidden.bs.modal', function (e) {
            $('#modal_{{$key}} iframe').attr("src", $("#modal1 iframe").attr("src"));
        });
        @endforeach

    </script>
@stop

@section('content')

    <div class="container page-top">
        <h5 class="IRANSansWeb_Medium  text-center bt-color mt-5">{{$category->name}}</h5>
        <div class="row">

            @foreach($media as $key => $item)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                @if($item->type == 1)
                    <a href="{{asset($item->file)}}" class="fancybox" rel="ligthbox">
                        <img src="{{asset($item->file)}}" class="zoom img-fluid" alt="" />
                        <p class="mediaParagraph ph">{{$item->title}}</p>
                    </a>
                @else
                    <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body mb-0 p-0">
                                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                        <video class="embed-responsive-item" controls>
                                            <source src="{{asset($item->file)}}" type="video/mp4" />
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a>
                        <video class="img-fluid z-depth-1" src="{{asset($item->file)}}" alt="video" data-toggle="modal"
                               data-target="#modal_{{$key}}"></video>
                        <p class="mediaParagraph mo" style="height: 90px">{{$item->title}}</p>
                    </a>

                @endif
                </div>
            @endforeach

        </div>
    </div>
@endsection


