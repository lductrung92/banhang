<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CateRequest;
use View;
use App\Category;

class CateController extends Controller
{
    public function index() {
        $cateops = Category::orderBy('pid','desc')->get();
        $catels = Category::orderBy('pid','desc')->get();
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

}
