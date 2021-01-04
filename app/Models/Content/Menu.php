<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $guarded = [];

    public function children(){
        return $this->hasMany('App\Models\Content\Menu', 'parent_id', 'id')->where('lang', 'ru');
    }
    public function trans(){
        return $this->hasMany('App\Models\Content\Menu', 'trans_id', 'id');
    }
}
