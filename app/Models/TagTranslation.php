<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TagTranslation extends Model
{
    use HasFactory;

    protected $table = 'tags_translations';

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
