@extends($activeTemplate . 'layouts.frontend')

@section('content')
    @include('presets.default.components.header')

    <section class="login-section py-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="log-in-box">
                        <div class="login wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            <h5 class="pb-3 text-center border-bottom">@lang('Vérifier l\'adresse e-mail')</h5>

                            <form action="{{route('user.verify.email')}}" method="POST" class="submit-form">
                                @csrf
                                <p class="verification-text mt-2">@lang('Un code de vérification à 6 chiffres envoyé à votre adresse e-mail'): {{
                                    showEmailAddress(auth()->user()->email) }}</p>

                                @include($activeTemplate.'components.verification_code')

                                <div class="mb-3">
                                    <button type="submit" class="btn btn--base w-100">@lang('sauvegarder')</button>
                                </div>

                                <div class="mb-3">
                                    <p>
                                        @lang('Si vous n\'obtenez aucun code'), <a href="{{route('user.send.verify.code', 'email')}}">
                                            @lang('Essayer à nouveau')</a>
                                    </p>

                                    @if($errors->has('resend'))
                                    <small class="text-danger d-block">{{ $errors->first('resend') }}</small>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
