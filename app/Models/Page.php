<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $fillable = [
        'parent_id',
        'name',
        'content',
        'slug'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
