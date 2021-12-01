@extends('layouts.user.user')
@section('content')
    <section class="container-fluid intro-section">
        <div class="container p-md-5 p-4">
            <div class="row">

                <div class="col-lg-9 text-justify text-white">
                    <p>شما میتوانید از طریق لینک زیر  محصول را دانلود نمایید. با تشکر </p>
                    <a href="{{ session()->get('downloadLink') }}" style="font-size: 18px ; color:#000 !important ; font-weight: 900; ;background: #f5b62d;padding:10px 30px;    border-radius: 5px;">لینک دانلود </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@if (session('paySuccess'))
    @section('js')
        <script>
            alert('خرید با موفقست انجام شد');
        </script>
    @stop
@endif
