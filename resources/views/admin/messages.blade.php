@if (session('success'))
    <div class="col-md-12 messagesBox">
        <div class="alert alert-success"> {{ session('success') }}</div>
    </div>
@endif

@if (session('error'))
    @php $errors = session('error')  @endphp
    <div class="col-md-12 messagesBox">
        <p>لطفا خطا های زیر را برطرف نمایید</p>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<style>
    .messagesBox{
        padding: 0;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    .messagesBox p {
        font-weight: 900;
        font-size: 16px;
        margin-bottom: 15px;
    }
    .messagesBox ul{
        margin: 0;
        padding-right: 15px;
    }
    .messagesBox .alert{
        margin: 0;
    }
</style>
