{{-- Login view --}}
<x-layout>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 border rounded-4 shadow-lg p-4 form-container">
<div class="row justify-content-center">
    <img class="img-fluid logo-main" style="max-height: 200px; width: auto;"
         src="\media\loghi-nav/logo_presto_bianco.png" alt="">
</div>
                {{-- SOCIAL LOGIN --}}
                <div class="text-center">
                    <h4 class="fw-bold mb-3">Accedi con:</h4>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-facebook"></i></button>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-google"></i></button>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-twitter"></i></button>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-github"></i></button>
                </div>

                <p class="text-center mt-3">oppure</p>
                <hr>
                <h6 class="text-center mb-3">Accedi con le tue credenziali</h6>

                {{-- FORM LOGIN --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input name="email" type="email" id="email" class="form-control" placeholder="Email"
                            value="{{ old('email') }}" />
                    </div>
                    @error('email')
                        <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                    @enderror

                    {{-- Password --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input name="password" type="password" id="password" class="form-control"
                            placeholder="Inserisci la password" />
                    </div>
                    @error('password')
                        <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                    @enderror

                    {{-- Ricordami e password dimenticata --}}
                    <div class="row mb-3">
                        <div class="col-md-6 d-flex justify-content-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="loginCheck"
                                    {{ old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="loginCheck">Ricordami</label>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <a href="#">Password dimenticata?</a>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btnForm mb-3">Accedi</button>
                    </div>

                    <p class="text-center">Non hai ancora un account? <a
                            href="{{ route('register') }}"><strong>Registrati ora</strong></a></p>
                </form>
                {{-- FINE FORM --}}
            </div>
        </div>
    </div>
        {{-- Distanziatore --}}
    <div style="height: 100px"></div>
</x-layout>