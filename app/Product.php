<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['cid', 'pid', 'name', 'title', 'slug', 'price', 'options', 'description', 'status', 'isnew'];

    public function category() {
        return $this->belongsTo('App\Category', 'cid');
    }

    public function images() {
        return $this->hasMany('App\Image', 'proid', 'id');
    }
}
