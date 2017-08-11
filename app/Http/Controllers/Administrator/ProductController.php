<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use App\Category;
use App\Product;
use App\Warehouse;
use Illuminate\Support\Facades\Response;
use Validator;
use Intervention\Image\ImageManager;
use App\Image;
use Session;
use File;

class ProductController extends Controller
{

    /** validator */
    protected $rules = [
        'txtNameProduct' => 'required|max:191|unique:products,name',
        'txtTotal' => 'required|integer',
        'selCate' => 'required',
        'txtPrice' => 'required|numeric',
    ];

    protected $messages = [
        'txtNameProduct.required' => 'Tên sản phẩm không được để trống',
        'txtNameProduct.max' => 'Tên sản phẩm quá dài',
        'selCate.required' => 'Chưa chọn danh mục sản phẩm',
        'txtTotal.required' => 'Số lượng sản phẩm nhập kho không được trống',
        'txtTotal.integer' => 'Số lượng sản phẩm nhập kho phải là số nguyên',
        'txtExport.integer' => 'Số lượng sản phẩm xuất kho phải là số nguyên',
        'txtNameProduct.unique' => 'Tên sản phẩm đã tồn tại',
        'txtPrice.required' => 'Giá sản phẩm không thể để trống',
        'txtPrice.numeric' => 'Giá sản phẩm phải là số'  
    ];
    
    /** return danh sách sản phẩm */
    public function index() {
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
        return View::make('page_admin.product.index', compact('cateops'));
    }

    /** get all product - datatable server side */
    public function allproducts(Request $request) {
        
        $columns = array( 
            0 =>'name', 
            1 =>'title',
            2 => 'slug',
            3 => 'price',
            4 => 'status',
            5 => 'total',
            6 => 'exist',
            7 => 'images',
            8 => 'options'
        );
        $totalData = Product::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $catekey = $request->input('search.category');
        $exist = $request->input('search.winfo');
        $statuskey = $request->input('search.status');

        if(empty($request->input('search.value')))
        {            

            $products = DB::table('products')
                        ->join('warehouses', 'warehouses.proid', '=', 'products.id')
                        ->when($catekey , function ($query) use ($catekey) {
                            return $query->where('cid', '=', $catekey);
                        })
                        ->when($exist , function ($query) use ($exist) {
                             if($exist == 1)
                                return $query->where('warehouses.exist', '>', 0);
                            else
                                return $query->where('warehouses.exist', 0);
                        })
                        ->when($statuskey , function ($query) use ($statuskey) {
                            if($statuskey == 1)
                                return $query->where('status', 1);
                            else
                                return $query->where('status', 0);
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->select('products.*', 'warehouses.total', 'warehouses.exist')
                        ->orderBy($order,$dir)
                        ->get();
            $totalFiltered = count($products);
        }
        else {
            $search = $request->input('search.value'); 

            $products = DB::table('products')
                        ->join('warehouses', 'warehouses.proid', '=', 'products.id')
                        ->when($catekey , function ($query) use ($catekey) {
                            return $query->where('cid', '=', $catekey);
                        })
                        ->when($exist , function ($query) use ($exist) {
                             if($exist == 1)
                                return $query->where('warehouses.exist', '>', 0);
                            else
                                return $query->where('warehouses.exist', 0);
                        })
                        ->when($statuskey , function ($query) use ($statuskey) {
                            if($statuskey == 1)
                                return $query->where('status', 1);
                            else
                                return $query->where('status', 0);
                        })
                        ->where('name', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->select('products.*', 'warehouses.total', 'warehouses.exist')
                        ->orderBy($order,$dir)
                        ->get();
            $totalFiltered = count($products);
        }
        

        $data = array();

        if(!empty($products))
        {
            foreach ($products as $product)
            {
                $update =  route('getUpdateProduct', $product->id);
                $delete =  route('getDeleteProduct', $product->id);

                $nestedData['name'] = $product->name;
                $nestedData['title'] = $product->title;
                $nestedData['price'] = $product->price;
                $nestedData['status'] = $product->status === 1 ? 'Hiển thị' : 'Không hiển thị';
                $nestedData['total'] = $product->total;
                $nestedData['export'] = $product->total - $product->exist;
                $nestedData['images'] = "<div id='viewImages-{$product->id}'><a href='javascript:;' onclick='viewImages({$product->id})'> Xem ảnh</a></div>";
                $nestedData['options'] = "<div align='center'>
                <a style='font-size: 7px; padding: 5px 6px;' href='{$update}' class='btn btn-primary btn-xs' ><span style='font-size: 10px;' class='glyphicon glyphicon-pencil'></span></a>
                <a style='font-size: 7px; padding: 5px 6px;' href='{$delete}' class='btn btn-danger btn-xs'><span style='font-size: 10px;' class='glyphicon glyphicon-trash'></span></a>
                </div>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
       
        echo json_encode($json_data); 
  
    }


    /** return view, hiển thị form insert sản phẩm */
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

    /** ajax thêm mới sản phẩm */
    public function insert(Request $request) {
        if(Session::has('locale')) {
            if(Session::get('locale') !== 'vn') {
                $validator = Validator::make($request->all(), $this->rules);
            } else {
                $validator = Validator::make($request->all(), $this->rules, $this->messages);
            }
        } else {
            $validator = Validator::make($request->all(), $this->rules, $this->messages);
        }
        
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
                $wh = new Warehouse();
                $wh->proid = $product->id;
                $wh->total = $request->txtTotal;
                $wh->save();
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
                'messages' => 'Thêm thành công',
            ]);
            
        }
    }

    /** ajax hiển thị ảnh sản phẩm */
    public function viewImages($id) {
        $images = DB::table('images')
                ->where('proid', '=', $id)
                ->select('proid', 'name')
                ->get();

        return View::make('page_admin.product.view_image', compact('images', 'id'));
    }

    /** return view, hiển thị form cập nhât sản phẩm */
    public function showFormUpdate($id) {
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

        $product = Product::find($id);

        return View::make('page_admin.product.update', compact('cateops', 'product'));
    }

    public function viewUpdateImages($id) {
        $images = DB::table('images')
                ->where('proid', '=', $id)
                ->select('name')->get();

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'name' => $image->name,
                'size' => File::size(public_path('uploads/products/' . $image->name))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }

    /** ajax cập nhật sản phẩm */
    public function update(Request $request, $id) {

        $this->rules = [
            'txtNameProduct' => 'required|max:191|unique:products,name,' . $id,
            'selCate' => 'required',
            'txtTotal' => 'nullable|integer', //required_if:txtTotal,
            'txtExport' => 'nullable|integer',
            'txtPrice' => 'required|numeric',
        ];

        if(Session::has('locale')) {
            if(Session::get('locale') !== 'vn') {
                $validator = Validator::make($request->all(), $this->rules);
            } else {
                $validator = Validator::make($request->all(), $this->rules, $this->messages);
            }
        } else {
            $validator = Validator::make($request->all(), $this->rules, $this->messages);
        }
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'validate' => false,
                'messages' => $validator->errors()
            ]);
        } else {

            $product = Product::find($id);

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
                /** Cập nhật ảnh đã có sẵn */
                $images = json_decode($request->serimages, true);
                $dbimgs = DB::table('images')
                            ->where('proid', '=', $id)
                            ->select('name', 'id')
                            ->get();
                foreach($dbimgs as $dbimg) {
                    $t = false;
                    foreach($images as $key => $image) {
                        if($dbimg->name === $image){
                            $t = true;
                            break;
                        }   
                    }
                    if(!$t) {
                        $delimg = Image::find($dbimg->id);
                        $delimg->delete();
                        unlink('uploads/products/' . $dbimg->name);
                    }
                }

                /** thêm mới ảnh chưa có */
                $images = json_decode($request->images, true);
                foreach($images as $key => $image) {
                    $manager = new ImageManager();
                    $img = $manager->make('uploads/caches/' . $image);
                    $img->save('uploads/products/' . $image);
                    $img->destroy();
                    unlink('uploads/caches/' . $image);

                    $ima = new Image();
                    $ima->proid = $id;
                    $ima->name = $image;
                    $ima->isfirst = 1;
                    $ima->save();
                }

                $wh = Warehouse::where('proid', '=', $id)->first();
                $wh->total = $wh->total + $request->txtTotal;
                $wh->exist = $wh->exist + $request->txtTotal - $request->txtExport;
                $wh->save();

            } else {
                 return response()->json([
                    'status' => false,
                    'validate' => true,
                    'messages' => 'Cập nhật không thành công',
                ]);
            }

            return response()->json([
                'status' => true,
                'validate' => true,
                'messages' => 'Cập nhật thành công',
            ]);
            
        }
    }

    public function delete($id) {
        $product = Product::find($id);
        if(count($product) > 0) {
            $list_images = DB::table('images')
                ->where('proid', '=', $id)
                ->select('name')->get();

            foreach($list_images as $image) {
                unlink('uploads/products/' . $image->name);
            }
            DB::table('warehouses')->where('proid', '=', $id)->delete();

            $product->delete();
            return back()->with('messages', 'Xóa thành công');
        }
       
        return back()->with('messages', 'Không tìm thấy sản phẩm cần xóa');
    }

}
