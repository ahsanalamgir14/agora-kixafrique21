@extends('admin.layouts.master')
@section('content')
<div style="background-image: url('{{ asset('assets/admin/images/login.png') }}')" class="login_area">
    <div class="login">
        <div class="login__header">
            <h2>@lang('Récupérer le compte')</h2>
            <p>@lang('Nous vous enverrons un e-mail pour récupérer votre compte')</p>
        </div>
        <div class="login__body">
            <!-- <h4>user login</h4> -->
            <form action="{{ route('admin.password.reset') }}" method="POST">
                @csrf
                <div class="field">
                    <input type="email" name="email" placeholder="@lang('Email')" value="{{ old('email') }}" required>
                    <span class="show-pass"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="field">
                    <button type="submit" class="sign-in">@lang('Envoyer un e-mail')</button>
                </div>
                <div class="login__footer d-flex justify-content-center">
                    <a class="float-end" href="{{ route('admin.login') }}">@lang('Retourner')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{asset('assets/admin/css/auth.css')}}">
@endpush
