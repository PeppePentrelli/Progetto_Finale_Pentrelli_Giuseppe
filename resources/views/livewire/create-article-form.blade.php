{{-- Form livewire ArticleCreate --}}
<div>
    <form wire:submit="store">
        <div class="row pb-2">

            @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row justify-content-center my-2">
                <div class="col-12 text-center">
                    <h1><strong>Pubblica un articolo</strong></h1>
                </div>
            </div>

            <!-- Titolo -->
            <div data-mdb-input-init class="mb-4 col-md-6">
                <label class="form-label" for="title">Titolo</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-type"></i></span>
                    <input type="text" id="title" class="form-control" wire:model.blur="title" />
                </div>
            </div>
            {{-- errori titolo --}}
            @error('title')
                <div class="text-danger bold mb-2 ms-1">{{ $message }}</div>
            @enderror

            <!-- Prezzo -->
            <div data-mdb-input-init class="mb-4 col-md-6">
                <label class="form-label" for="price">Prezzo (€)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                    <input type="number" step="0.01" id="price" class="form-control" wire:model.blur="price" />
                </div>
            </div>
            {{-- errori prezzo --}}
            @error('price')
                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
            @enderror

            <!-- Descrizione -->
            <div data-mdb-input-init class="mb-4 col-12">
                <label class="form-label" for="description">Descrizione</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                    <textarea id="description" class="form-control" rows="4" wire:model.blur="description"></textarea>
                </div>
            </div>
            {{-- errori descrizione --}}
            @error('description')
                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
            @enderror

            <!-- Categoria -->
            <div data-mdb-input-init class="mb-4 col-md-6">
                <label class="form-label" for="category_id">Categoria</label>
                <div class="input-group">
                    <span class="input-group-text py-4"><i class="bi bi-ui-checks"></i></span>
                    <select id="category_id" class="form-select" wire:model.blur="category_id">
                        <option value="">Seleziona categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- errori descrizione --}}
            @error('category_id')
                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
            @enderror

            <!-- Info spedizione -->
            <div data-mdb-input-init class="mb-4 col-12">
                <label class="form-label" for="shipping_info">Informazioni di spedizione</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-truck"></i></span>
                    <textarea id="shipping_info" class="form-control" rows="3" wire:model.blur="shipping_info"></textarea>
                </div>
            </div>
            {{-- errori info spedizione --}}
            @error('shipping_info')
                <div class="text-danger mb-2 ms-1">{{ $message }}</div>
            @enderror

            <!-- Dimensioni -->
            <div data-mdb-input-init class="mb-4 col-md-3">
                <label class="form-label" for="length_cm">Lunghezza (cm)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-arrows-expand"></i></span>
                    <input type="number" step="0.01" id="length_cm" class="form-control"
                        wire:model.blur="length_cm" />
                </div>
            </div>

            <div data-mdb-input-init class="mb-4 col-md-3">
                <label class="form-label" for="width_cm">Larghezza (cm)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-arrows-angle-expand"></i></span>
                    <input type="number" step="0.01" id="width_cm" class="form-control"
                        wire:model.blur="width_cm" />
                </div>
            </div>

            <div data-mdb-input-init class="mb-4 col-md-3">
                <label class="form-label" for="height_cm">Altezza (cm)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-arrow-up-short"></i></span>
                    <input type="number" step="0.01" id="height_cm" class="form-control" wire:model="height_cm" />
                </div>
            </div>

            <!-- Peso -->
            <div data-mdb-input-init class="mb-4 col-md-3">
                <label class="form-label" for="weight_kg">Peso (kg)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                    <input type="number" step="0.001" id="weight_kg" class="form-control"
                        wire:model="weight_kg" />
                </div>
            </div>

<hr>

{{-- Inizio sezione caricamento immagini --}}
<div class="mb-3 input-group">
    <span class="input-group-text"><i class="bi bi-upload"></i></span>
    <input type="file" wire:model.live="temporary_images" multiple 
        class="form-control @error('temporary_images.*') is-invalid @enderror" placeholder="Img/">
</div>

@error('temporary_images.*')
    <p class="text-danger">{{ $message }}</p>
@enderror

@error('temporary_images')
    <p class="text-danger">{{ $message }}</p>
@enderror


@if(!empty($images))
    <div class="row">
        @foreach($images as $key => $path)
            <div class="col-6 col-md-3 mb-4 d-flex justify-content-center">
                <div class="position-relative">
                    <div class="img-preview" style="background-image: url('{{ asset('storage/'.$path) }}');"></div>
                    <button type="button" wire:click="removeImage({{ $key }})"
                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle"
                        title="Rimuovi">&times;</button>
                </div>
            </div>
        @endforeach
    </div>
@endif


{{-- Fine sezione caricamento immagini --}}


            <div class="text-end">
                <button type="submit" class="btn btnNav">Salva Articolo</button>
            </div>
    </form>

</div>