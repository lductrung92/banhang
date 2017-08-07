<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['proid', 'name', 'isfirst'];

    public function product() {
        return $this->belongsTo('App\Product', 'proid');
    }

}
