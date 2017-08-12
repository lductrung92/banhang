<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\HomePage\BaseController;
use View;
use App\Category;

class HomePageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() {
        return View::make('page_home.index');
    }
}
