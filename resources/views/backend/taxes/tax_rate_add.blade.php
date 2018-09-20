@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.tax.rate.added') }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"/>
                </div>
                <div class="form-group">
                    <label for="rate">Oran</label>
                    <input type="text" name="rate" value="{{ old('rate') }}" class="form-control" id="rate"/>
                </div>
                <div class="form-group">
                    <label for="type">Tür</label>
                    <select name="type" class="form-control" id="type">
                        <option @if(old('type') == 'percent') selected @endif value="percent">Yüzde</option>
                        <option @if(old('type') == 'amount') selected @endif value="amount">Sabit Tutar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer_group_ids">Müşteri Grubu</label>
                    <select name="customer_group_ids[]" id="customer_group_ids" class="form-control" multiple>
                        @foreach($customer_groups as $customer_group)
                            <option @if(old('customer_group_ids') && in_array($customer_group->id(), old('customer_group_ids'))) selected @endif value="{{ $customer_group->id() }}">{{ $customer_group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="region_scope_id">Bölge</label>
                    <select name="region_id" id="region_scope_id" class="form-control">
                        @foreach($regions as $region)
                            <option @if(old('region_scope_id') == $region->id()) selected @endif value="{{ $region->id() }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')

@endsection