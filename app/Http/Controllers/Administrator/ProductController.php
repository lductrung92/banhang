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
        return View::make('page_admin.product.index');
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

        $files = glob('uploads/caches/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }

        return View::make('page_admin.product.insert', compact('cateops'));
    }
}
