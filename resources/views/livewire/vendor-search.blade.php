<div>
    <div>
        {{-- Input di ricerca --}}
        <div class="input-group mb-4 shadow-sm text-black rounded" style="color: black !important;">
            <input type="text" class="form-control text-dark rounded" placeholder="{{ __('ui.searchVendor') }}"
                wire:model.live="search">
            <span class="input-group-text btnNav">
                <i class="bi bi-search"></i>
            </span>
        </div>

        {{-- Lista venditori --}}
        @if ($vendors->count())
            <div class="row g-4">
                @foreach ($vendors as $vendor)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mx-auto d-flex justify-content-center">
                        <div
                            class="card shadow border-0 rounded-4 h-100 d-flex flex-column align-items-center text-center p-3 vendor-card">
                            <img loading="lazy"
                                src="{{ $vendor->profile_image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($vendor->name) . '&size=200&background=0D8ABC&color=fff' }}"
                                class="rounded-circle shadow mb-3" alt="{{ $vendor->name }}"
                                style="width: 100px; height: 100px; object-fit: cover;">

                            <div class="card-body w-100 text-center">
                                <h5 class="card-title fw-bold">{{ $vendor->name }}</h5>
                                <p class="text-muted mb-1">{{ $vendor->email }}</p>
                                <p class="small text-secondary">
                                    {{ __('ui.registeredOn') }} {{ $vendor->created_at->format('d/m/Y') }}
                                </p>
                                <span class="badge bg-info-subtle text-info-emphasis p-2 rounded-pill">
                                    {{ $vendor->articles_count }} {{ __('ui.itemsForSale') }}
                                </span>
                            </div>

                            <div class="card-footer bg-transparent border-0">
                                <a href="{{ route('uservendor.profile', $vendor->id) }}"
                                    class="btn rounded-pill px-4 btnNav"
                                    style="color: var(--nav-link--); background-color: var(--accessibilityBtn-bg);">
                                    {{ __('ui.viewProfile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-5">
                <p>{{ __('ui.noVendorFound') }}</p>
            </div>
        @endif
    </div>
</div>
