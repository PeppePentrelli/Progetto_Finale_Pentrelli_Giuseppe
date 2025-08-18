<x-layout>


    {{-- Header --}}
    <header class="container-fluid HeaderCustom mt-5" data-aos="fade-right">
        <div class="row justify-content-center align-items-center vh-100 ">
            <div class="col-12 mb-5">
                <div class="text-center">
                    <h1 class=" mb-3 heading-title">
                        <i class="bi bi-lightning-charge-fill me-2"></i>Presto.it
                    </h1>

                    <p class="">
                        {{ __('ui.trusted_marketplace') }}
                    </p>
                </div>
            </div>
        </div>
    </header>
    {{-- Fine Header --}}

    {{-- Separatore --}}
    <hr class="my-5" />

    {{-- Messaggi conferme o errori  --}}

    <div class="messages-container position-fixed top-0 start-50 translate-middle-x mt-3"
        style="z-index: 1050; width: 90%; max-width: 500px;">
        @if (session()->has('success'))
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show shadow-lg rounded"
                role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show shadow-lg rounded"
                role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning d-flex flex-column alert-dismissible fade show shadow-lg rounded"
                role="alert">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-diamond-fill me-2 fs-4"></i>
                    <strong>Attenzione:</strong>
                </div>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close mt-2 ms-auto" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>



    {{-- Header di Benvenuto --}}
    <section class="welcome-typing container text-center my-5" data-aos="fade-up">
        <h1 class="typing-title mb-3 ">{{ __('ui.benvenutoSuPresto') }}</h1>
        <p class="lead fst-italic fs-5">
            {{ __('ui.marketplaceIntro') }}
        </p>
        <p class="scroll-hint mt-4 fst-italic" data-aos="fade-up" data-aos-delay="500">
            ⬇ {{ __('ui.scrollHint') }}
        </p>
    </section>

    {{-- Separatore --}}
    <hr class="my-5" />

    {{-- categoria --}}
    <div class="container" data-aos="fade-left">
        <div class="row">
            <div class="text-center my-5">
                <h2 class="fw-bold heading-title">{{ __('ui.discoverCategories') }}</h2>
                <p class="fst-italic">
                    "{{ __('ui.categorySubtitle') }}"
                </p>
            </div>
            <div class="carousel-categories">
                @foreach ($categories as $index => $category)
                    <article class="carousel-item-category" style="--i: {{ $index }};">
                        <a href="{{ route('byCategory', $category) }}"
                            class="text-center text-decoration-none text-white d-flex flex-column align-items-center">
                            <img src="{{ asset('media/categories/' . $category->img_category) }}"
                                alt="{{ $category->name }}" class="category-img rounded-circle mb-2" />
                            <div>{{ __("ui.{$category->name}") }}</div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Separatore --}}
    <hr class="my-5" />

    {{-- CAROSELLO PER articolo --}}
    <div class="container" data-aos="fade-left">
        <div class="row">
            <div class="text-center my-5">
                <h2 class="fw-bold heading-title">{{ __('ui.featuredArticles') }}</h2>
                <p class="fst-italic fs-5">
                    "{{ __('ui.latestNews') }}"
                </p>
            </div>
            <div class="carousel">
                @forelse ($articles as $article)
                    <article class="col-12 col-md-4 mb-4 d-flex flex-column" style="min-height: 400px;">
                        {{-- Immagine articolo --}}
                        <img src="{{ $article->main_image_url }}" alt="{{ $article->title }}" class="img-fluid mb-2"
                            style="object-fit: contain">

                        {{-- Titolo --}}
                        <h2 class="h5">{{ $article->title }}</h2>

                        {{-- Prezzo --}}
                        <p class="text-muted mb-1">{{ $article->price }} €</p>

                        {{-- Descrizione categoria --}}
                        <p class="flex-grow-1 text-truncate">
                            {{ $article->description }}
                        </p>

                        {{-- Footer con data e autore --}}
                        <div class="card-footer bg-light text-center py-2 rounded-bottom mt-auto">
                            <small class="text-primary d-block">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $article->created_at->format('d/m/Y') }}
                            </small>
                            <small class="text-primary d-block mt-1 text-truncate" style="max-width: 100%;">
                                <i class="bi bi-person me-1"></i>
                                {{ $article->user->name ?? __('ui.userUnavailable') }}
                            </small>
                        </div>
                    </article>
                @empty
                    <div class="col-12">
                        <h3 class="text-center">{{ __('ui.noArticles') }}</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>



    {{-- Sezione Recensione --}}
    <section class="py-5" data-aos="fade-up" style="color: var(--text-color);">
        <div class="container d-flex justify-content-center flex-column mx-auto text-center">
            <h2 class="fw-bold mb-5" style="color: var(--heading-Title);">
                {{ __('ui.customerReviewsTitle') }}
            </h2>

            <div class="row g-4 justify-content-center align-items-stretch text-center">
                @forelse ($reviews as $review)
                    <div class="col-12 col-md-4 d-flex h-100">
                        <div class="card shadow-lg border-0 fixed-card h-100 w-100">
                            <div class="card-header"
                                style="background-color: var(--navbar-bg); color: var(--nav-link--); font-weight: bold;">
                                {{ $review->user->name }}
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="fst-italic text-dark">"{{ $review->text }}"</p>

                                <div class="mt-auto">
                                    <hr>
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-muted small">{{ $review->rating }}/5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="fst-italic">{{ __('ui.noReviewsYet') }}</p>
                @endforelse
            </div>

            @auth
                {{-- Form recensione --}}
                <div class="review-form my-5 p-4 rounded shadow-sm">
                    <h4>{{ __('ui.leaveReview') }}</h4>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">{{ __('ui.yourComment') }}</label>
                            <textarea class="form-control" id="text" name="text" rows="3" required>{{ old('text') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('ui.ratingLabel') }}</label>
                            <div class="rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating"
                                        value="{{ $i }}" required>
                                    <label for="star{{ $i }}"
                                        title="{{ $i }} stelle">&#9733;</label>
                                @endfor
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">{{ __('ui.submitReview') }}</button>
                    </form>
                </div>
            @endauth
        </div>
    </section>

    <hr>

    {{-- Sezione Lavora con noi --}}
    <section class="join-us-section py-5 mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="text-center mb-4" data-aos="fade-up">
                    <h2 class="fw-bold heading-title">{{ __('ui.joinTeamTitle') }}</h2>
                    <p class="fst-italic">
                        {{ __('ui.joinTeamSubtitle') }}
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    <!-- Card Diventa Revisore -->
                    <div class="col-12 col-md-5 d-flex justify-content-center" data-aos="fade-right">
                        <div class="card h-100 shadow-sm border-0 hover-card text-center p-4">
                            <div class="mb-3">
                                <i class="bi bi-check2-circle display-4 text-primary"></i>
                            </div>
                            <h5 class="fw-bold text-dark">{{ __('ui.becomeRevisorCardTitle') }}</h5>
                            <p class="text-secondary">
                                {{ __('ui.becomeRevisorCardText') }}
                            </p>
                            <a href="{{ route('become.revisor') }}" class="btn px-4 fw-bold"
                                style="background-color: var(--navbar-bg); color: var(--nav-link--); font-weight: bold;">
                                {{ __('ui.startNow') }}
                            </a>
                        </div>
                    </div>

                    <!-- Card Diventa Venditore -->
                    <div class="col-12 col-md-5 d-flex justify-content-center" data-aos="fade-left">
                        <div class="card h-100 shadow-sm border-0 hover-card text-center p-4">
                            <div class="mb-3">
                                <i class="bi bi-shop display-4 text-success"></i>
                            </div>
                            <h5 class="fw-bold text-dark">{{ __('ui.becomeVendorCardTitle') }}</h5>
                            <p class="text-secondary">
                                {{ __('ui.becomeVendorCardText') }}
                            </p>
                            <a href="{{ route('become.vendor') }}" class="btn px-4 fw-bold"
                                style="background-color: var(--navbar-bg); color: var(--nav-link--); font-weight: bold;">
                                {{ __('ui.startNow') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>

    {{-- Sezione Newsletter --}}
    <section class="newsletter-section py-5 mt-5">
        <div class="container text-center" data-aos="fade-up">
            <div class="mb-4">
                <i class="bi bi-envelope-paper-heart display-4 shadow-sm p-3 rounded-circle"></i>
            </div>

            <h2 class="fw-bold mb-3">{{ __('ui.newsletterTitle') }}</h2>
            <p class="lead mb-4 fst-italic">{{ __('ui.newsletterSubtitle') }}</p>

            <form action="{{ route('newsletter.subscribe') }}" method="POST"
                class="row g-2 justify-content-center align-items-center">
                @csrf
                <div class="col-12 col-sm-6 col-md-3">
                    <input type="text" name="nome" placeholder="{{ __('ui.newsletterName') }}"
                        class="form-control shadow-sm rounded-pill py-2" style="color: black;">
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <input type="text" name="cognome" placeholder="{{ __('ui.newsletterSurname') }}"
                        class="form-control shadow-sm rounded-pill py-2">
                </div>
                <div class="col-12 col-sm-8 col-md-4">
                    <input type="email" name="email" placeholder="{{ __('ui.newsletterEmail') }}" required
                        class="form-control shadow-sm rounded-pill py-2 text-black">
                </div>
                <div class="col-12 col-sm-4 col-md-2">
                    <button type="submit"
                        class="btn w-100 rounded-pill py-2 fw-bold newsletterBtn">{{ __('ui.newsletterSubscribe') }}</button>
                </div>
            </form>

            <small class="d-block mt-3 heading-title fst-italic">
                {{ __('ui.newsletterNote') }}
            </small>
        </div>
    </section>

</x-layout>
