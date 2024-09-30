<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <section class="ftco-section">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <button class="navbar-toggler menu-button" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <button class="navbar-toggler close-button" type="button" aria-label="Close navigation">
          <span class="fa fa-times"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="ftco-nav">
          <ul class="navbar-nav">
            <li class="nav-item"><a href="https://kixafrique21.org" class="nav-link">ACCUEIL</a></li>
            <li class="nav-item active"><a href="https://agora.kixafrique21.org" class="nav-link">KIX AGORA</a></li>
            <li class="nav-item"><a href="https://carto.kixafrique21.org" class="nav-link">KIX CARTO</a></li>
            <li class="nav-item"><a href="https://renfo.kixafrique21.org" class="nav-link">KIX RENFO</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.menu-button').click(function () {
        $('#ftco-nav').collapse('toggle');
        $(this).hide();
        $('.close-button').show();
      });

      $('.close-button').click(function () {
        $('#ftco-nav').collapse('hide');
        $(this).hide();
        $('.menu-button').show();
      });

      $('#ftco-nav .nav-link').click(function () {
        $('#ftco-nav').collapse('hide');
        $('.close-button').hide();
        $('.menu-button').show();
      });

      // Initial state
      $('.close-button').hide();
    });
  </script>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>


<div class="header-main-area">
    <div class="header" id="header" style="background-color: #fafafa;">
        <div class="container-fluid position-relative" style="background-color: #fafafa;">
            <div class="row">

                <div class="header-wrapper" style="background-color: #fafafa;">
                    <!-- ham menu -->
                    <i class="fa-sharp fa-solid fa-bars-staggered ham__menu" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></i>

                    <!-- logo -->
                    <div class="header-menu-wrapper align-items-center d-flex">
                        <div class="logo-wrapper">
                            <a href="{{ route('home') }}" class="normal-logo" id="normal-logo"> <img
                                    src="{{ getImage('assets/images/general/logo.png') }}" alt=""></a>
                            <a href="{{ route('home') }}" class="dark-logo hidden" id="dark-logo"> <img
                                    src="{{ getImage('assets/images/general/logo_white.png') }}" alt=""></a>
                        </div>
                    </div>
                    <!-- / logo -->

                    <!-- Menu d'en-tête -->
                    <div class="menu-wrapper">
                        <ul class="main-menu">
                            <li>
                                <div class="header-search-bar">
                                    <form id="header-search">
                                        <div class="header-search-input">
                                            <input type="text" placeholder="Ecrivez le sujet que vous cherchez ici..."
                                                class="header-form--control" onkeyup="search(this);">
                                        </div>
                                        <button class="header-search-btn">
                                            <span class="icon">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                                <!-- Barre de resultats si on tape pour rechercher -->
                                <div class="search-result-box d-none"  style="background-color: #fff; color: #616364; border: 3px solid #1876f2; border-radius: 14px; width: 49%;"><!-- #dbe9fb -->

                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Menu d'en-tête /> -->
                    <!-- user actn -->
                    <div class="menu-right-wrapper">
                        @auth
                            <div class="avatar-thumb">
                                <a href="{{ route('user.home') }}"><img
                                        src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()?->image, getFileSize('userProfile')) }}"
                                        alt="avatar"></a>
                            </div>
                        @endauth

                        <ul>
                            <li class="search-icon">
                                <a href="#" class="login-registration-list__link">
                                    <span class="icon search-icon">
                                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                    </span>
                                </a>
                            </li>
                            <!-- < dark option -->
                            <li class="dark-mood-option">
                                <div class="light-dark-btn-wrap ms-1" id="light-dark-checkbox1">
                                    <i class="las la-moon mon-icon"></i>
                                    <i class="las la-sun sun-icon "></i>
                                </div>
                            </li>
                            <!-- dark option /> -->
                            @guest
                                  <li class="login-registration-list login-icon">
                                <a href="{{ route('user.login') }}" class="login-registration-list__link">
                                    <span class="icon">
                                        <i class="las la-user-plus mt-1"></i>
                                    </span>
                                </a>
                            </li>
                            @endguest

                            {{-- <li class="language-box">
                                <i class="fa-solid fa-globe"></i>
                                <div>
                                    <select class="select langSel">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->code }}"
                                                @if (Session::get('lang') === $language->code) selected @endif>
                                                {{ __(ucfirst($language->code)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                    <!-- user actn /> -->
                </div>

            </div>
        </div>
    </div>
</div>
<!--========================== Fin de la section d'en-tête ==========================-->
@push('script')
    <script>
        "use strict"

        function search(object) {
            var searchValue = $(object).val();
            var appendClass = $('.search-result-box');
            if (searchValue != '') {
                $.ajax({
                    type: "POST",
                    url: "{{ route('post.search') }}",
                    data: {
                        search: searchValue,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                        if (data.data != '') {
                            var html = '';
                            $.each(data.data, function(key, item) {
                                html +=
                                    `<a href="{{ url('post-details/${item.id}') }}" class="search-result-list"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="title">${item.title}</h6>
                                        </div>
                                        <p class="subtitle">${item.content.substring(0, 105)} .....</p>
                                    </a>`;
                            })
                            appendClass.removeClass('d-none').html(html);
                        } else {
                            var html =
                                `
                                    <div class="no-data">
                                        <p>Aucune donnée disponible </p>
                                    </div>
                                `;
                            appendClass.removeClass('d-none').html(html);
                        }


                    },
                    error: function(data, status, error) {
                        $.each(data.responseJSON.errors, function(key,
                            item) {
                            Toast.fire({
                                icon: 'error',
                                title: item
                            })
                        });
                    }
                });
            } else {
                appendClass.addClass('d-none');
            }
            return false;
        }
    </script>
    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });
        });
    </script>
@endpush
