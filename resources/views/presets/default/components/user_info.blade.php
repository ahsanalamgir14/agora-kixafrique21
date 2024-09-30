<div class="user-profile-box" style="margin-top: 80px;">
    <div class="user-profile-meta">
        <div class="user-thumb mb-1">
            <img src="{{ getImage(getFilePath('userProfile') . '/' . @$user?->image, getFileSize('userProfile')) }}"
                alt="user-avatar">
        </div>
        <div class="user-content">
            <h6 class="user-name">{{ __(@$user?->fullname) }}</h6>
            <p class="user-join-date">{{ __(showDateTime($user?->created_at, 'd M, Y')) }}</p>
        </div>
    </div>

    <div class="community-item-wraper">
        <div class="community-item">
            <div class="item-status">
                <h5 class="count">{{ @$user?->credit }}</h5>
                <h6 class="item-status-title">@lang('Crédit total')</h6>
            </div>
            <div class="item-status">
                <h5 class="count">{{ @$user?->posts->count() }}</h5>
                <h6 class="item-status-title">@lang('Poste total')</h6>
            </div>
        </div>
        <div class="community-item">
            <div class="item-status">
                <h5 class="count">{{ @$user->total_topic() }}</h5>
                <h6 class="item-status-title">@lang('Total des sujets')</h6>
            </div>
            <div class="item-status">
                <h5 class="count">{{ $user->all_post_comments_count() }}</h5>
                <h6 class="item-status-title">@lang('Nombre total de réponses')</h6>
            </div>
        </div>
    </div>

    <div class="user-social-meta">
        <h5>@lang('Social Network')</h5>
        <div class="d-flex">
            @if (@$user->social_link?->facebook)
                <div class="social-link-box">
                    <a href="{{ @$user->social_link?->facebook }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            @endif
            @if (@$user->social_link?->twitter)
                <div class="social-link-box mx-4">
                    <a href="{{ @$user->social_link?->twitter }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                </div>
            @endif

            @if (@$user->social_link?->instagram)
                <div class="social-link-box">
                    <a href="{{ @$user->social_link?->instagram }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                </div>
            @endif
        </div>
    </div>

    @if (auth()->user() && !(auth()->id() == @$user->id))
        <div class="button-wraper pt-4">
            <!-- open chat btn -->
            <button class="btn btn--base chatBox-open-btn">@lang('Démarrer la discussion')</button>
        </div>
    @endif
</div>

<div class="popular-topics-box">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">@lang('Experience')</h5>
                @if (auth()->user() && auth()->id() === $user->id)
                    <a href="{{ route('user.experience.index') }}" class="btn btn--sm"><i class="fa-solid fa-plus" style="color: #fff;"></i></a>
                @endif
            </div>

            @if ($user->experience->count())
                @foreach ($user->experience as $experience)
                    <div class="card w-100 mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-content-center mb-2">
                                <div>
                                    <h4 class="mb-2">{{ __(@$experience?->title) }}</h4>
                                    <p>{{ __(@$experience->company_name) }}</p>
                                </div>
                                @if (auth()->user() && auth()->id() === $user->id)
                                    <div class="text-end">
                                        <a href="{{ route('user.experience.edit', @$experience?->id) }}" class="info me-2"><i class="fa-solid fa-pen"></i></a>
                                        <a href="{{ route('user.experience.delete', @$experience?->id) }}" class="danger"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                @endif
                            </div>

                            <p>{{ __(showDateTime(@$experience?->start_date, 'M Y')) }}
                                @if (@$experience?->end_date)
                                    - {{ __(showDateTime(@$experience?->end_date, 'M Y')) }}
                                    . {{ myDiffForHumans(@$experience?->start_date, @$experience?->end_date) }}
                                @else
                                    @lang('- Present')
                                    . {{ myDiffForHumans(@$experience?->start_date, now()) }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>@lang('Aucune expérience à ajouter')</p>
            @endif
        </div>
    </div>
</div>

@php
    $skills = json_decode(@$user->skills);
@endphp
<div class="popular-topics-box">
    <div class="user-social-meta mb-2">
        <h5>@lang('Skills')</h5>
        @if ($skills)
            <div class="row">
                <div class="col-12">
                    @foreach ($skills as $skill)
                        <div class="skill-tag">
                            {{ $skill }}
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <span>@lang('Aucune expérience à ajouter')</span>
        @endif
    </div>
</div>
