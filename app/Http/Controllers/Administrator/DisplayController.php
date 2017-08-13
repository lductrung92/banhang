<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class DisplayController extends Controller
{
    public function index() {
        return View::make('page_admin.display.index');
    }
}
