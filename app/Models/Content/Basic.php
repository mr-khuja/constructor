<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Basic extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'basic';
    protected $guarded = [];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function trans()
    {
        return $this->hasMany('App\Models\Content\Basic', 'trans_id', 'id');
    }
}
