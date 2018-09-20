@extends('backend.layouts.default')
@section('content')
    <div class="main-container container-fh__content">
        <div class="alert custom-alert custom-alert--danger" role="alert">
            <!--<span class="close ua-icon-alert-close custom-alert__close" data-dismiss="alert"></span>-->
            <div class="custom-alert__top-side">
                <span class="alert-icon ua-icon-alert-warning custom-alert__icon"></span>
                <div class="custom-alert__body">
                    <h6 class="custom-alert__heading">
                        Erişim Engellendi!
                    </h6>
                    <div class="custom-alert__content">
                        <p>Bu sayfayı görüntüleme yetkiniz bulunmamaktır.</p>
                        <a href="{{ route('backend.home.index') }}" class="link-info link-info--bordered">Anasayfa</a>
                    </div>
                </div>
            </div>
            <div class="custom-alert__bottom-side">
                <ul class="custom-alert__error-desc">
                    <li class="custom-alert__error-desc-item">
                        <span class="custom-alert__error-desc-number color-error">1</span>
                        <span class="custom-alert__error-desc-error">Yetkiniz olmadığı için bu sayfayı görüntülüyor olabilirsiniz.</span>
                    </li>
                    <li class="custom-alert__error-desc-item">
                        <span class="custom-alert__error-desc-number color-error">2</span>
                        <span class="custom-alert__error-desc-error">Bu sayfayı görüntülemek için yönetici ile iletişime geçebilirsiniz.</span>
                    </li>
                </ul>
                <div class="custom-alert__tips">
                    Bu sayfayı yanlışlıkla görüntülendiğini düşünüyorsanız lütfen <a href="{{ url()->current() }}" class="color-error">buradan</a> sayfayı yenileyiniz.
                </div>
            </div>
        </div>
    </div>
@endsection