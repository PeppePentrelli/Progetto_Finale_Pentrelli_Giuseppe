<nav class="navbar navbar-expand-lg shadow-lg fixed-top">
    <div class="container-fluid">
        <div class="logo-Navcontainer my-auto">
            <a class="navbar-brand" href="{{ route('homepage') }}">
                <!-- Logo -->
                <img id="logo-nav" class="logo-nav img-fluid" src="/media/loghi-nav/logo_presto_nero.png"
                    alt="immagine del logo del marketplace presto.it" />
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if (Route::currentRouteName() == 'homepage') activeCustom @endif"
                        href="{{ route('homepage') }}">{{ __('ui.home') }}</a>
                </li>

                <!-- CUSTOM DROPDOWN MENU 1 -->
                <li class="nav-item dropdown custom-dropdown">
                    <button class="btn nav-link dropdown-toggle" type="button">
                        {{ __('ui.shop') }}
                    </button>
                    <ul class="dropdown-menu shadow p-3 custom-search-dropdown">
                        <li><a class="dropdown-item" href="{{ route('article.index') }}">{{ __('ui.allArticle') }}</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('article.create') }}">{{ __('ui.publishArticle') }}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('welcome/404') }}">404</a></li>
                    </ul>
                </li>

                <!-- CUSTOM DROPDOWN MENU 2 -->
                <li class="nav-item dropdown custom-dropdown">
                    <button class="btn nav-link dropdown-toggle" type="button">
                        {{ __('ui.vendor') }}
                    </button>
                    <ul class="dropdown-menu shadow p-3 custom-search-dropdown">
                        <li><a class="dropdown-item"
                                href="{{ route('uservendor.index') }}">{{ __('ui.tutti_i_venditori') }}</a></li>
                        <li><a class="dropdown-item" href="{{ url('welcome/404') }}">404</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('welcome/404') }}">404</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if (Route::currentRouteName() == 'aboutUs') activeCustom @endif"
                        href="{{ route('aboutUs') }}">{{ __('ui.chiSiamo') }}</a>
                </li>
            </ul>

            <!-- Dropdown lente fuori da <ul> -->
            <div class="dropdown custom-dropdown position-relative me-auto">
                <button class="btn btnSearch" type="button">
                    <i class="bi bi-search fs-4"></i>
                </button>
                <ul class="dropdown-menu shadow p-3 custom-search-dropdown">
                    <li>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <form class="d-flex" role="search" method="GET" action="{{ route('article.search') }}">
                                <input style="color: black" class="form-control me-2" type="search"
                                    placeholder="{{ __('ui.search') }}" aria-label="{{ __('ui.search') }}"
                                    name="query" />
                                <button class="btn btn-light me-2" type="submit">{{ __('ui.search') }}</button>
                            </form>
                        </div>
                    </li>
                    <hr>
                    @forelse ($articles as $article)
                        <li class="list-group-item d-flex align-items-center">
                            @php
                                $firstImage = $article->images->first();
                            @endphp

                            <a class="text-dark text-decoration-none flex-grow-1 text-truncate"
                                href="{{ route('article.show', $article) }}">
                                {{ $article->title }}
                            </a>
                            <small class="text-muted d-block">Pubblicato il
                                {{ $article->created_at->format('d/m/Y') }}</small>
                        </li>
                        <hr>
                    @empty
                        <li class="list-group-item text-center text-muted">
                            {{ _('ui.noArticles') }}
                        </li>
                    @endforelse
                </ul>
            </div>

            {{-- MODALE REGISTER Utente non autenticato --}}
            @if (Route::currentRouteName() !== 'register' && Route::currentRouteName() !== 'login')
                @guest
                    <!-- Bottone per aprire la modale -->
                    <button class="btn btnNav" data-bs-toggle="modal" data-bs-target="#authModal">
                        {{ __('ui.loginOrRegister') }}
                    </button>

                    <!-- Modale -->
                    <div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title form-title">{{ __('ui.loginOrRegister') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="nav nav-tabs justify-content-end">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#loginTab"
                                                type="button">{{ __('ui.login') }}</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#registerTab"
                                                type="button">{{ __('ui.register') }}</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content p-3 form-container">
                                        <div class="tab-pane fade show active" id="loginTab">
                                            <div class="row justify-content-center mb-4">
                                                <img class="img-fluid logo-main" style="max-height: 100px; width: auto;"
                                                    data-src="/media/loghi-nav/logo_presto_bianco.png" alt="Logo Presto"
                                                    loading="lazy" />
                                            </div>
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <input type="email" name="email" class="form-control mb-2"
                                                    placeholder="{{ __('ui.email') }}" required />
                                                <input type="password" name="password" class="form-control mb-2"
                                                    placeholder="{{ __('ui.password') }}" required />
                                                <button class="btn btnForm w-100 mb-2">{{ __('ui.login') }}</button>
                                            </form>
                                            <small class="form-p">
                                                <a class="form-a"
                                                    href="{{ route('login') }}">{{ __('ui.goToLoginPage') }}</a>
                                            </small>
                                        </div>

                                        <div class="tab-pane fade" id="registerTab">
                                            <div class="row justify-content-center mb-4">
                                                <img class="img-fluid logo-main" style="max-height: 100px; width: auto;"
                                                    data-src="/media/loghi-nav/logo_presto_bianco.png" alt="Logo Presto"
                                                    loading="lazy" />
                                            </div>
                                            <form method="POST" action="{{ route('register') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" name="name" class="form-control mb-2"
                                                    placeholder="{{ __('ui.firstName') }}" required />
                                                <input type="email" name="email" class="form-control mb-2"
                                                    placeholder="{{ __('ui.email') }}" required />

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-person-circle"></i></span>
                                                    <input name="profile_image" type="file" class="form-control"
                                                        placeholder="Immagine Profilo" />
                                                </div>
                                                @error('profile_image')
                                                    <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                                                @enderror

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="bi bi-card-image"></i></span>
                                                    <input name="cover_image" type="file" class="form-control" />
                                                </div>
                                                @error('cover_image')
                                                    <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                                                @enderror

                                                <input type="password" name="password" class="form-control mb-2"
                                                    placeholder="{{ __('ui.password') }}" required />
                                                <input type="password" name="password_confirmation"
                                                    class="form-control mb-2"
                                                    placeholder="{{ __('ui.confirmPassword') }}" required />
                                                <button class="btn btnForm w-100 mb-2">{{ __('ui.register') }}</button>
                                            </form>
                                            <small class="form-p">
                                                <a class="form-a"
                                                    href="{{ route('register') }}">{{ __('ui.goToRegisterPage') }}</a>
                                            </small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            @endif

            {{-- Utente Autenticato --}}
            @auth


                <div class="me-3">
                    <p style="color: var(--nav-link--); margin: 0;"> {{ __('ui.welcome') }} {{ Auth::user()->name }}</p>
                </div>
                @if (Auth::user()->is_revisor)
                    <div style="height: 50px; width: auto" class="me-2 d-flex align-items-center">
                        <img style="height: 30px; width: auto" class="img-fluid" src="/media/loghi-nav/isRevisor.png"
                            alt="Icona revisore" />
                    </div>
                @elseif(Auth::user()->is_vendor)
                    <div style="height: 50px; width: auto" class="me-2 d-flex align-items-center">
                        <img style="height: 30px; width: auto" class="img-fluid" src="/media/loghi-nav/is_vendor.png"
                            alt="Icona revisore" />
                    </div>
                @endif
                <li
                    class="nav-item dropdown list-unstyled   {{ (Auth::user()->is_revisor && \App\Models\Article::toBeRevisedCount() > 0) ? 'avatar-border-alert' : '' }}">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#"
                        id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->profile_image_url ?? asset('images/defaults/default-avatar.png') }}"
                            class="rounded-circle avatar-border" height="50" width="50" alt="Avatar"
                            loading="lazy" />
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profilo.show', Auth::user()) }}">
                                {{ __('ui.my_profile') }}
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('cart.index') }}">
                                 {{ __('ui.cart') }}
                            </a>
                        </li>

                        @if (Auth::user()->is_revisor)
                            <li>
                                <a class="dropdown-item" href="{{ route('revisor.show') }}">
                                    {{ __('ui.enter_as_revisor') }}
                                    <span class="badge rounded-pill bg-danger ms-2">
                                        {{ \App\Models\Article::toBeRevisedCount() }}
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item {{ request()->routeIs('revisor.reviews') ? 'active' : '' }}"
                                    href="{{ route('revisor.reviews') }}">
                                    {{ __('ui.approve_reviews') }}
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('revisor.newsletters') }}">
                                    {{ __('ui.view_newsletter_subscribers') }}
                                </a>
                            </li>
                        @endif

                        <li>
                            <a class="dropdown-item" href="#">{{ __('ui.settings') }}</a>
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('ui.logout') }}</button>
                            </form>
                        </li>
                    </ul>

                </li>
            @endauth



        </div>
    </div>
</nav>
