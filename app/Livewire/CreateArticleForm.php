<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateArticleForm extends Component
{
    use WithFileUploads;

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

    // Immagini
    public $images = [];
    public $temporary_images = [];

    public function mount()
    {
        $this->images = [];
        $this->temporary_images = [];
    }

    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images.*' => 'image|max:5024',
            'temporary_images' => 'max:6',
        ]);

        foreach ($this->temporary_images as $image) {
            $storedPath = $image->store('temp', 'public');
            $this->images[] = $storedPath;
        }

        $this->temporary_images = [];
    }

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            if (File::exists(storage_path('app/public/' . $this->images[$key]))) {
                File::delete(storage_path('app/public/' . $this->images[$key]));
            }
            unset($this->images[$key]);
        }
    }

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
            foreach ($this->images as $imagePath) {
                $newFileName = "articles/{$this->article->id}";
                $filename = basename($imagePath);
                $newPath = $newFileName . '/' . $filename;

                Storage::disk('public')->move($imagePath, $newPath);

                $newImage = $this->article->images()->create(['path' => $newPath]);

                // Job per resize e Google Vision
                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 300, 300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }
        }

        $this->images = [];
        session()->flash('success', 'Articolo pubblicato con successo!');
    }

    public function render()
    {
        return view('livewire.create-article-form');
    }

    public function messages()
    {
        return [
            'temporary_images.*.image' => 'Ogni file deve essere un\'immagine.',
            'temporary_images.*.max' => 'Ogni immagine non può superare i 5MB.',
            'temporary_images.max' => 'Puoi caricare al massimo 6 immagini.',
        ];
    }
}
