<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.ticket.pending') ? 'active' : '' }}"
                    href="{{route('admin.deposit.pending')}}">@lang('En attente')
                    @if($pendingTicketCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$pendingTicketCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.ticket.closed') ? 'active' : '' }}"
                    href="{{route('admin.ticket.closed')}}">@lang('Fermé')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.ticket.answered') ? 'active' : '' }}"
                    href="{{route('admin.ticket.answered')}}">@lang('Répondu')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.ticket') ? 'active' : '' }}"
                    href="{{route('admin.ticket')}}">@lang('Tout')
                </a>
            </li>
        </ul>
    </div>
</div>
