<style>
   .fade-in {
        animation: fadeIn 1.5s ease-in forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }
</style>


<main style="height: 100vh; display: flex; justify-content: center; align-items: center" >
<div class="nulla-box fade-in">
    <h1>Hai trovato il nulla.</h1>
    <p class="lead">Complimenti. Non tutti ci riescono.</p>

    <div class="mt-4">
        <h4>Oggetto immaginario del giorno:</h4>

        <p><strong>Specchio che non riflette</strong></p>
        <p class="text-muted">Disponibile solo nel mondo delle idee.</p>
    </div>

    @php
        $articoloCasuale = \App\Models\Article::where('is_accepted', true)->inRandomOrder()->first();
    @endphp

        <a href="{{ route('homepage') }}">
            Torna alla realtà
        </a>
    </div>
</div>
</main>