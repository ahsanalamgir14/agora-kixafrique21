<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.posts.list') ? 'active' : '' }}"
                    href="{{ route('admin.posts.list') }}">@lang('Tous les messages')</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.posts.active') ? 'active' : '' }}"
                    href="{{ route('admin.posts.active') }}">@lang('Active')</a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.posts.pending') ? 'active' : '' }}"
                    href="{{ route('admin.posts.pending') }}">@lang('En attente')
                    @if ($pendingPostsCount)
                        <span class="badge rounded-pill bg--white text-muted">{{ $pendingPostsCount }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.posts.rejected') ? 'active' : '' }}"
                    href="{{ route('admin.posts.rejected') }}">@lang('Rejeté')
                    @if ($rejectedPostsCount)
                        <span class="badge rounded-pill bg--white text-muted">{{ $rejectedPostsCount }}</span>
                    @endif
                </a>
            </li>
        </ul>
    </div>
</div>
