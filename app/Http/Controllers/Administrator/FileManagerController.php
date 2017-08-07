<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Unisharp\Laravelfilemanager\controllers\LfmController;
use App\Http\Controllers\Administrator\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class FileManagerController extends LfmController
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        parent::__construct();
        $this->image = $imageRepository;
    }

    public function reload() {
        return view('page_admin.product.imageupload');
    }

    public function postUpload()
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;
    }

    public function postDelete()
    {

        $filename = Input::get('id');

        if (!$filename) {
            return 0;
        }

        $response = $this->image->delete($filename);

        return $response;
    }

    public function getUploadSize()
    {
        $data = Input::get('data');

        if (!$data) {
            return 0;
        }
        
        $this->image->resizeImage($data);
    }

    public function getServerImages()
    {
        $images = Image::get(['original_name', 'filename']);

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'server' => $image->filename,
                'size' => File::size(public_path('uploads/products/' . $image->filename))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }
}
