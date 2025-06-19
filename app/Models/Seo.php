<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Seo extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_alt',
        'seoable_id',
        'seoable_type',
    ];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
