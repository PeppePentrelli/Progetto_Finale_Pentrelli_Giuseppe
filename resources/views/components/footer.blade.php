    <footer class="text-center text-lg-start text-light text-muted" data-aos="fade-up">
        <!-- Sezione: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom text-light">
            <div class="me-5 d-none d-lg-block">
                <span>{{ __('ui.followMeSocial') }}</span>
            </div>
            <div>
                <a href="#" class="me-4 text-reset"><i class="bi bi-facebook"></i></a>
                <a href="#" class="me-4 text-reset"><i class="bi bi-twitter"></i></a>
                <a href="#" class="me-4 text-reset"><i class="bi bi-google"></i></a>
                <a href="#" class="me-4 text-reset"><i class="bi bi-instagram"></i></a>
                <a href="#" class="me-4 text-reset"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="me-4 text-reset"><i class="bi bi-github"></i></a>
            </div>
        </section>

        <!-- Sezione: Links -->
        <section>
            <div class="container text-center text-md-start mt-5 text-white">
                <div class="row mt-3">
                    <!-- Colonna: Brand -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4 heading-title">
                            <i class="fas fa-gem me-3"></i>Presto.it
                        </h6>
                        <p>{{ __('ui.modernResponsive') }}</p>

                        <div class="mt-5 bord">
                            <h5 class="heading-title">{{ __('ui.becomeRevisor') }}</h5>
                            <p>{{ __('ui.clickToRequest') }}</p>
                            <a class="btn" style="background-color: var(--navbar-bg); color: var(--nav-link)"
                                href="{{ route('become.revisor') }}">{{ __('ui.becomeRevisor') }}</a>
                        </div>

                        <div class="mt-5 bord heading-title">
                            <h5 class="heading-title">{{ __('ui.becomeVendor') }}</h5>
                            <p>{{ __('ui.clickToRequest') }}</p>
                            <a class="btn text-white" style="background-color: var(--navbar-bg); 
                                href="{{ route('become.vendor') }}">{{ __('ui.becomeVendor') }}</a>
                        </div>
                    </div>

                    <!-- Colonna: Tool -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4 heading-title">{{ __('ui.products') }}</h6>
                        <p><a href="https://getbootstrap.com/" class="text-reset text-decoration-none">Bootstrap</a></p>
                        <p><a href="https://laravel.com/" class="text-reset text-decoration-none">Laravel</a></p>
                        <p><a href="https://laravel-livewire.com/" class="text-reset text-decoration-none">Livewire</a></p>
                        <p><a href="https://michalsnik.github.io/aos/" class="text-reset text-decoration-none">Aos</a></p>
                        <p><a href="https://uiverse.io/" class="text-reset text-decoration-none">Uiverse</a></p>
                    </div>

                    <!-- Colonna: Link utili -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4 heading-title">{{ __('ui.usefulLinks') }}</h6>
                        <p><a href="{{ route('homepage') }}"
                                class="text-reset text-decoration-none">{{ __('ui.home') }}</a></p>
                        <p><a href="{{ route('article.index') }}"
                                class="text-reset text-decoration-none">{{ __('ui.allArticle') }}</a></p>
                        <p><a href="{{ route('article.create') }}"
                                class="text-reset text-decoration-none">{{ __('ui.publishArticle') }}</a></p>
                        <p><a href="{{ route('uservendor.index') }}"
                                class="text-reset text-decoration-none">{{ __('ui.vendors') }}</a></p>
                        <p><a href="{{ route('aboutUs') }}"
                                class="text-reset text-decoration-none">{{ __('ui.chiSiamo') }}</a></p>
                        @guest
                            <p><a href="{{ route('register') }}"
                                    class="text-reset text-decoration-none">{{ __('ui.register') }}</a></p>
                            <p><a href="{{ route('login') }}"
                                    class="text-reset text-decoration-none">{{ __('ui.login') }}</a></p>
                        @endguest
                        @auth
                            @if (Auth::user()->is_revisor)
                                <p><a href="{{ route('revisor.show') }}"
                                        class="text-reset text-decoration-none">{{ __('ui.enter_as_revisor') }}</a></p>
                                <p><a href="{{ route('revisor.reviews') }}"
                                        class="text-reset text-decoration-none">{{ __('ui.approveReviews') }}</a></p>
                                <p><a href="{{ route('revisor.newsletters') }}"
                                        class="text-reset text-decoration-none">{{ __('ui.newsletter') }}</a></p>
                            @endif
                            <p>
                                <a href="{{ route('logout') }}" class="text-reset text-decoration-none"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('ui.logout') }}
                                </a>
                            </p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </div>

                    <!-- Colonna: Contatti -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4 heading-title">{{ __('ui.contacts') }}</h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p><i class="fas fa-envelope me-3"></i> info@example.com</p>
                        <p><i class="fas fa-phone me-3"></i> +01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> +01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Copyright -->
        <div class="text-center p-4 heading-title">
            © 2025 Copyright: Presto.it | POWERADE BY
            <a class="text-decoration-none fw-bold heading-title" href="https://mdbootstrap.com/">
                Pentrelli Giuseppe <i class="bi bi-lightning-fill thunderbolt"></i>
            </a>
        </div>
    </footer>