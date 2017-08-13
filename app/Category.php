<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['id', 'pid', 'name', 'icon', 'description', 'status'];

    public function childs() {
        return $this->hasMany('App\Category', 'pid', 'id');
    }

    public function parent() {
        return $this->belongsTo('App\Category', 'pid');
    }

    public function products() {
        return $this->hasMany('App\Product', 'cid');
    }

    public function scopeParentID($query, $id) {
        return $query->wherePid($id);
    }

    public function scopeId($query, $id) {
        return $query->whereId($id);
    }

    public function scopeHasProduct($query) {
        return $query->has('products');
    }

    public function scopeCateChild1($query, $id) {
        $query->wherePid($id)->select('name', 'slug', 'icon');
    }
}
