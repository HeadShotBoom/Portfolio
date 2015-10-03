<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Hash;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use \Eventviva\ImageResize;

class ClientGalleryUploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function makeGallery(Request $request)
    {
        DB::table('client_galleries')->insert(['name'=> $request->name, 'password'=> bcrypt($request->password)]);
        return redirect()->back();
    }

    public function upload(Request $request){
        $path = $request->path();
        $galleryName = str_replace("%20", " ", explode('/', $path));

        $input = Input::all();

        $rules = array(
            'file' => 'image',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }



        $destinationPath = 'clientImages/' . $galleryName[1]; // upload path

        if(!file_exists("clientImages/")){
            mkdir("clientImages/", 0700);
            if(!file_exists($destinationPath)){
                mkdir($destinationPath, 0700);
            }
        }
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $originalName = Input::file('file')->getClientOriginalName();
        $alt = substr($originalName, 0, strpos($originalName, "."));
        $fileName = rand(1111111, 9999999) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        $pathAndFile = "/" . $destinationPath . "/" . $fileName;
        $thumbnailPath = "/" . $destinationPath . "/thumbs/" . $fileName;
        $thumbDir = $destinationPath . "/thumbs";
        if(!file_exists($thumbDir)){
            mkdir($thumbDir, 0700);
        }
        $image = new ImageResize($destinationPath . "/" . $fileName);
        $image->scale(50);
        $image->save($destinationPath . "/thumbs/" . $fileName);


        DB::table('client_images')->insert(['clientId' => $galleryName[0], 'imageName' => $alt, 'largePath' => $pathAndFile, 'thumbPath' => $thumbnailPath]);

    }

}


//['category' => $galleryName[1], 'path' => $pathAndFile, 'thumbnail' => $thumbnailPath, 'alt_tag' => $alt, 'width' => $size[0], 'height' => $size[1], 'main_gallery' => 0, 'position' => $nextPosition]