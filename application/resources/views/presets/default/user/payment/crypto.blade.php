@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-deposit text-center">
                    <div class="card-header card-header-bg">
                        <h3>@lang('Aperçu du paiement')</h3>
                    </div>
                    <div class="card-body card-body-deposit text-center">
                        <h4 class="my-2"> @lang('VEUILLEZ ENVOYER EXACTEMENT') <span class="text-success"> {{ $data->amount }}</span> {{__($data->currency)}}</h4>
                        <h5 class="mb-2">@lang('À') <span class="text-success"> {{ $data->sendto }}</span></h5>
                        <img src="{{$data->img}}" alt="@lang('Image')">
                        <h4 class="text-white bold my-4">@lang('NUMÉRISER POUR ENVOYER')</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
