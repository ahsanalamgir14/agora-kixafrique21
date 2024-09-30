<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.withdraw.pending') ? 'active' : '' }}"
                    href="{{route('admin.withdraw.pending')}}">@lang('En attente')
                    @if($pendingWithdrawCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$pendingWithdrawCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.withdraw.approved') ? 'active' : '' }}"
                    href="{{route('admin.withdraw.approved')}}">@lang('Approuvé')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.withdraw.rejected') ? 'active' : '' }}"
                    href="{{route('admin.withdraw.rejected')}}">@lang('Rejeté')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.withdraw.log') ? 'active' : '' }}"
                    href="{{route('admin.withdraw.log')}}">@lang('Tout')
                </a>
            </li>

        </ul>
    </div>
</div>
