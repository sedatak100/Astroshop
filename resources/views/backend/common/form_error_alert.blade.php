@if ($errors->any())
<div class="alert content-alert content-alert--danger mt-4" role="alert">
    <div class="content-alert__info">
        <span class="content-alert__info-icon ua-icon-warning"></span>
    </div>
    <div class="content-alert__content">
        <div class="content-alert__heading">Lütfen aşağıda yazan hataları düzeltin.</div>
        <div class="content-alert__message">
            @foreach ($errors->all() as $i => $error)
                {{ $error }}<br />
            @endforeach
        </div>
    </div>
    <span class="close ua-icon-alert-close content-alert__close" data-dismiss="alert"></span>
</div>
@endif