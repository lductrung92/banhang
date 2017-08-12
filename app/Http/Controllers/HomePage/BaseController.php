<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use App\Category;
use DB;

class BaseController extends Controller
{

    public function __construct()
    {
        $categories = $this->getValueCategories();
        View::share('maincategories', $categories);
    }

    function getValueCategories() {
        return DB::table('categories')
                    ->select('id', 'pid', 'name')
                    ->get();
    }
}
