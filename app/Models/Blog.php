<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'content',
        'image'
    ];

    public function blogCategory()
    {
        return $this->hasMany(BlogCategory::class);
    }
}
