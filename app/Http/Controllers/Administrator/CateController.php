<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CateRequest;
use View;
use DB;
use App\Category;
use Illuminate\Support\Facades\Response;
use Validator;

class CateController extends Controller
{
    public function index(Request $request) {
        $cateops = DB::table('categories')
                    ->select('id', 'pid', 'name')
                    ->get();
        $catels = DB::table('categories')
                    ->select('id', 'pid', 'name')
                    ->get();
        $catetbs = Category::with(['childs', 'parent'])->get(); // ::has('products')
        
        $dirname = "icon/small/";
        $icons = glob($dirname."*.png");

        return View::make('page_admin.category.index', compact(['cateops', 'catels', 'catetbs', 'icons']));
    }

    public function postInsert(CateRequest $request) {
        $cate = new Category();
        $cate->pid = $request->selCate;
        $cate->name = $request->txtNameCate;
        $cate->icon = $request->txtIcon;
        $cate->slug = $request->txtSlug == '' ? changeTitle($request->txtNameCate) : changeTitle($request->txtSlug);
        $cate->description = $request->txtDesCate;
        $cate->status = empty($request->checkStatus) ? 0 : 1;
        $cate->save();
        return back()->with('messages', 'Thêm thành công');
    }

    public function postUpdate(Request $request, $id) {
        $rules = [
            'txtNameCate' => 'required|min:3|max:191|unique:categories,name,'.$id
        ];
        
        $messages = [
            'txtNameCate.required' => 'Tên danh mục không thể trống',
            'txtNameCate.min' => 'Tên danh mục quá ngắn',
            'txtNameCate.max' => 'Tên danh mục quá dài',
            'txtNameCate.unique' => 'Tên danh mục đã tồn tại'
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'messages' => $validator->errors()
            ]);
        } else {
            $cate = Category::find($id);
            $cate->pid = $request->selCate;
            $cate->name = $request->txtNameCate;
            $cate->icon = $request->txtIcon;
            $cate->slug = $request->txtSlug == '' ? changeTitle($request->txtNameCate) : changeTitle($request->txtSlug);
            $cate->description = $request->txtDesCate;
            $cate->status = empty($request->checkStatus) ? 0 : 1;
            $cate->update();
            return response()->json([
                'status' => true,
                'messages' => 'Cập nhật thành công'
            ]);
        }
    }

    public function ajaxPostInsert(Request $request) {
        foreach($request->data as $data) {
             $cate = Category::find($data['id']);
             $cate->pid = $data['pid'];
             $cate->update();
        }
        return response()->json([
            'status' => true,
            'messages' => 'Cập nhật thành công'
        ]);
    }

    public function getDeleteCate($id) {
        $cate = Category::find($id);
        if(count($cate->childs))
            return back()->with('type', 'danger')->with('messages', 'Xóa thất bại! Bạn phải xóa các danh mục con của danh mục này trước');
        else {
            $cate->delete();
            return back()->with('messages', 'Xóa thành công');
        }
    }

}
