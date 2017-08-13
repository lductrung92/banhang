<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\HomePage\BaseController;
use View;
use App\Category;
use DB;

class HomePageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() {
        /** danh mục nổi bật*/
        $highlights = DB::table('products')
                ->join('images', 'images.proid', '=', 'products.id')
                ->where('images.isfirst', '=', 1)
                ->where('isnew', '=', 1)
                ->select('products.*', 'images.name as img')
                ->orderBy('products.created_at', 'DESC')
                ->take(8)
                ->get();
        
        $home_blocks = array();

        $cateParent0 = DB::table('categories')
                    ->where('pid', '=', 0)
                    ->select('id', 'name')
                    ->get();
        
        foreach($cateParent0 as $item) {
            $tam = array();
            $tam[] = $item->name;
            $tam[] = Category::cateChild1($item->id)->get();
            $tam[] = DB::table('products') 
                    ->join('categories', 'products.cid', '=', 'categories.id')
                    ->join('images', 'images.proid', '=', 'products.id')
                    ->where('images.isfirst', '=', 1)
                    ->where('products.pid', '=', $item->id)
                    ->select('products.*', 'images.name as img')
                    ->orderBy('products.created_at', 'DESC')
                    ->take(10)->get();
            $home_blocks[] = $tam;
        }

        return View::make('page_home.index', compact(['highlights', 'home_blocks']));
    }
}
