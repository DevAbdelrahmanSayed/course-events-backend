<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class City extends Model
{
    protected $fillable = [
        'country_id',
        'admin_id',
        'name',
        'name_ar',
        'slug',
        'code',
        'description',
        'publish',
        'is_monday',
        'image',
        'attributes',
    ];

    protected $casts = [
        'publish' => 'boolean',
        'is_monday' => 'boolean',
        'attributes' => 'array',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
