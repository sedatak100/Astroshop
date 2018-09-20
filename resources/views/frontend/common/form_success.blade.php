@if (session('success'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <span class="close ua-icon-alert-close content-alert__close" data-dismiss="alert"></span>
    </div>
@endif