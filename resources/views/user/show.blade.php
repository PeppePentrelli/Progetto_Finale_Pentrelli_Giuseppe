<x-layout>

    <div class="profile-container">

        {{-- Cover Image --}}
        <div class="cover-image">
            <img src="{{ $user->cover_image_url }}" alt="{{ __('ui.coverImage') }}">
        </div>

        {{-- Profile Info --}}
        <div class="profile-header">
            {{-- Profile Image --}}
            <div class="profile-image">
                <img src="{{ $user->profile_image_url }}" alt="{{ __('ui.profilePhoto') }}">
            </div>
            <div class="profile-details mt-5">
                <h1>{{ $user->name }}</h1>
                <p class="email">{{ $user->email }}</p>
                <p class="member-date">{{ __('ui.memberSince') }} {{ $user->created_at->format('d/m/Y') }}</p>
                <p class="bio">{{ $user->bio ?? __('ui.noBio') }}</p>
            </div>

            <div>
                @if (Auth::user()->is_revisor)
                    <div class="ms-auto">
                        <img style="height: 200px; width: auto;" class="img-fluid" src="/media/loghi-nav/isRevisor.png"
                            alt="{{ __('ui.revisorBadgeAlt') }}">
                    </div>
                @elseif (Auth::user()->is_vendor)
                    <div class="ms-auto">
                        <img style="height: 200px; width: auto;" class="img-fluid" src="/media/loghi-nav/is_vendor.png"
                            alt="{{ __('ui.vendorBadgeAlt') }}">
                    </div>
                @endif
            </div>
        </div>

        {{-- Articoli Pubblicati --}}
        <div class="articles-section">
            <h2>{{ __('ui.publishedArticles') }}</h2>
            <div class="articles-grid">
                @forelse($user->articles ?? [] as $article)
                    <div class="article-card">
                        <img src="{{ $article->main_image_url ?? 'https://via.placeholder.com/400x200?text=Immagine+Articolo' }}"
                             alt="{{ $article->title }}">
                        <div class="article-content d-flex justify-content-center flex-column">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ Str::limit($article->body, 100) }}</p>
                            <a href="{{ route('article.show', $article) }}" class="btnNav btn">{{ __('ui.details') }}</a>
                        </div>
                    </div>
                @empty
                    <p class="no-articles">{{ __('ui.noArticles') }}</p>
                @endforelse
            </div>
        </div>

    </div>

</x-layout>
