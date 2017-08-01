<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class CateController extends Controller
{
    public function index() {
        return View::make('administrator.category.index');
    }
}
