<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use App\Category;
use Illuminate\Support\Facades\Response;
use Validator;
use Image;

class ProductController extends Controller
{

    protected $rules = [
        'txtNameProduct' => 'required|max:191|unique:products,name',
        'txtPrice' => 'required|integer',
    ];

    protected $messages = [
        'txtNameProduct.required' => 'Tên sản phẩm không được để trống',
        'txtNameProduct.max' => 'Tên sản phẩm quá dài',
        'txtNameProduct.unique' => 'Tên sản phẩm đã tồn tại',
        'txtPrice.required' => 'Giá sản phẩm không thể để trống',
        'txtPrice.integer' => 'Giá sản phẩm phải là số nguyên'  
    ];
    
    public function __construct()
    {
        
    }

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

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $validator->errors()
            ]);
        } else {
            $images = json_decode($request->images, true);
            if(count($image) > 0) {
                foreach($images as $key => $image) {
                    $img = Image::make('uploads/caches/' . $image);
                    $img->save('uploads/products/' . $image);
                    $img->destroy();
                    unlink('uploads/caches/' . $image);
                }
            }
            
        }
    }

}
