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
                        <div class="row justify-content-center pt-80 gy-2 px-3">
                            <div class="col-xl-12">
                                <div class="row justify-content-center mt-2">
                                    <div class="text-end">
                                        <a href="{{route('ticket.open') }}" class="btn btn-sm btn--base mb-2"> <i class="fa fa-plus"></i> @lang('Nouveau billet')</a>
                                    </div>
                                    <div class="table-responsive table-wrap">
                                        <table class="table table--responsive--xl">
                                            <thead>
                                            <tr>
                                                <th>@lang('Sujet')</th>
                                                <th>@lang('Statut')</th>
                                                <th>@lang('Priorité')</th>
                                                <th>@lang('Dernière réponse')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($supports as $support)
                                                    <tr>
                                                        <td data-label="Subject"> <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                                                        <td data-label="Status">
                                                            @php echo $support->statusBadge; @endphp
                                                        </td>
                                                        <td data-label="Priority">
                                                            @if($support->priority == 1)
                                                                <span class="badge bg-dark">@lang('Faible')</span>
                                                            @elseif($support->priority == 2)
                                                                <span class="badge bg-success">@lang('Moyen')</span>
                                                            @elseif($support->priority == 3)
                                                                <span class="badge bg-primary">@lang('Haut')</span>
                                                            @endif
                                                        </td>
                                                        <td data-label="Dernière réponse">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                                        <td data-label="Action">
                                                            <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn--base btn--sm">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td data-label="Details" colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$supports->links()}}
                                </div>
                            </div>
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

