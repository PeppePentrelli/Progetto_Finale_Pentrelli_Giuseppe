<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'text', 'rating', 'approved'];

    // Relazione con utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relazione con articolo
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
