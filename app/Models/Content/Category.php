<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Models\Content\Product', 'category_id', 'id')->where('lang', 'ru');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Content\Category', 'parent_id', 'id')->where('lang', 'ru');
    }

    public function trans()
    {
        return $this->hasMany('App\Models\Content\Category', 'trans_id', 'id');
    }
}
