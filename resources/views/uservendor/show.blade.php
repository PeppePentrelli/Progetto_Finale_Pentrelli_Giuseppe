<x-layout>

    <div style="height: 100px"></div>
    <div class="container py-5">

        {{-- Profilo Venditore --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8" data-aos="fade-down">
                <div class="vendor-hero text-center">
                    <img src="{{ $vendor->profile_image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($vendor->name) . '&size=200&background=0D8ABC&color=fff' }}"
                        class="rounded-circle mb-3 shadow" alt="{{ $vendor->name }}"
                        style="width: 140px; height: 140px; object-fit: cover;">

                    <h2 class="fw-bold mb-1">{{ $vendor->name }}</h2>
                    <p class="mb-1">{{ $vendor->email }}</p>
                    <p class="small"><strong>{{ __('ui.registeredOn') }}:</strong>
                        {{ $vendor->created_at->format('d/m/Y') }}</p>
                    <span class="badge badge-success py-2 px-3">{{ __('ui.activeVendor') }}</span>
                </div>
            </div>
        </div>

        {{-- Prodotti --}}
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4" data-aos="fade-up">
                <h3 class="fw-bold">{{ __('ui.productsForSale') }}</h3>
                <p class="fst-italic">{{ __('ui.vendorIntro', ['name' => $vendor->name]) }}</p>
            </div>

            @if ($vendor->articles->count())
                <div class="row g-4 justify-content-center">
                    @foreach ($vendor->articles as $article)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex" data-aos="zoom-in">
                            <div class="card product-card border-0 rounded-4 w-100 overflow-hidden d-flex flex-column">
                                <img src="{{ $article->main_image_url ?? 'https://via.placeholder.com/400x200?text=Immagine+Articolo' }}"
                                    class="card-img-top" alt="{{ $article->title }}"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $article->title }}</h5>
                                        <p class="card-text">{{ Str::limit($article->description, 60) }}</p>
                                    </div>
                                    <p class="fw-bold mt-2 text-black">{{ number_format($article->price, 2) }} €</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center">
                                    <a href="{{ route('article.show', $article) }}" class="btn rounded-pill px-4"
                                        style="color: var(--nav-link--); background-color: var(--accessibilityBtn-bg);">
                                        {{ __('ui.viewProduct') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-12 text-center text-muted mt-5" data-aos="fade-up">
                    <p>{{ __('ui.noProductsYet') }}</p>
                </div>
            @endif
        </div>

</x-layout>
