@extends('layouts.user.user')
@section('content')
    <section class="container-fluid intro-section">
        <div class="container p-md-5 p-4">
            <div class="row">
                <div class="col-lg-9 text-justify text-white">
                    {!! $data->text !!}
                </div>
                <div class="col-lg-3 pt-4">
                    <img src="{{asset($data->img)}}" class="float-lg-left d-none d-lg-block img-fluid" style="width:250px;height:auto"/>
                </div>
            </div>
        </div>
    </section>
@endsection


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
               {{session('paySuccess')}}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>

        </div>
    </div>
</div>

@section('js')
    <script>
        @if (session('paySuccess'))
            $("#myModal").modal()
        @endif
    </script>
@stop
