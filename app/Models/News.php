<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;

    public function tags(): BelongsToMany
    {
        return $this->belongsTo(Tag::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(NewsTranslation::class);
    }
}
