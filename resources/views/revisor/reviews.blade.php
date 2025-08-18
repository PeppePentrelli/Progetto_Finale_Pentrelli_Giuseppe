<x-layout>


    <div class="container my-5">

        <h2 class="fw-bold mb-2">{{ __('ui.reviewManagement') }}</h2>
        <p class="mb-4">{{ __('ui.reviewInstructions') }}</p>

        {{-- Messaggi conferme o errori --}}
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
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
        </div>

        {{-- SEZIONE RECENSIONI ARTICOLI --}}
        <h3 class="mt-4 mb-3">{{ __('ui.articleReviews') }}</h3>
        @forelse($articleReviews as $review)
            <div class="card mb-3 shadow-sm rounded">
                <div class="row g-0 p-3 align-items-center">

                    {{-- Immagine articolo --}}
                    <div class="col-auto me-3">
                        @if ($review->article && $review->article->images->count() > 0)
                            <img src="{{ $review->article->main_image_url ?? 'https://picsum.photos/80' }}"
                                alt="{{ $review->article->title }}" class="rounded"
                                style="width:80px; height:80px; object-fit:contain;">
                        @else
                            <img src="https://picsum.photos/80" alt="{{ __('ui.placeholder') }}" class="rounded"
                                style="width:80px; height:80px; object-fit:cover;">
                        @endif
                    </div>

                    {{-- Contenuto recensione --}}
                    <div class="col flex-grow-1">
                        <strong>
                            @if ($review->user)
                                <a href="{{ route('profilo.show', $review->user->id) }}">{{ $review->user->name }}</a>
                            @else
                                {{ __('ui.deletedUser') }}
                            @endif
                        </strong>
                        <span class="text-muted">- {{ $review->created_at->format('d/m/Y') }}</span>

                        <div class="review-stars mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star' }}"></i>
                            @endfor
                        </div>

                        <p class="fst-italic mb-1">{{ $review->text }}</p>

                        <small class="text-muted">
                            {{ __('ui.product') }}:
                            @if ($review->article)
                                <a
                                    href="{{ route('article.show', $review->article->id) }}">{{ $review->article->title }}</a>
                            @else
                                <span class="fst-italic text-muted">{{ __('ui.deletedArticle') }}</span>
                            @endif
                        </small>
                    </div>

                    {{-- Bottoni approva/rifiuta --}}
                    <div class="col-auto d-flex flex-column gap-2">
                        <form action="{{ route('revisor.articleReviews.approve', $review) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">{{ __('ui.approve') }}</button>
                        </form>
                        <form action="{{ route('revisor.articleReviews.reject', $review) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">{{ __('ui.reject') }}</button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <p class="">{{ __('ui.noArticleReviews') }}</p>
        @endforelse

        {{-- SEZIONE RECENSIONI SITO --}}
        <h3 class="mt-5 mb-3">{{ __('ui.siteReviews') }}</h3>
        @forelse($siteReviews as $review)
            <div class="card mb-3 shadow-sm rounded">
                <div class="row g-0 p-3 align-items-center">

                    {{-- Contenuto recensione --}}
                    <div class="col">
                        <strong>
                            @if ($review->user)
                                <a href="{{ route('profilo.show', $review->user->id) }}">{{ $review->user->name }}</a>
                            @else
                                {{ __('ui.deletedUser') }}
                            @endif
                        </strong>
                        <span class="text-muted">- {{ $review->created_at->format('d/m/Y') }}</span>

                        <div class="review-stars mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star' }}"></i>
                            @endfor
                        </div>

                        <p class="fst-italic mb-1">{{ $review->text }}</p>
                    </div>

                    {{-- Bottoni approva/rifiuta --}}
                    <div class="col-auto d-flex flex-column gap-2">
                        <form action="{{ route('revisor.siteReviews.approve', $review) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">{{ __('ui.approve') }}</button>
                        </form>
                        <form action="{{ route('revisor.siteReviews.reject', $review) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">{{ __('ui.reject') }}</button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <p class="">{{ __('ui.noSiteReviews') }}</p>
        @endforelse

        {{-- Paginazione --}}
        <div class="mt-4">
            {{ $articleReviews->links() }}
            {{ $siteReviews->links() }}
        </div>

    </div>

</x-layout>
