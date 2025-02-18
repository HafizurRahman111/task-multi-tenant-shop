<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'category_id',
        'sku',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function generateSKU($categoryId, $productName)
    {
        $category = Category::find($categoryId);
        $categoryAbbr = strtoupper(substr($category->name, 0, 4));

        $productNameAbbr = strtoupper(substr($productName, 0, 3));

        $uniqueNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        return $categoryAbbr . '-' . $productNameAbbr . '-' . $uniqueNumber;
    }
}
