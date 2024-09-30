@extends($activeTemplate . 'layouts.frontend')

@section('content')
    @php
        $credentials = $general->socialite_credentials;
    @endphp
    @include('presets.default.components.header')

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="{{ asset ('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset ('assets/js/popper.js') }}"></script>
    <script src="{{ asset ('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('assets/js/main.js') }}"></script>


    <section class="login-section" style='background-image: url("../assets/images/hero.png"); background-repeat: no-repeat;background-size: cover; resize: both;'>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6" style="background-color: #ffffff;">
                    <div class="log-in-box">
                        <div class="login wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            <h2 class="welcome-text">@lang('Bienvenue sur Kix Agora !')</h2>
                            <form method="POST" action="{{ route('user.login') }}">
                                @csrf
                                <div class="form-group pwow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                                    <input type="text" placeholder=" " class="form--control mb-3"
                                        value="{{ old('username') }}" name="username">
                                    <label class="form--label">@lang('Nom d\'utilisateur ou email')</label>
                                </div>
                                <div class="form-group wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                                    <input type="password" placeholder=" "
                                        class="form--control mb-3 wow animate__animated animate__fadeInUp"
                                        data-wow-delay="0.4s" name="password">
                                    <label class="form--label">@lang('Mot de passe')</label>
                                </div>
                                <div class="login-meta mb-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                                    <div class="form--check">
                                        <input class="form-check-input" type="checkbox" value="" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">@lang('Souviens-toi de moi')</label>
                                    </div>
                                    <a href="{{ route('user.password.request') }}" class="text--base">@lang('Mot de passe oublié?')</a>
                                </div>
                                <button class="btn btn--base wow animate__animated animate__fadeInUp"
                                    data-wow-delay="0.5s">@lang('Enregistrer')</button>
                            </form>
                            <p class="pt-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.6s">@lang("Vous n'avez pas de compte ?")
                                <a href="{{ route('user.register') }}" class="text--base">@lang('Créer un compte')</a>
                            </p>
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
@endsection
