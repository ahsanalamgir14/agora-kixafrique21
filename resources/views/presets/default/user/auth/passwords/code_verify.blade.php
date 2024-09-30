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
                            <div class="mb-4">
                                <p>@lang('Pour récupérer votre compte, veuillez fournir votre email ou votre nom d\'utilisateur pour trouver votre compte')
                                </p>
                            </div>
                            <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form">
                                @csrf
                                <p class="verification-text">@lang('Un code de vérification à 6 chiffres envoyé à votre adresse e-mail')
                                    : {{ showEmailAddress($email) }}</p>
                                <input type="hidden" name="email" value="{{ $email }}">

                                @include($activeTemplate.'components.verification_code')

                                <div class="form-group">
                                    <button type="submit" class="btn btn--base w-100">@lang('Sauvegarder')</button>
                                </div>

                                <div class="form-group">
                                    @lang('Veuillez vérifier votre dossier Courrier indésirable/Spam. si vous ne le trouvez pas, vous pouvez')
                                   <u> <a href="{{ route('user.password.request') }}" class="text--base">@lang('Essayez d\'envoyer à nouveau')</a></u>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
