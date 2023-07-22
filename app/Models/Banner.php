<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = "banners";
    protected $guarded = [];

    public function isActive(): Attribute{
        return Attribute::get(
            fn($vlaue) => $vlaue ? 'فعال' : 'غیر فعال'
        );
    }
}
