@if($site->count() != '0')
    <section class="container py-3 py-sm-3"><br>
        @foreach($site as $data)
            <div class="row">
                <a href='{{$data->link}}' target='_blank'>
                    @if($data->row_co == '1')
                        <div class="col-lg-12 col-md-12">
                            <div class="value-body d-flex flex-column text-center">
                                <img src="{{url('image/page/site/'.$data->img)}}" class="img-fluid">
                            </div>
                        </div>
                    @elseif($data->row_co == '2')
                        <div class="col-lg-6 col-md-6">
                            <div class="value-body d-flex flex-column text-center">
                                <img src="{{url('image/page/site/'.$data->img)}}" class="img-fluid">
                            </div>
                        </div>
                    @elseif($data->row_co == '3')
                        <div class="col-lg-4 col-md-4">
                            <div class="value-body d-flex flex-column text-center">
                                <img src="{{url('image/page/site/'.$data->img)}}" class="img-fluid">
                            </div>
                        </div>
                    @elseif($data->row_co == '4')
                        <div class="col-lg-3 col-md-3">
                            <div class="value-body d-flex flex-column text-center">
                                <img src="{{url('image/page/site/'.$data->img)}}" class="img-fluid">
                            </div>
                        </div>
                    @endif
                </a>
            </div>
        @endforeach
    </section>
@endif
