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
                <a class="nav-link tabs-alpha__link @if(!$is_new_address && !$is_edit_address) active show @endif" data-toggle="tab" href="#tabs-general">
                    <span class="ua-icon-settings tabs-alpha__tab-close-icon"></span> Genel
                </a>
            </li>
            <li class="nav-item tabs-alpha__item">
                <a class="nav-link tabs-alpha__link @if($is_new_address || $is_edit_address) active show @endif" data-toggle="tab" href="#tabs-address">
                    <span class="ua-icon-alert-comment tabs-alpha__tab-close-icon"></span> Adresler
                </a>
            </li>
        </ul>
        <div class="tab-content tabs-alpha__tab-content">
            <div class="tab-pane @if(!$is_new_address && !$is_edit_address) active show @endif" id="tabs-general" role="tabpanel" aria-expanded="true">
                <form action="{{ route('backend.customer.edited', ['id' => $customer->id()]) }}" method="post">
                    @csrf
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control">
                                <option @if(old('status', $customer->status) == "0") selected
                                        @endif value="0">@lang('backend/common.status_0')</option>
                                <option @if(old('status', $customer->status) == "1") selected
                                        @endif value="1">@lang('backend/common.status_1')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customer_group_id">Müşteri Grubu</label>
                            <select name="customer_group_id" class="form-control">
                                @foreach($customer_groups as $customer_group)
                                    <option value="{{ $customer_group->id() }}"
                                            @if(old('customer_group_id', $customer->customer_group_id) == $customer_group->id()) selected @endif>{{ $customer_group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Adı</label>
                            <input type="text" name="firstname" value="{{ old('firstname', $customer->firstname) }}"
                                   class="form-control"
                                   id="firstname"/>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Soyadı</label>
                            <input type="text" name="lastname" value="{{ old('lastname', $customer->lastname) }}"
                                   class="form-control"
                                   id="lastname"/>
                        </div>
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                   class="form-control"
                                   id="email"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Şifre</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                   id="password" placeholder="Değiştirilmeyecekse boş bırakınız"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                                   class="form-control" id="phone"/>
                        </div>
                        <div class="form-group">
                            <label for="gsm">GSM</label>
                            <input type="text" name="gsm" value="{{ old('gsm', $customer->gsm) }}" class="form-control"
                                   id="gsm"/>
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" name="fax" value="{{ old('fax', $customer->fax) }}" class="form-control"
                                   id="fax"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">@lang('backend/common.edit')</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane @if($is_new_address || $is_edit_address) active show @endif" id="tabs-address" role="tabpanel" aria-expanded="false">
                <div>
                    <ul class="nav nav-tabs" role="tablist" id="subtab-address">
                        @foreach($customer->addresses() as $address)
                            <li class="nav-item">
                                <a class="nav-link @if($is_edit_address && $address->id() == $edit_address->id()) active show @endif "
                                   href="{{ route('backend.customer.edit', ['id' => $customer->id(), 'edit_address_id' => $address->id()]) }}"
                                   role="tab"
                                   aria-controls="home" aria-expanded="true" aria-selected="false"
                                   @if($address->id() == $customer->address_id) data-toggle="tooltip" title="Varsayılan Adres" @endif">
                                    <i class="@if($address->id() == $customer->address_id) text-success @endif">{{ $address->title }}</i>
                                    <span class="ua-icon-minus-square-alt btn-remove-alert"
                                    data-href="{{ route('backend.customer.address.remove', ['id' => $address->id()]) }}"></span>
                                </a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link @if($is_new_address) active show @endif"
                               href="{{ route('backend.customer.edit', ['id' => $customer->id(), 'new_address' => true]) }}"
                               role="tab"
                               aria-controls="home" aria-expanded="true" aria-selected="false">
                                <i>Yeni Adres</i>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @if($is_edit_address)
                            <div class="tab-pane active show" id="address_edit" aria-expanded="true">
                            <form action="{{ route('backend.customer.address.edited', ['id' => $edit_address->id()]) }}"
                                  method="post">
                                @csrf
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="default">Varsayılan</label>
                                        <select name="default" class="form-control">
                                            <option @if(old('default', $customer->address_id) != $edit_address->id()) selected @endif value="0">@lang('backend/common.no')</option>
                                            <option @if(old('default', $customer->address_id) == $edit_address->id()) selected @endif value="1">@lang('backend/common.yes')</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Adres Başlığı</label>
                                        <input type="text" name="title"
                                               value="{{ old('title', $edit_address->title) }}" class="form-control"
                                               placeholder="Ev Adresi, İş Adresi vs.."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">Adı</label>
                                        <input type="text" name="firstname" value="{{ old('firstname', $edit_address->firstname) }}"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Soyadı</label>
                                        <input type="text" name="lastname" value="{{ old('lastname', $edit_address->lastname) }}"
                                               class="form-control" id="lastname"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Şirket</label>
                                        <input type="text" name="company" value="{{ old('company', $edit_address->company) }}"
                                               class="form-control" id="company"/>
                                    </div>
                                    <div class="global-region">
                                    <div class="form-group">
                                        <label for="country_id">Ülke</label>
                                        <select name="country_id" class="form-control select-country">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_id">Şehir</label>
                                        <select name="city_id" class="form-control select-city">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district_id">İlçe</label>
                                        <select name="district_id" class="form-control select-district"
                                                data-selected_id="{{ old('district_id', $edit_address->district_id) }}">
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address1">Adres 1</label>
                                        <input type="text" name="address1" value="{{ old('address1', $edit_address->address1) }}"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="address2">Adres 2</label>
                                        <input type="text" name="address2" value="{{ old('address2', $edit_address->address2) }}"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="postcode">Posta Kodu</label>
                                        <input type="text" name="postcode" value="{{ old('postcode', $edit_address->postcode) }}"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">@lang('backend/common.edit')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @elseif($is_new_address)
                            <div class="tab-pane active show " id="address_new" aria-expanded="true">
                                <form action="{{ route('backend.customer.address.added', ['id' => $customer->id()]) }}"
                                      method="post">
                                    @csrf
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="default">Varsayılan</label>
                                            <select name="default" class="form-control">
                                                <option @if(old('default') == "0") selected @endif value="0">@lang('backend/common.no')</option>
                                                <option @if(old('default') == "1") selected @endif value="1">@lang('backend/common.yes')</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Adres Başlığı</label>
                                            <input type="text" name="title"
                                                   value="{{ old('title') }}" class="form-control"
                                                   placeholder="Ev Adresi, İş Adresi vs.."/>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstname">Adı</label>
                                            <input type="text" name="firstname" value="{{ old('firstname') }}"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Soyadı</label>
                                            <input type="text" name="lastname" value="{{ old('lastname') }}"
                                                   class="form-control" id="lastname"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="company">Şirket</label>
                                            <input type="text" name="company" value="{{ old('company') }}"
                                                   class="form-control" id="company"/>
                                        </div>
                                        <div class="global-region">
                                            <div class="form-group">
                                                <label for="country_id">Ülke</label>
                                                <select name="country_id" class="form-control select-country">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="city_id">Şehir</label>
                                                <select name="city_id" class="form-control select-city">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="district_id">İlçe</label>
                                                <select name="district_id" class="form-control select-district"
                                                        data-selected_id="{{ old('district_id') }}" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address1">Adres 1</label>
                                            <input type="text" name="address1" value="{{ old('address1') }}"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="address2">Adres 2</label>
                                            <input type="text" name="address2" value="{{ old('address2') }}"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="postcode">Posta Kodu</label>
                                            <input type="text" name="postcode" value="{{ old('postcode') }}"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')

@endsection