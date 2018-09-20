@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.tax.class.edited', ['id' => $tax_class->id()]) }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name', $tax_class->name) }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description', $tax_class->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="default">Varsayılan</label>
                    <select name="default" id="default" class="form-control">
                        <option @if(old('default', config($tax_class->getConfigKey())) != $tax_class->id()) selected
                                @endif value="0">@lang('backend/common.no')</option>
                        <option @if(old('default', config($tax_class->getConfigKey())) == $tax_class->id()) selected
                                @endif value="1">@lang('backend/common.yes')</option>
                    </select>
                </div>

                <div class="form-group">
                    <table class="table table-striped table-bordered" id="table-tax-rate">
                        <thead>
                        <tr>
                            <th>Vergi Oranı</th>
                            <th>Baz</th>
                            <th>Öncelik</th>
                            <th>
                                <button type="button" class="btn btn-xs btn-success btn-new-row">
                                    <span class="btn-icon ua-icon-plus"></span>
                                </button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($tax_class->rules->count() > 0)
                            @foreach(old('rule', $tax_class->rules->toArray()) as $i => $rule)
                                <tr>
                                    <td>
                                        <select name="rule[{{ $i }}][tax_rate_id]" class="form-control selectbox">
                                            @foreach($tax_rates as $tax_rate)
                                                <option @if(old('tax_rate_id', $rule['tax_rate_id']) == $tax_rate->id()) selected @endif value="{{ $tax_rate->id() }}">{{ $tax_rate->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="rule[{{ $i }}][based]" class="form-control selectbox">
                                            <option value="shipping" @if($rule['based'] == "shipping") selected @endif>Teslimat Adresi</option>
                                            <option value="payment" @if($rule['based'] == "payment") selected @endif>Fatura Adresi</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="rule[{{ $i }}][priority]" value="{{ $rule['priority'] }}" class="form-control" />
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                            <span class="btn-icon ua-icon-remove"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <select name="rule[0][tax_rate_id]" class="form-control selectbox">
                                        @foreach($tax_rates as $tax_rate)
                                            <option @if(old('tax_rate_id') == $tax_rate->id()) selected @endif value="{{ $tax_rate->id() }}">{{ $tax_rate->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="rule[0][based]" class="form-control selectbox">
                                        <option value="shipping" @if(old('based') == "shipping") selected @endif>Teslimat Adresi</option>
                                        <option value="payment" @if(old('based') == "payment") selected @endif>Fatura Adresi</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="rule[0][priority]" value="{{ old('priority', "0") }}" class="form-control" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-danger btn-remove-row">
                                        <span class="btn-icon ua-icon-remove"></span>
                                    </button>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('backend/js/tax.js') }}"></script>
@endsection