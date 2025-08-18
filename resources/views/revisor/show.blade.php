<x-layout>

    <div class="container-fluid py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold display-6">
                <i class="bi bi-speedometer2 me-2"></i>{{ __('ui.revisorDashboard') }}
            </h1>
            <p>{{ __('ui.reviewInstructions') }}</p>
        </div>

        @if ($article_to_check)
            <div class="row g-4 justify-content-evenly">
                <div class="col-12 col-md-5 d-flex justify-content-center mb-4 me-md-4">
                    {{-- Swiper Images --}}
                    @if ($article_to_check->images->count())
                        <div class="swiper mySwiper rounded shadow" style="width: 100%; max-width: 500px; height: 440px;">
                            <div class="swiper-wrapper">
                                @foreach ($article_to_check->images as $image)
                                    <div
                                        class="swiper-slide d-flex justify-content-center align-items-center bg-light text-black borderSwitcherRevisor shadow-lg p-5">
                                        <img src="{{ $image->image_url }}" alt="{{ __('ui.articleImage') }}"
                                            class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                                        <div
                                            class="col-4 d-flex flex-column ms-3 justify-content-center align-items-center fa-1">
                                            @if ($image->labels)
                                                <div class="text-dark">
                                                    @foreach ($image->labels as $label)
                                                        #{{ $label }}
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-dark">{{ __('ui.noLabels') }}</p>
                                            @endif

                                            <h5 class="mb-3 mt-4 text-dark">{{ __('ui.ratings') }}:</h5>

                                            <div class="d-flex flex-column w-100">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="{{ $image->adult }}"></i>
                                                    <span class="ms-2">{{ __('ui.adult') }}</span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="{{ $image->violence }}"></i>
                                                    <span class="ms-2">{{ __('ui.violence') }}</span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="{{ $image->spoof }}"></i>
                                                    <span class="ms-2">{{ __('ui.spoof') }}</span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="{{ $image->racy }}"></i>
                                                    <span class="ms-2">{{ __('ui.racy') }}</span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="{{ $image->medical }}"></i>
                                                    <span class="ms-2">{{ __('ui.medical') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="swiper mySwiper rounded shadow"
                            style="width: 100%; max-width: 350px; height: 350px;">
                            <div class="swiper-wrapper">
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="swiper-slide d-flex justify-content-center align-items-center bg-light">
                                        <img src="https://picsum.photos/350?random={{ $i }}"
                                            alt="{{ __('ui.placeholder') }} {{ $i }}"
                                            class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-12 col-md-5 mb-4 ">
                    <div class="card shadow-lg">
                        <div class="card-body overflow-scroll">
                            <h2 class="card-title">{{ $article_to_check->title }}</h2>
                            <p class="card-subtitle mb-2"><strong>{{ __('ui.author') }}:</strong>
                                {{ $article_to_check->user->name }}</p>
                            <p class="text-dark"><strong>{{ __('ui.price') }}:</strong>
                                {{ $article_to_check->price }}€</p>
                            <p class="text-dark"><strong>{{ __('ui.category') }}:</strong>
                                {{ $article_to_check->category->name }}</p>
                            <p class="text-dark">{{ $article_to_check->description }}</p>

                            @if (session()->has('message'))
                                <div class="alert alert-success text-center mt-4">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="d-flex justify-content-around mt-4">
                                <form method="POST" action="{{ route('reject', ['article' => $article_to_check]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger">{{ __('ui.reject') }}</button>
                                </form>

                                <form method="POST" action="{{ route('accept', ['article' => $article_to_check]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success">{{ __('ui.accept') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="d-flex flex-column justify-content-center align-items-center min-vh-100 text-center">
                <h1 class="mb-3 text-secondary">{{ __('ui.noArticlesToReview') }}</h1>
                <a class="btn btn-primary" href="{{ route('homepage') }}">{{ __('ui.backToHomepage') }}</a>
            </div>
        @endif
    </div>

    {{-- SwiperJS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.mySwiper', {
            effect: 'cards',
            grabCursor: true,
        });
    </script>
</x-layout>
