    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="{{ asset ('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset ('assets/js/popper.js') }}"></script>
    <script src="{{ asset ('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('assets/js/main.js') }}"></script>
<div class="popular-topics-box">
    <h5>@lang('Sujets populaires')</h5>
    <div class="popular-card-wraper">
        @foreach ($popular_posts as $post)
            <div class="popular-topics-card">
                <div class="topics-card-meta">
                    <div class="card-auth-info">
                        <a href="{{route('user.profile.details',$post->user?->id)}}">
                            <img src="{{getImage(getFilePath('userProfile') . '/' . @$post->user?->image, getFileSize('userProfile')) }}" alt="avatar">
                            <p class="post-by">@lang('Posté par') <span>{{__(strLimit(@$post->user?->fullname,7))}}</span></p>
                        </a>
                        <i class="fa-solid fa-circle"></i>
                        <p class="time-status">{{__(showDateTime($post->created_at,'d M, Y'))}}</p>
                    </div>
                    <a href="{{route('post.details',$post->id)}}">
                        <h6 class="topics-card-title">{{ __(@$post->title) }} </h6>
                    </a>
                </div>
                <ul>
                    <li>
                        <a href="{{route('post.details',$post->id)}}"><i class="las la-comments"></i>
                            <p>{{number_format_short(@$post->comments?->count())}} @lang('Réponses')</p>
                        </a>
                    </li>
                    <li>
                        <i class="las la-eye"></i>
                        <p>{{number_format_short(@$post->views)}} @lang('vues')</p>
                    </li>
                </ul>
            </div>
            <hr class="popular-topics-hr">
        @endforeach

    </div>
</div>
