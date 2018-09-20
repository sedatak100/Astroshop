@if ($errors->any())
    <div class="col-md-12">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $i => $error)
                {{ $error }}<br/>
            @endforeach
        </div>
        <span class="close ua-icon-alert-close content-alert__close" data-dismiss="alert"></span>
    </div>
@endif