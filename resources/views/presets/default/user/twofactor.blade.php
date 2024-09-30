@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section>
        <!-- header -->
        @include('presets.default.components.header')
        @include('presets.default.components.sidenav')

        <!-- body -->
        <div class="body-section">
            <div class="container-fluid">
                <div class="row m-0">
                    <!-- left side -->
                    @include('presets.default.components.user.sidebar')
                    <!-- left side / -->
                    {{-- main content --}}
                    <div class="col-xl-6 col-lg-6">
                        <div class="row gy-4 justify-content-center mt-4">
                            @if (!auth()->user()->ts)
                                <div class="col-lg-12">
                                    <div class="global-card faq-card">
                                        <h6 class="mb-3"> @lang('Utilisez le code QR ou la clé de configuration sur votre application Google Authenticator pour ajouter votre compte.')
                                        </h6>

                                        <div class="form-group mx-auto text-center">
                                            <img class="mx-auto" src="{{ $qrCodeUrl }}" alt="qr-img">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="key">@lang('Clé de configuration')</label>
                                            <div class="input-group">
                                                <input type="text" name="key" value="{{ $secret }}"
                                                    class="form-control form--control referralURL" readonly id="key">
                                                <button type="button" class="input-group-text copytext"
                                                    style="border-radius: 0px;" id="copyBoard">
                                                    <i class="fa fa-copy"></i> </button>
                                            </div>
                                        </div>

                                        <label class="form-label"><i class="fa fa-info-circle"></i>
                                            @lang('Aide')</label>
                                        <p>@lang('Google Authenticator est une application polyvalente pour téléphones portables. Il crée des codes coordonnés utilisés
                                        pendant le processus de confirmation en 2 étapes. Pour utiliser Google Authenticator, introduisez l\'application Google Authenticator sur votre téléphone portable.')<a class="text--base"
                                                href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                                                target="_blank">@lang('Télécharger')</a></p>
                                    </div>
                                </div>
                            @endif
                            @if (auth()->user()->ts)
                                <div class="col-xl-5 col-lg-5">
                                    <div class="global-card">
                                        <form action="{{ route('user.twofactor.disable') }}" method="POST">
                                            @csrf
                                            <div class="card--body">

                                                <input type="hidden" name="key" value="{{ $secret }}">
                                                <div class="form-group mb-3">
                                                    <label class="form-label required"
                                                        for="code">@lang('OTP de l\'authentificateur Google')</label>
                                                    <input type="text" class="form--control" name="code" required
                                                        id="code">
                                                </div>
                                                <button type="submit"
                                                    class="btn btn--base w-100">@lang('Soumettre')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                    {{-- main content / --}}

                    <!-- right side -->
                    <div class="col-lg-3">
                        <aside class="rightside-bar">
                            @include('presets.default.components.user_info')
                            @include('presets.default.components.popular')
                        </aside>
                    </div>
                    <!-- right side /-->


                </div>
            </div>
        </div>
    </section>
@endsection


@push('style')
    <style>
        .copied::after {
            background-color: #{{ $general->base_color }};
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('#copyBoard').on('click', function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush
