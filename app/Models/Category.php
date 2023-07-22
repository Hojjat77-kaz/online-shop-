<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [];


    public function isActive(): Attribute{
        return Attribute::get(
            fn($vlaue) => $vlaue ? 'فعال' : 'غیر فعال'
        );

    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function attributes(){
        return $this->belongsToMany(\App\Models\Attribute::class,'attribute_category');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }


}
