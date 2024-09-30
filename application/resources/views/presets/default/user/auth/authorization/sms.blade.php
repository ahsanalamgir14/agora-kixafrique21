@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include('presets.default.components.header')

    <section class="login-section py-115">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <h5 class="pb-3 text-center border-bottom">@lang('Vérifier le numéro de mobile')</h5>
                        <form action="{{ route('user.verify.mobile') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text">@lang('Un code de vérification à 6 chiffres envoyé à votre numéro de mobile') : +{{ showMobileNumber(auth()->user()->mobile) }}
                            </p>
                            @include($activeTemplate . 'components.verification_code')
                            <div class="mb-3">
                                <button type="submit" class="btn btn--base w-100">@lang('Sauvegarder')</button>
                            </div>
                            <div class="form-group">
                                <p>
                                    @lang('Si vous n\'obtenez aucun code'), <a href="{{ route('user.send.verify.code', 'phone') }}"
                                        class="forget-pass"> @lang('Essayer à nouveau')</a>
                                </p>
                                @if ($errors->has('resend'))
                                    <br />
                                    <small class="text-danger">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
