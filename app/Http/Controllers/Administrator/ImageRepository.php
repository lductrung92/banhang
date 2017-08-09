<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;


class ImageRepository
{
    public function upload( $form_data )
    {
        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename, $extension );

        $uploadSuccess1 = $this->original( $photo, $allowed_filename );

        //$uploadSuccess2 = $this->icon( $photo, $allowed_filename );

        if( !$uploadSuccess1 ) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }

        // $sessionImage = new Image;
        // $sessionImage->filename      = $allowed_filename;
        // $sessionImage->original_name = $originalName;
        // $sessionImage->save();

        

        return Response::json([
            'error' => false,
            'code'  => 200,
            'filename' => $allowed_filename,
        ], 200);

    }

    public function createUniqueFilename( $filename, $extension )
    {
        $full_size_dir = Config::get('images.full_size'). 'uploads/caches/';
        $full_image_path = $full_size_dir . $filename . '.' . $extension;

        $imageToken = substr(sha1(mt_rand()), 0, 7);
        $img = $filename . '-' . $imageToken . '.' . $extension;

        if ( File::exists( $full_size_dir . $img ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 7);
            $img = $filename . '-' . $imageToken . '.' . $extension;
        }

        return $img;
    }

    /**
     * Optimize Original Image
     */
    public function original( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->save(Config::get('images.full_size') . 'uploads/caches/' . $filename );

        return $image;
    }

    /**
     * Create Icon From Original
     */
    // public function icon( $photo, $filename )
    // {
    //     $manager = new ImageManager();
    //     $image = $manager->make( $photo )->resize(200, null, function ($constraint) {
    //         $constraint->aspectRatio();
    //     })
    //         ->save( Config::get('images.icon_size') . 'uploads/products/thumbnail/'  . $filename );

    //     return $image;
    // }

    public function resizeImage($data){
        $manager = new ImageManager();
        foreach(json_decode($data) as $key => $value){
            $path_parts = pathinfo($value->name);
            
           //dd(getimagesize($value->name)[2]);
            // echo $path_parts['basename'];
            // echo $path_parts['extension'];

            $image_p = imagecreatetruecolor($value->w, $value->h);
            $aSize = getimagesize($value->name)[2];
            switch ($aSize) {
                case IMAGETYPE_JPEG:
                    $image = @imagecreatefromjpeg($value->name);
                    break;
                case IMAGETYPE_PNG:
                    $image = @imagecreatefrompng($value->name);
                    break;
                default:
                    $image = @imagecreatefromjpeg($value->name);
                    break;
            }
            @imagecopyresampled($image_p, $image, 0, 0, $value->x, $value->y, $value->w, $value->h, $value->w, $value->h);
            imagejpeg($image_p, $value->name, 90);
            // unlink('uploads/products/thumbnail/' . $path_parts['basename']);
            // $img = $manager->make( 'uploads/products/'  . $path_parts['basename'] )->resize(200, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save('uploads/products/thumbnail/'  . $path_parts['basename'], 90);
            
            if($path_parts['dirname'] === 'uploads/products') {
                $img = $manager->make( 'uploads/products/'  . $path_parts['basename'] )->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img = $manager->make( 'uploads/caches/'  . $path_parts['basename'] )->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            
            return $img;
        }
    }

    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete( $originalFilename)
    {

        $full_size_dir = Config::get('images.full_size'). 'uploads/products/';
        $icon_size_dir = Config::get('images.icon_size'). 'uploads/products/thumbnail/';

        $sessionImage = Image::where('original_name', 'like', $originalFilename)->first();

        if(empty($sessionImage))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }

        $full_path1 = $full_size_dir . $sessionImage->filename;
        $full_path2 = $icon_size_dir . $sessionImage->filename;

        if ( File::exists( $full_path1 ) )
        {
            File::delete( $full_path1 );
        }

        if ( File::exists( $full_path2 ) )
        {
            File::delete( $full_path2 );
        }

        if( !empty($sessionImage))
        {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}
