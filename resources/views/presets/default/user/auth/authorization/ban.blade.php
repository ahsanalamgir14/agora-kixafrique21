@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include('presets.default.components.header')
    <section class="login-section py-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-end">
                        <a href="{{ route('home') }}" class="fw-bold home-link"> <i class="las la-long-arrow-alt-left"></i>
                            @lang('Aller à accueil')</a>
                    </div>
                    <div class="card custom--card">
                        <div class="card-body">
                            <h3 class="text-center text-danger">@lang('Vous êtes banni')</h3>
                            <p class="fw-bold mb-1">@lang('Raison'):</p>
                            <p>{{ $user->ban_reason }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
