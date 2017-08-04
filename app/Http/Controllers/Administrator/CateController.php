<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CateRequest;
use View;
use DB;
use App\Category;

class CateController extends Controller
{
    public function index() {
        $cateops = DB::table('categories')
                    ->select('id', 'pid', 'name')
                    ->get();
       
        $catels = DB::table('categories')
                    ->select('id', 'pid', 'name')
                    ->get();
        $catetbs = Category::all();
        return View::make('administrator.category.index', compact(['cateops', 'catels']));
    }

    public function postInsert(CateRequest $request) {
        $cate = new Category();
        $cate->pid = $request->selCate;
        $cate->name = $request->txtNameCate;
        $cate->description = $request->txtDesCate;
        $cate->status = empty($request->checkStatus) ? 0 : 1;
        $cate->save();
        return back()->with('success', 'Thêm mới thành công');
    }

    public function ajaxPostInsert(Request $request) {
        foreach($request->data as $data) {
             $cate = Category::find($data['id']);
             $cate->pid = $data['pid'];
             $cate->update();
        }
        echo 'success';
    }

}
