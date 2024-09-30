<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.active') ? 'active' : '' }}"
                    href="{{route('admin.users.active')}}">@lang('Active')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.banned') ? 'active' : '' }}"
                    href="{{route('admin.users.banned')}}">@lang('Banni')
                    @if($bannedUsersCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$bannedUsersCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.email.unverified') ? 'active' : '' }}"
                    href="{{route('admin.users.email.unverified')}}">@lang('E-mail non vérifié')
                    @if($emailUnverifiedUsersCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$emailUnverifiedUsersCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.mobile.unverified') ? 'active' : '' }}"
                    href="{{route('admin.users.mobile.unverified')}}">@lang('Mobile non vérifié')
                    @if($mobileUnverifiedUsersCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$mobileUnverifiedUsersCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.all') ? 'active' : '' }}"
                    href="{{route('admin.users.all')}}">@lang('Tous les utilisateurs')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.notification.all') ? 'active' : '' }}"
                    href="{{route('admin.users.notification.all')}}">@lang('Notification aux utilisateurs')
                </a>
            </li>
        </ul>
    </div>
</div>
