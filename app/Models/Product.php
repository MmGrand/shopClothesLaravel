<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Stem\LinguaStemRu;

class Product extends Model
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
        'price',
        'is_published',
        'views_count',
        'category_id',
        'brand_id',
        'new',
        'hit',
        'sale',
    ];

    //Relations
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function baskets(): BelongsToMany
    {
        return $this->belongsToMany(Basket::class)->withPivot('quantity');
    }

    //Scopes
    public function scopeCategoryProducts($builder, $id)
    {
        $descendants = Category::getAllChildren($id);
        $descendants[] = $id;
        return $builder->whereIn('category_id', $descendants);
    }

    public function scopeFilterProducts($builder, $filters)
    {
        return $filters->apply($builder);
    }

    // Scope для поиска
    public function scopeSearch($query, $search)
    {
        $search = iconv_substr($search, 0, 64);
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        $search = preg_replace('#\s+#u', ' ', $search);
        $search = trim($search);

        if (empty($search)) {
            return $query->whereNull('id'); // возвращаем пустой результат
        }

        $temp = explode(' ', $search);
        $words = [];
        $stemmer = new LinguaStemRu();
        foreach ($temp as $item) {
            if (iconv_strlen($item) > 3) {
                $words[] = $stemmer->stem_word($item);
            } else {
                $words[] = $item;
            }
        }

        $query->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->select('products.*');

        $query->where(function ($q) use ($words) {
            $q->where('products.name', 'like', '%' . $words[0] . '%')
                ->orWhere('products.content', 'like', '%' . $words[0] . '%')
                ->orWhere('categories.name', 'like', '%' . $words[0] . '%')
                ->orWhere('brands.name', 'like', '%' . $words[0] . '%');
        });

        for ($i = 1; $i < count($words); $i++) {
            $query->orWhere(function ($q) use ($words, $i) {
                $q->where('products.name', 'like', '%' . $words[$i] . '%')
                    ->orWhere('products.content', 'like', '%' . $words[$i] . '%')
                    ->orWhere('categories.name', 'like', '%' . $words[$i] . '%')
                    ->orWhere('brands.name', 'like', '%' . $words[$i] . '%');
            });
        }

        // Обновляем релевантность для сортировки
        $relevance = "IF (`products`.`name` LIKE '%" . $words[0] . "%', 2, 0)";
        $relevance .= " + IF (`products`.`content` LIKE '%" . $words[0] . "%', 1, 0)";
        $relevance .= " + IF (`categories`.`name` LIKE '%" . $words[0] . "%', 1, 0)";
        $relevance .= " + IF (`brands`.`name` LIKE '%" . $words[0] . "%', 2, 0)";

        for ($i = 1; $i < count($words); $i++) {
            $relevance .= " + IF (`products`.`name` LIKE '%" . $words[$i] . "%', 2, 0)";
            $relevance .= " + IF (`products`.`content` LIKE '%" . $words[$i] . "%', 1, 0)";
            $relevance .= " + IF (`categories`.`name` LIKE '%" . $words[$i] . "%', 1, 0)";
            $relevance .= " + IF (`brands`.`name` LIKE '%" . $words[$i] . "%', 2, 0)";
        }

        $query->select('products.*', DB::raw($relevance . ' as relevance'))
            ->orderBy('relevance', 'desc');

        return $query;
    }
}
