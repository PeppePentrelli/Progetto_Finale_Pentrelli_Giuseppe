navbarsearched.blade.php<x-layout>
    <main class="container-fluid py-4">


        {{-- Titolo Risultati di Ricerca --}}
        <h2 class="display-5 fw-bold heading-title my-5 text-center">
            <i class="bi bi-search me-3"></i>Risultati per: "<span class="heading-title">{{ $query }}</span>"
        </h2>

        {{-- Sezione articoli --}}
        <section class="container">
            <div class="row justify-content-start">
                @forelse ($articles as $article)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center mb-4">
                        <x-card :article="$article" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">Nessun articolo trovato per la tua ricerca.</h4>
                        <p class="lead mt-3">Prova a cercare con parole chiave diverse.</p>

                        <a href="{{ route('article.index') }}" class="btn btn-outline-primary mt-3">
                            <i class="bi bi-arrow-left-circle me-2"></i> Torna a tutti gli articoli
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Paginazione --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $articles->links() }}
            </div>
        </section>
    </main>
</x-layout>
