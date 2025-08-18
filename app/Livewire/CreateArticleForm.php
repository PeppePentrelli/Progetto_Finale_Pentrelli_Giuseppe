<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use Livewire\Attributes\Validate;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateArticleForm extends Component
{

    // Validazioni

    #[Validate('required|min:5')]
    public $title;

    #[Validate('required|min:10')]
    public $description;

    #[Validate('required|numeric')]
    public $price;

    #[Validate('required|exists:categories,id')]
    public $category_id;

    #[Validate('nullable|min:5')]
    public $shipping_info;

    #[Validate('nullable|numeric|min:0')]
    public $length_cm;

    #[Validate('nullable|numeric|min:0')]
    public $width_cm;

    #[Validate('nullable|numeric|min:0')]
    public $height_cm;

    #[Validate('nullable|numeric|min:0')]
    public $weight_kg;

    public $category;
    public $article;

    // Store
    public function store()
    {
        $this->validate();
        $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => Auth::id(),
            'shipping_info' => $this->shipping_info,
            'length_cm' => $this->length_cm ?: null,
            'width_cm' => $this->width_cm ?: null,
            'height_cm' => $this->height_cm ?: null,
            'weight_kg' => $this->weight_kg ?: null,
        ]);

        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $newFileName = "articles/{$this->article->id}";
                $newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 300, 300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        $this->reset();
        session()->flash('success', 'Articolo pubblicato con successo!');
    }

    // Render
    public function render()
    {
        return view('livewire.create-article-form');
    }

    // Logica per implementare il caricamento di immagini
    use WithFileUploads;

    public $images = [];
    public $temporary_images;


    public function mount()
    {
        $this->images = [];
        $this->temporary_images = [];
    }



    // Validazione immagini
    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images.*' => 'image|max:5024',
            'temporary_images' => 'max:6',

        ]);

        foreach ($this->temporary_images as $image) {

            $this->images[] = $image;
        }

        //  dd($this->images); 
    }


    // Logica per cancellare immagini dal form
    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    // Messaggi personalizzati per errori immagine
    public function messages()
    {
        return [
            'temporary_images.*.image' => 'Ogni file deve essere un\'immagine.',
            'temporary_images.*.max' => 'Ogni immagine non può superare i 5MB.',
            'temporary_images.max' => 'Puoi caricare al massimo 6 immagini.',
        ];
    }
}
