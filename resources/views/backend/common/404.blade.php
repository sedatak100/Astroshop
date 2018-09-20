@extends('backend.layouts.default')
@section('content')
    <h3>test</h3>
    <div class="page-content">

        <div class="container-fluid p-error-page p-error-page--404">
            <div class="p-error-page__wrap">
                <div class="p-error-page__error">
                    <h3 class="p-error-page__code">404</h3>
                    <div class="p-error-page__desc">Page not found</div>
                    <a href="#" class="btn btn-info p-error-page__home-link">Main page</a>
                </div>
                <div class="p-error-page__image-container">
                    <img src="img/robot.png" alt="" class="p-error-page__image embed-responsive">
                </div>
            </div>
        </div>

    </div>
@endsection