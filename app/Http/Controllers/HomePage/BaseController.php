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

    // function getChildsLevel1() {
    //     $listparentID = Category::parentID(0)->get();
    //     $arr = array();
    //     foreach($listparentID as $item) {
    //         $arr[] = Category::parentID($item->id)->get();
    //     }
    //     return $arr;
    // }

    // function lastCate($categories, $arr = array()) {
    //     foreach($categories as $cate) {
    //         if(count($cate->childs) > 0) {
    //             $this->lastCate($cate->childs, $arr);
    //         } else {
    //             $arr[] = $cate;
    //         }
    //     }
    //     return $arr;
    // }

    // // function lastCate($categories, $parent_id = 0) {
    // //     foreach ($categories as $key => $item)
    // //     {
    // //         if ($item->pid == $parent_id) {
    // //             foreach($categories as $i => $value) {
    // //                 if ($item->id == $value->pid) {
    // //                     unset($categories[$key]);
    // //                     $this->lastCate($categories, $item->id);
    // //                 }
    // //             }
                
    // //         }
    // //     }
    // //     return $this->resetIndexArray($categories);
    // // }

    // function resetIndexArray($arr) {
    //     $tam = array();
    //     foreach($arr as $key => $item) {
    //         $tam[] = $item;
    //     }
    //     return $tam;
    // } 

    // function lastPreOneNode($arr) {
    //     $tam = $arr[0];
    //     $result = array();
    //     $t = 0;
    //     while(1) {
    //         foreach ($arr as $key => $item)
    //         {
    //             if ($tam->pid == $item->pid) {
    //                 unset($arr[$key]);
    //                 $t++;
    //             }
    //         }
    //         $result[] = $tam->pid;
    //         if(count($arr) == 0) break;
    //         $tam = $arr[$t];
    //     }
    //     return $result;
    // }
}
