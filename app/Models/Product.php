<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Sortable;

protected $fillable = [
    'product_name',
    'category_id',
    'unit_id',
    'product_code',
    'stock',
    'buying_price',
    'selling_price',
    'product_image',
    // New fields
    'serial_number',
    'make_or_brand',
    'ram',
    'storage_capacity',
    'gpu',
    'is_obsolete',
    'is_written_off',
    'codInventarioUCV',
    'comments',

];

public $sortable = [
    'product_name',
    'category_id',
    'unit_id',
    'product_code',
    'stock',
    'buying_price',
    'selling_price',
    // You might also want to make the new fields sortable
    'serial_number',
    'make_or_brand',
    'ram',
    'storage_capacity',
    'gpu',
    // Note: Boolean fields like 'is_obsolete' and 'is_written_off' might not need to be sortable depending on your use case
];
    protected $guarded = [
        'id',
    ];

    protected $with = [
        'category',
        'unit'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('product_name', 'like', '%' . $search . '%');
        });
    }
}
