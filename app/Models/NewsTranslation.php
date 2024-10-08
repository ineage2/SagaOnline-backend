<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsTranslation extends Model
{
    use HasFactory;

    protected $table = 'news_translations';

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
