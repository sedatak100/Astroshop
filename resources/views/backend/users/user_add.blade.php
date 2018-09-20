@extends('backend.layouts.default')

@section('header')

@endsection

@section('content')
    <div class="main-container">
        <form action="{{ route('backend.user.added') }}" method="post">
            @csrf
            <div class="col-lg-6 col-md-6">
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
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email"/>
                </div>
                <div class="form-group">
                    <label for="user_group_id">Grup</label>
                    <select name="user_group_id" id="user_group_id" class="form-control" required>
                        @foreach($user_groups as $user_group)
                            <option @if(old('user_group_id') == $user_group->id()) selected
                                    @endif value="{{ $user_group->id() }}">{{ $user_group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="text" name="password" value="" class="form-control" id="password" required />
                </div>
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
                    <button type="submit" class="btn btn-info">@lang('backend/common.add')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')

@endsection