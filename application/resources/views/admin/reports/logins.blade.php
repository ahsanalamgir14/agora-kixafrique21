@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Utilisateur')</th>
                                    <th>@lang('Connectez-vous à')</th>
                                    <th>@lang('IP')</th>
                                    <th>@lang('Navigateur et système d\'exploitation')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loginLogs as $log)
                                    <tr>

                                        <td>
                                            <a
                                                href="{{ route('admin.users.detail', $log->user_id) }}">{{ @$log->user->fullname }}</a>
                                        </td>


                                        <td>
                                            {{ showDateTime($log->created_at) }}
                                        </td>
                                        <td>
                                            <span class="fw-bold">
                                                <a
                                                    href="{{ route('admin.report.login.ipHistory', [$log->user_ip]) }}">{{ $log->user_ip }}</a>
                                            </span>
                                        </td>

                                        <td>
                                            {{ __($log->browser) }}, {{ __($log->os) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($loginLogs->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($loginLogs) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>


    </div>
@endsection



@push('breadcrumb-plugins')
    @if (request()->routeIs('admin.report.login.history'))
        <form action="{{ route('admin.report.login.history') }}" method="GET" class="form-inline float-sm-end">
            <div class="input-group">
                <input type="text" name="search" class="form-control bg--white" placeholder="@lang('Rechercher un nom d\'utilisateur')"
                    value="{{ request()->search }}">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    @endif
    @if (request()->routeIs('admin.report.login.ipHistory'))
        <a href="https://www.ip2location.com/{{ $ip }}" target="_blank"
            class="btn btn--primary">@lang('Rechercher une adresse IP') {{ $ip }}</a>
    @endif
@endpush
