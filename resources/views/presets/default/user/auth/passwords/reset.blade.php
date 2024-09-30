@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include('presets.default.components.header')
    <section class="login-section py-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="log-in-box">
                        <div class="login wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">

                            <h5 class="card-title">@lang('Réinitialiser le mot de passe')</h5>
                            <div class="mb-4">
                                <p>@lang('Votre compte est vérifié avec succès. Vous pouvez maintenant modifier votre mot de passe. Veuillez saisir un mot de passe fort et ne le partagez avec personne.')</p>
                            </div>
                            <form method="POST" action="{{ route('user.password.update') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label class="form-label">@lang('Mot de passe')</label>
                                <input type="password" class="form-control form--control" name="password" required>
                                @if ($general->secure_password)
                                    <div class="input-popup">
                                        <p class="error lower">@lang('1 petite lettre minimum')</p>
                                        <p class="error capital">@lang('1 lettre majuscule minimum')</p>
                                        <p class="error number">@lang('1 numéro minimum')</p>
                                        <p class="error special">@lang('1 caractère spécial minimum')</p>
                                        <p class="error minimum">@lang('Mot de passe à 6 caractères')</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Confirmez le mot de passe')</label>
                                <input type="password" class="form-control form--control" name="password_confirmation"
                                    required>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn--base w-100"> @lang('Sauvegarder')</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script-lib')
    <script src="{{ asset('assets/common/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            @if ($general->secure_password)
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });

                $('[name=password]').focus(function() {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').focusout(function() {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });
            @endif
        })(jQuery);
    </script>
@endpush
