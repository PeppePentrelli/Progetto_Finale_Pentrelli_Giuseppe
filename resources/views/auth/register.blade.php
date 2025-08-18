<x-layout>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 border rounded-4 shadow-lg p-4 form-container mb-4">
                <div class="row justify-content-center">
                    <img class="img-fluid logo-main" style="max-height: 200px; width: auto;"
                        src="\media\loghi-nav/logo_presto_bianco.png" alt="">
                </div>
                <h4 class="text-center fw-bold mt-2">Crea un nuovo account</h4>
                <p class="text-center mb-4">È veloce e gratuito!</p>

                {{-- Social --}}
                <div class="text-center mb-3">
                    <p>Registrati con:</p>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-facebook"></i></button>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-google"></i></button>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-twitter"></i></button>
                    <button type="button" class="btn btn-social-form btn-floating mx-1"><i
                            class="bi bi-github"></i></button>

                </div>

                <p class="text-center">oppure</p>
                <hr>

                {{-- FORM --}}
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row justify-content-center mt-2">
                        <!-- Nome -->
                        <div class="col-12 col-md-8 ">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input name="name" type="text" class="form-control" placeholder="Nome utente"
                                    value="{{ old('name') }}" />
                            </div>
                            @error('name')
                                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                            @enderror

                            <!-- Email -->
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input name="email" type="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}" />
                            </div>
                            @error('email')
                                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                            @enderror

                            <!-- Immagine profilo -->
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                <input name="profile_image" type="file" class="form-control" />
                            </div>
                            @error('profile_image')
                                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                            @enderror

                            <!-- Immagine copertina -->
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-card-image"></i></span>
                                <input name="cover_image" type="file" class="form-control" />
                            </div>
                            @error('cover_image')
                                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                            @enderror

                            <!-- Password -->
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input name="password" type="password" class="form-control" placeholder="Password" />
                            </div>
                            @error('password')
                                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                            @enderror

                            <!-- Conferma Password -->
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input name="password_confirmation" type="password" class="form-control"
                                    placeholder="Conferma password" />
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Checkbox --}}
                        <div class="form-check d-flex justify-content-center mb-3">
                            <input class="form-check-input me-2" type="checkbox" name="terms" id="terms" />
                            <label class="form-check-label" for="terms">
                                <a style="text-decoration: none" href="#"> Accetto itermini e condizioni</a>
                            </label>
                        </div>
                        @error('terms')
                            <div class="text-danger text-center mb-3">{{ $message }}</div>
                        @enderror

                        <!-- Submit -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btnForm mb-3">Registrati</button>
                        </div>
                    </div>

                    <p class="text-center">Hai già un account? <a href="{{ route('login') }}">Accedi</a></p>
                </form>

            </div>
        </div>

    </div>
</x-layout>
