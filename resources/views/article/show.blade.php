<x-layout>

    <div class="product-page container my-5">
        <div class="row">

            {{-- Sidebar: Articoli correlati --}}
            <aside class="col-lg-3 sidebar-related mb-4 mb-lg-0 shadow">
                <h5 class="fw-bold mb-3 text-dark">{{ __('ui.relatedArticles') }}</h5>
                <div class="related-list">
                    @foreach ($relatedArticles as $related)
                        <a href="{{ route('article.show', $related->id) }}"
                            class="related-item d-flex align-items-center mb-3 p-2 rounded text-black">
                            <img src="{{ $related->main_image_url }}" alt="{{ $related->title }}">
                            <div class="ms-2">
                                <div class="fw-bold small">{{ Str::limit($related->title, 30) }}</div>
                                <div class="text-muted small">{{ number_format($related->price, 2) }} €</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </aside>

            {{-- Contenuto principale --}}
            <main class="col-lg-9 product-details">
                <div class="row">
                    <div class="col-md-6 text-center mb-4 mb-md-0">
                        {{-- Immagine / Swiper --}}
                        @if ($article->images->count() > 1)
                            <div class="swiper mySwiper rounded shadow"
                                style="width: 100%; max-width: 400px; height: 300px;">
                                <div class="swiper-wrapper">
                                    @foreach ($article->images as $image)
                                        <div
                                            class="swiper-slide d-flex justify-content-center align-items-center bg-light">
                                            <img src="{{ $image->image_url }}" class="img-fluid rounded"
                                                alt="{{ $article->title }}"
                                                style="max-height: 280px; object-fit: contain;" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-pagination"></div>
                            </div>
                        @else
                            <img src="{{ optional($article->images->first())->image_url ?? 'https://picsum.photos/400/300' }}"
                                class="img-fluid rounded" alt="{{ $article->title }}"
                                style="max-height: 280px; object-fit: contain;" loading="lazy">
                        @endif

                        {{-- FORM RECENSIONE --}}
                        <div class="review-form my-4 p-4 bg-light text-dark rounded shadow-sm">
                            <h4 class="text-dark">{{ __('ui.leaveReview') }}</h4>

                            {{-- Messaggi conferme o errori --}}
                            <div class="messages-container position-fixed top-0 start-50 translate-middle-x mt-3"
                                style="z-index: 1050; width: 90%; max-width: 500px;">
                                @if (session()->has('success'))
                                    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show shadow-lg rounded"
                                        role="alert">
                                        <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                                        <div>{{ session('success') }}</div>
                                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show shadow-lg rounded"
                                        role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                                        <div>{{ session('error') }}</div>
                                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-warning d-flex flex-column alert-dismissible fade show shadow-lg rounded"
                                        role="alert">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-exclamation-diamond-fill me-2 fs-4"></i>
                                            <strong>{{ __('ui.warning') ?? 'Attenzione:' }}</strong>
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

                            <form action="{{ route('article.reviews.store', $article) }}" method="POST">
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
                                                title="{{ $i }} {{ __('ui.stars') }}">&#9733;</label>
                                        @endfor
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">{{ __('ui.submitReview') }}</button>
                            </form>
                        </div>

                        {{-- Descrizione completa --}}
                        <div class="mt-5">
                            <h4 class="fw-bold">{{ __('ui.description') }}</h4>
                            <p>{{ $article->description }}</p>
                        </div>

                        {{-- RECENSIONI APPROVATE --}}
                        <h4 class="mt-5">{{ __('ui.userReviews') }}</h4>
                        <div class="row g-4 mt-2">
                            @foreach ($article->reviews()->where('approved', true)->latest()->get() as $review)
                                <div class="col-12 col-md-6">
                                    <div class="card p-3 shadow-sm">
                                        <strong>{{ $review->user->name }}</strong>
                                        <p class="fst-italic text-dark mt-2">{{ $review->text }}</p>

                                        <div class="review-stars mb-2 mt-auto">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star' }}"></i>
                                            @endfor
                                        </div>
                                        <hr>
                                        <small class="text-muted">{{ $review->rating }}/5</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Info prodotto --}}
                    <div class="col-md-6">
                        <h2 class="fw-bold">{{ $article->title }}</h2>
                        <p>{{ __('ui.vendor') }}: <a class="heading-title"
                                href="{{ route('uservendor.profile', $article->user->id) }}">{{ $article->user->name }}</a>
                        </p>
                        <h3 class="heading-title fw-bold">{{ number_format($article->price, 2) }} €</h3>

                        <ul class="list-unstyled mt-3">
                            <li><strong>{{ __('ui.weight') }}:</strong> {{ $article->weight_kg ?? 'N/D' }} kg</li>
                            <li><strong>{{ __('ui.length') }}:</strong> {{ $article->length_cm ?? 'N/D' }} cm</li>
                            <li><strong>{{ __('ui.width') }}:</strong> {{ $article->width_cm ?? 'N/D' }} cm</li>
                            <li><strong>{{ __('ui.height') }}:</strong> {{ $article->height_cm ?? 'N/D' }} cm</li>
                        </ul>

                        <form action="{{ route('cart.add', $article) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-success mt-4 px-4 rounded-pill">{{ __('ui.addToCart') }}</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.mySwiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

</x-layout>
