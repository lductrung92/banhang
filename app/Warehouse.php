<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    public function product() {
        return $this->hasOne('App\Product', 'proid');
    }
}
