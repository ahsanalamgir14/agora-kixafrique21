@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-md-12">
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive table-responsive--sm">
                    <table class=" table align-items-center table--light">
                        <thead>
                            <tr>
                                <th>@lang('Short Code') </th>
                                <th>@lang('Description')</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td><span class="short-codes">@{{fullname}}</span></td>
                                <td>@lang('Nom complet de l\'utilisateur')</td>
                            </tr>
                            <tr>
                                <td><span class="short-codes">@{{username}}</span></td>
                                <td>@lang('Nom d\'utilisateur')</td>
                            </tr>
                            <tr>
                                <td><span class="short-codes">@{{message}}</span></td>
                                <td>@lang('Message')</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <h6 class="mt-4 mb-2">@lang('Codes courts Global')</h6>
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive table-responsive--sm">
                    <table class=" table align-items-center table--light">
                        <thead>
                            <tr>
                                <th>@lang('Petit code') </th>
                                <th>@lang('Description')</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($general->global_shortcodes as $shortCode => $codeDetails)
                            <tr>
                                <td><span class="short-codes">@{{@php echo $shortCode @endphp}}</span></td>
                                <td>{{ __($codeDetails) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card mt-5">
            <div class="card-body">
                <form action="{{ route('admin.setting.notification.global.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fw-bold">@lang('E-mail envoyé depuis') </label>
                                <input type="text" class="form-control " placeholder="@lang('Email address')"
                                    name="email_from" value="{{ $general->email_from }}" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fw-bold">@lang('Corps de l\'e-mail') </label>
                                <textarea name="email_template" rows="10" class="form-control  trumEdit"
                                    placeholder="@lang('Your email template')">{{ $general->email_template }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fw-bold">@lang('SMS envoyé depuis') </label>
                                <input class="form-control" placeholder="@lang('SMS Sent From')" name="sms_from"
                                    value="{{ $general->sms_from }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fw-bold">@lang('Corps du SMS') </label>
                                <textarea class="form-control" rows="4" placeholder="@lang('SMS Body')" name="sms_body"
                                    required>{{ $general->sms_body }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn--primary btn-global">@lang('Sauvegarder')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- card end -->
    </div>

</div>
@endsection
