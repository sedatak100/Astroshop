@extends('backend.layouts.default')

@section('header')
    <script type="text/javascript">
        var PC = {
            backend_api_region_cities_by_country: '{{ route('backend.api.region.cities_by_country') }}',
            backend_api_region_districts_by_city: '{{ route('backend.api.region.districts_by_city') }}',
            lang: {
                address: 'Adres',
                choose: 'Seçiniz'
            }
        };
    </script>
@endsection

@section('content')
    <div class="main-container tabs-alpha">
        <ul class="nav nav-tabs tabs-alpha__nav-tabs">
            <li class="nav-item tabs-alpha__item">
                <a class="nav-link tabs-alpha__link active show" data-toggle="tab" href="#tabs-general">
                    <span class="ua-icon-settings tabs-alpha__tab-close-icon"></span> Genel - Yeni Müşteri
                </a>
            </li>
        </ul>
        <div class="tab-content tabs-alpha__tab-content">
            <div class="tab-pane active show" id="tabs-general" role="tabpanel" aria-expanded="true">
                <form action="{{ route('backend.customer.added') }}" method="post">
                    @csrf
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control">
                                <option @if(old('status') == "0") selected
                                        @endif value="0">@lang('backend/common.status_0')</option>
                                <option @if(old('status') == "1") selected
                                        @endif value="1">@lang('backend/common.status_1')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customer_group_id">Müşteri Grubu</label>
                            <select name="customer_group_id" class="form-control">
                                @foreach($customer_groups as $customer_group)
                                    <option value="{{ $customer_group->id() }}"
                                            @if(old('customer_group_id') == $customer_group->id()) selected @endif>{{ $customer_group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Adı</label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control"
                                   id="firstname"/>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Soyadı</label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control"
                                   id="lastname"/>
                        </div>
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                   id="email"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Şifre</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                   id="password"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone"/>
                        </div>
                        <div class="form-group">
                            <label for="gsm">GSM</label>
                            <input type="text" name="gsm" value="{{ old('gsm') }}" class="form-control" id="gsm"/>
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" name="fax" value="{{ old('fax') }}" class="form-control" id="fax"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection