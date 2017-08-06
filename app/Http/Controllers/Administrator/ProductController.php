<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use App\Category;

class ProductController extends Controller
{
    public function index() {
        return View::make('administrator.product.index');
    }

    public function showFormInsert() {
        $categories = Category::all();
        $cateops = array();
        foreach($categories as $item) {
            if(count($item->childs) === 0) {
                array_push($cateops, array(
                    'id' => $item->id,
                    'name' => $item->name
                ));
            }
        } 
        return View::make('administrator.product.insert', compact('cateops'));
    }
}
