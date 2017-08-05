<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class ProductController extends Controller
{
    public function index() {
        return View::make('administrator.product.index');
    }
}
