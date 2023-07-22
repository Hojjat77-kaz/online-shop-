<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory,Sluggable;
    protected $table = 'brands';
    protected $guarded = [];



    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

   public function isActive(): Attribute{
        return Attribute::get(
          fn($vlaue) => $vlaue ? 'فعال' : 'غیر فعال'
        );

   }

}
