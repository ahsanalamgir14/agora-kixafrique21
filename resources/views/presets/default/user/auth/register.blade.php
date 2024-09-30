@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $credentials = $general->socialite_credentials;
    @endphp


    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="{{ asset ('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset ('assets/js/popper.js') }}"></script>
    <script src="{{ asset ('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('assets/js/main.js') }}"></script>
 

   <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('Inscrivez vous')</h5>
                    <span class="close" data-bs-dismiss="modal">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('Vous avez déjà un compte veuillez vous connecter ')</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Fermer')</button>
                    <a href="{{ route('user.login') }}" class="btn btn--base btn-sm">@lang('Connexion')</a>
                </div>
            </div>
        </div>
    </div>

    @include('presets.default.components.header')
    <section class="signup-section" style='background-image: url("../assets/images/hero.png"); background-repeat: repeat;background-size: contain; resize: both;'>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12" style="background-color: #ffffff;">
                    <div class="log-in-box wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                        <div class="sign-up_box wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            <h3 class="title wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                                @lang('Inscrivez vous s\'il vous plait')
                            </h3>
                            <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha">
                                @csrf
                                <div class="row wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input class="form--control checkUser" placeholder="" name="username"
                                                value="{{ old('username') }}" required>
                                            <label class="form--label">@lang('Nom d\'utilisateur') </label>
                                            <small class="text-danger usernameExist"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input class="form--control mb-3 checkUser" placeholder="" name="email"
                                                value="{{ old('email') }}">
                                            <label class="form--label">@lang('Email')</label>
                                            <small class="text-danger emailExist"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row wow animate__animated animate__fadeInUp" data-wow-delay="0.6s">
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <select class="form--control select form-select" name="country">
                                                    @foreach ($countries as $key => $country)
                                                        <option  data-mobile_code="{{ $country->dial_code }}"
                                                            value="{{ $country->country }}" data-code="{{ $key }}">
                                                            {{ __($country->country) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-lg-6 col-md-6 mb-3">
                                        <div class="form-group">
                                            <div class="input-group mb-3" style="color: white;">
                                                <span class="input-group-text mobile-code">
                                                </span>
                                                <input type="hidden" name="mobile_code">
                                                <input type="hidden" name="country_code">
                                                <input type="number"
                                                    class="form--control form-control form--control checkUser"
                                                    placeholder="Téléphone" name="mobile" value="{{ old('mobile') }}"
                                                    aria-label="Montant en CFA (avec point et deux décimales)" required>
                                            </div>
                                            <small class="text-danger mobileExist"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
                                    <div class="col-xxl-6 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input class="form--control mb-3" placeholder="" name="password">
                                            <label class="form--label">@lang('Mot de passe')</label>
                                            @if ($general->secure_password)
                                                <div class="input-popup">
                                                    <p class="error lower">@lang('1 petite lettre minimum')</p>
                                                    <p class="error capital">@lang('1 lettre majuscule minimum')</p>
                                                    <p class="error number">@lang('1 chiffre minimum')</p>
                                                    <p class="error special">@lang('1 caractère spécial minimum')</p>
                                                    <p class="error minimum">@lang('Mot de passe à 6 caractères')</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-lg-6 col-md-6 mb-3">
                                        <div class="form-group">
                                            <input class="form--control mb-3" placeholder="" name="password_confirmation">
                                            <label class="form--label">@lang('Entrez à nouveau le mot de passe')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row wow animate__animated animate__fadeInUp" data-wow-delay="0.8s">
                                    <div class="col-xxl-12 col-lg-12 col-md-12 mb-3">
                                        <div class="form-group">
                                            <x-captcha></x-captcha>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 form--check wow animate__animated animate__fadeInUp"
                                    data-wow-delay="0.9s">
                                    @if ($general->agree)
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" id="agree"
                                                @checked(old('agree')) name="agree" required>
                                            <label for="agree">@lang('Je suis d\'accord avec license Info,') @foreach ($policyPages as $policy)
                                                    <a class="text--base"
                                                        href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}">{{ __($policy->data_values->title) }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </label>
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn--base wow animate__animated animate__fadeInUp"
                                    data-wow-delay="0.2s">@lang('Enregistrer')</button>
                            </form>


                            <!-- {{-- social box --}}
                            <div class="social-option">
                                <div class="text">
                                    <h6>ou</h6>
                                </div>
                                @if ($credentials->google->status == 1 || $credentials->facebook->status == 1 || $credentials->linkedin->status == 1)
                                    <ul class="login-with">
                                        @if ($credentials->google->status == 1)
                                            <li class="single-button">
                                                <a href="{{ route('user.social.login', 'google') }}"
                                                    >
                                                    <i class="fab fa-google"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($credentials->facebook->status == 1)
                                            <li class="single-button">
                                                <a href="{{ route('user.social.login', 'facebook') }}"
                                                    >
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($credentials->linkedin->status == 1)
                                            <li class="single-button">
                                                <a href="{{ route('user.social.login', 'Linkedin') }}"
                                                    class="left-sidebar-menu__link btn btn--base pill">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        {{-- social box --}} -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- / sign-in section -->


@endsection
@push('style')
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
        
    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/common/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

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

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {

                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
