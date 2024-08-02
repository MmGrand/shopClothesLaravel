<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $fillable = [
        'name',
        'slug',
        'content',
        'image',
        'parent_id'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public static function categories()
    {
        return self::where('parent_id', 0)->with('childrenRecursive')->get();
    }

    public function validParent($id): bool
    {
        $id = (integer)$id;
        $ids = $this->getAllChildren($this->id);
        $ids[] = $this->id;
        return ! in_array($id, $ids);
    }

    public function getAllChildren($id): array
    {
        $children = self::where('parent_id', $id)->with('children')->get();
        $ids = [];
        foreach ($children as $child) {
            $ids[] = $child->id;
            if ($child->children->count()) {
                $ids = array_merge($ids, $this->getAllChildren($child->id));
            }
        }
        return $ids;
    }
}
