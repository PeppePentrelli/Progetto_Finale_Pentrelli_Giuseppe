<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use App\Models\ArticleReview;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id',
        'shipping_info',
        'length_cm',
        'width_cm',
        'height_cm',
        'weight_kg'
    ];

    // Relazioni
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function reviews()
    {
        return $this->hasMany(ArticleReview::class, 'article_id');
    }

    // Accessor per immagine principale
    public function getMainImageUrlAttribute(): string
    {
        $image = $this->images()->first();
        return $image
            ? asset('storage/' . $image->path)
            : 'https://picsum.photos/400/300';
    }

   
    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public static function toBeRevisedCount()
    {
        return Article::where('is_accepted', null)->count();
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'shipping_info' => $this->shipping_info,
            'length_cm' => $this->length_cm,
            'width_cm' => $this->width_cm,
            'height_cm' => $this->height_cm,
            'weight_kg' => $this->weight_kg,
        ];
    }

    public function getImagesUrlsAttribute(): array
    {

        if ($this->images->count() > 0) {
            return $this->images->map(function ($image) {
                return asset('storage/' . $image->path);
            })->toArray();
        }


        return ['https://picsum.photos/400/300'];
    }
}
