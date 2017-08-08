<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Response;
use Validator;
use Intervention\Image\ImageManager;
use App\Image;

class ProductController extends Controller
{

    protected $rules = [
        'txtNameProduct' => 'required|max:191|unique:products,name',
        'txtPrice' => 'required|numeric',
    ];

    protected $messages = [
        'txtNameProduct.required' => 'Tên sản phẩm không được để trống',
        'txtNameProduct.max' => 'Tên sản phẩm quá dài',
        'txtNameProduct.unique' => 'Tên sản phẩm đã tồn tại',
        'txtPrice.required' => 'Giá sản phẩm không thể để trống',
        'txtPrice.numeric' => 'Giá sản phẩm phải là số'  
    ];
    
    public function index() {
        $products = Product::all();
        return View::make('page_admin.product.index', compact('products'));
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
                'validate' => false,
                'messages' => $validator->errors()
            ]);
        } else {

            $product = new Product();

            $product->cid = $request->selCate;
            $product->name = $request->txtNameProduct;
            $product->title = $request->txtNameTitle;
            $product->slug = $request->txtSlug == '' ? changeTitle($request->txtNameTitle) : changeTitle($request->txtSlug);
            $product->price = $request->txtPrice;
            $product->options = '';
            $product->description = $request->txtDesCate;
            $product->status = empty($request->checkStatus) ? 0 : 1;
            $product->isnew = empty($request->checkisNew) ? 0 : 1;

            if($product->save()) {
                $images = json_decode($request->images, true);
                foreach($images as $key => $image) {
                    $manager = new ImageManager();
                    $img = $manager->make('uploads/caches/' . $image);
                    $img->save('uploads/products/' . $image);
                    $img->destroy();
                    unlink('uploads/caches/' . $image);

                    $dbimg = new Image();
                    $dbimg->proid = $product->id;
                    $dbimg->name = $image;
                    $dbimg->isfirst = 1;
                    $dbimg->save();
                }
            } else {
                 return response()->json([
                    'status' => false,
                    'validate' => true,
                    'messages' => 'Lưu không thành công',
                ]);
            }

            return response()->json([
                'status' => true,
                'validate' => true,
                'messages' => 'Thêm thành công thành công',
            ]);
            
        }
    }

    public function viewImages($id) {
        $images = DB::table('images')
                ->where('proid', '=', $id)
                ->select('proid', 'name')
                ->get();

        return View::make('page_admin.product.view_image', compact('images', 'id'));
    }

}
