@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <form action="{{ route('backend.currency.edited', ['id' => $currency->id()]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Adı</label>
                        <input type="text" name="name" value="{{ old('name', $currency->name) }}" class="form-control"
                               id="name"/>
                    </div>
                    <div class="form-group">
                        <label for="code">Kodu</label>
                        <input type="text" name="code" value="{{ old('code', $currency->code) }}" class="form-control"
                               id="code"/>
                    </div>
                    <div class="form-group">
                        <label for="decimal_place">Ondalık</label>
                        <input type="text" name="decimal_place"
                               value="{{ old('decimal_place', $currency->decimal_place) }}"
                               class="form-control" id="decimal_place"/>
                    </div>
                    <div class="form-group">
                        <label for="symbol_left">Sol Sembol</label>
                        <input type="text" name="symbol_left" value="{{ old('symbol_left', $currency->symbol_left) }}"
                               class="form-control" id="symbol_left"/>
                    </div>
                    <div class="form-group">
                        <label for="symbol_right">Sağ Sembol</label>
                        <input type="text" name="symbol_right"
                               value="{{ old('symbol_right', $currency->symbol_right) }}"
                               class="form-control" id="symbol_right"/>
                    </div>
                    <div class="form-group">
                        <label for="value">Değer</label>
                        <input type="text" name="value" value="{{ old('value', $currency->value) }}"
                               class="form-control"
                               id="value"/>
                    </div>
                    <div class="form-group">
                        <label for="status">Varsayılan</label>
                        <select name="default" id="status" class="form-control">
                            <option @if(old('default', config($currency->getConfigKey())) != $currency->id()) selected
                                    @endif value="0">@lang('backend/common.no')</option>
                            <option @if(old('default', config($currency->getConfigKey())) == $currency->id()) selected
                                    @endif value="1">@lang('backend/common.yes')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">@lang('backend/common.edit')</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6">
                <table class="table table-striped table-no-border">
                    <thead>
                    <tr>
                        <th colspan="4" class="text-center">Son Güncellemeler</th>
                    </tr>
                    <tr>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th>Eski Değer</th>
                        <th>Yeni Değer</th>
                        <th>Açıklama</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currency->histories as $history)
                        <tr>
                            <td>{{ $history->createdAt() }}</td>
                            <td class="text-center">
                                @if($history->old_value > $history->value)
                                    <span class="ua-icon-arrow-circle-down" data-toggle="tooltip" title="Düşüş"></span>
                                @elseif($history->old_value == $history->value)
                                    <span class="ua-icon-buttons" data-toggle="tooltip" title="Eşit"></span>
                                @else
                                    <span class="ua-icon-arrow-square-up" data-toggle="tooltip" title="Yükseliş"></span>
                                @endif
                            </td>
                            <td>{{ $history->old_value }}</td>
                            <td>{{ $history->value }}</td>
                            <td>{{ $history->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection