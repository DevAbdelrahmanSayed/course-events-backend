<?php

namespace App\Models;

use App\Traits\HasCustomSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

class Country extends Model
{
    use HasFactory ,HasCustomSlug ,KeepsDeletedModels;

    protected $fillable = [
        'name',
        'name_ar', 
        'slug',
        'content',
        'currency',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
