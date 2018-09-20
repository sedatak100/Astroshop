@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
<div class="main-container">
    <form action="{{ route('backend.user.group.added') }}" method="post">
        @csrf
        <div class="col-lg-8 col-md-8">
            <div class="form-group">
                <label for="name">Yetki Adı</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" required />
            </div>
            <div class="form-group">
                <label for="name">Yetkiler</label>
                @foreach($permissions as $permission)
                    <div class="form-group">
                        <h3 class="title">{{ $permission['name'] }}</h3>
                        <div class="row">
                            @foreach($permission['roles'] as $role)
                                <div class="col-lg-4">
                                    <input type="checkbox"
                                           name="permission[]"
                                           value="{{ implode(';', $role['routes']) }}"
                                           class="switch-simple switch-simple--sm switch-simple--primary mr-3">
                                    {{ $role['name'] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
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