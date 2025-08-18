{{-- Contenitore dell helper --}}
<div class="helperContainer">

    {{-- bottone con ingranaggio per aprire --}}
    <button id="helperBtn" aria-label="Apri le impostazioni rapide" class="helperBtn">
        <i class="bi bi-gear"></i>
    </button>

    {{-- Contenuto menu --}}
    <div id="helperMenu" class="dropdown-menu custom-helper-dropdown">

        {{-- cambio tema --}}
        <label for="themeSelector">🎨 Tema colore:</label>
        <select id="themeSelector" class="form-select mb-3">
            <option value="theme-energia">Energia</option>
            <option value="theme-fiducia">Fiducia</option>
            <option value="theme-natura">Natura</option>
            <option value="theme-Aulab-Lovers">Aulab Lovers</option>
        </select>

        <hr>

        {{-- cambio lingua --}}
        <div class="dropup">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                🌐 Lingua:
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" data-lang="it"><x-_locale lang="it" /> Italiano</a>
                </li>
                <li><a class="dropdown-item" href="#" data-lang="en"><x-_locale lang="en" /> English</a></li>
                <li><a class="dropdown-item" href="#" data-lang="fr"><x-_locale lang="fr" /> Français</a>
                </li>
                <li><a class="dropdown-item" href="#" data-lang="es"><x-_locale lang="es" /> Español</a></li>
                <li><a class="dropdown-item" href="#" data-lang="de"><x-_locale lang="de" /> Tedesco</a></li>
                <li><a class="dropdown-item" href="#" data-lang="ru"><x-_locale lang="ru" /> Russo</a></li>
                <li><a class="dropdown-item" href="#" data-lang="ja"><x-_locale lang="ja" /> Giapponese</a>
                </li>
            </ul>
        </div>




    </div>
</div>
