<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';
    protected $guarded = [];


    public function trans()
    {
        return $this->hasMany('App\Models\Content\Slider', 'trans_id', 'id');
    }
}
