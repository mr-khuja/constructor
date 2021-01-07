<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

class Project extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'project';
    protected $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Content\Service', 'service_id', 'id');
    }

    public function trans()
    {
        return $this->hasMany('App\Models\Content\Project', 'trans_id', 'id');
    }
}
