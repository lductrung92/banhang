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
        $catetbs = Category::all();
        return View::make('administrator.category.index', compact(['cateops', 'catels', 'catetbs']));
    }

    public function postInsert(CateRequest $request) {
        


        $cate = new Category();
        $cate->pid = $request->selCate;
        $cate->name = $request->txtNameCate;
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
        return 'success';
    }

    public function getDeleteCate($id) {
        $cate = Category::find($id);
        if(count($cate->childs))
            return back()->with('type', 'danger')->with('messages', 'Xóa thất bại! <?p Bạn phải xóa các danh mục con của danh mục này trước');
        else {
            $cate->delete();
            return back()->with('messages', 'Xóa thành công');
        }
    }

}
