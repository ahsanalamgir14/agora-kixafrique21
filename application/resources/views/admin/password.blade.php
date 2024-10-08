@extends('admin.layouts.app')
@section('panel')

<div class="row mb-none-30">
    <div class="col-lg-6 col-md-6 mb-30">
        <div class="card b-radius--5 overflow-hidden">
            <div class="card-body p-0">
                <div class="d-flex p-3 bg--primary">
                    <div class="avatar avatar--lg">
                        <img src="{{ getImage(getFilePath('adminProfile').'/'. $admin->image,getFileSize('adminProfile'))}}"
                            alt="@lang('Image')">
                    </div>
                    <div class="ps-3">
                        <h4 class="text--white">{{__($admin->name)}}</h4>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Nom')
                        <span class="fw-bold">{{ __($admin->name) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Nom d\'utilisateur')
                        <span class="fw-bold">{{ __($admin->username) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Email')
                        <span class="fw-bold">{{ $admin->email }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 mb-30">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-50 border-bottom pb-2">@lang('Changer le mot de passe')</h5>

                <form action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>@lang('Mot de passe')</label>
                        <input class="form-control" type="password" name="old_password" required>
                    </div>

                    <div class="form-group">
                        <label>@lang('Nouveau mot de passe')</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>@lang('Confirmez le mot de passe')</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn--primary btn-global">@lang('Sauvegarder')</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('breadcrumb-plugins')
<a href="{{route('admin.profile')}}" class="btn btn-sm btn--primary"><i class="las la-user"></i>@lang('Paramètre de profil')</a>
@endpush
