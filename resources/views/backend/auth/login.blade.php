@extends('backend.layouts.auth')

@section('content')
    <div class="p-signin">
        <form method="POST" action="{{ route('backend.login') }}" class="p-signin__form">
            @csrf
            <h2 class="p-signin__form-heading">Giriş Ekranı</h2>
            <div class="p-signin__form-content">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="p-signin-work-email">Email</label>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="p-signin-work-email" placeholder="email@adresi.com" autocomplete="off">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="p-signin-set-password">Şifre</label>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="p-signin-set-password" placeholder="Password" autocomplete="off">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-info btn-block btn-lg p-signin__form-submit">Giriş Yap</button>
                </div>
            </div>
        </form>
    </div>
@endsection
