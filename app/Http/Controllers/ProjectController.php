<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Illuminate\Http\Request;
use Response;
use DB;
use \Eventviva\ImageResize;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowGalleryEdit(Request $request)
    {
        $path = $request->path();
        $galleryName = str_replace("%20", " ", explode('/', $path));
        $images = DB::table('project_images')->where('category', $galleryName[1])->orderBy('position')->get();
        $last = DB::table('project_images')->where('category', $galleryName[1])->max('position');
        $title = ucfirst($galleryName[1]);
        return view('projects_edit', compact('images', 'title', 'last'));
    }

    public function upload(Request $request)
    {
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



        $destinationPath = 'ProjectImages/' . $galleryName[1]; // upload path

        if(!file_exists("ProjectImages/")){
            mkdir("ProjectImages/", 0700);
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
        $size = getimagesize(ltrim($pathAndFile, '/'));

        $lastPosition = DB::table('project_images')->where('category', $galleryName[1])->max('position');
        if($lastPosition == null){
            $lastPosition=0;
        }
        $nextPosition = $lastPosition+1;


        DB::table('project_images')->insert(['category' => $galleryName[1], 'path' => $pathAndFile, 'thumbnail' => $thumbnailPath, 'alt_tag' => $alt, 'width' => $size[0], 'height' => $size[1], 'main_gallery' => 0, 'position' => $nextPosition]);

    }

    public function delete(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        $file = DB::table('project_images')->where('id', $id)->first();
        $largePath = substr($file->path, 1);
        $thumbPath = substr($file->thumbnail, 1);

        $position = DB::table('project_images')->where('id', $id)->pluck('position');
        $category = DB::table('project_images')->where('id', $id)->pluck('category');
        $last = DB::table('project_images')->where('category', $category)->max('position');

        for($i=$position; $i<$last; $i++){
            $nextPosition = $position+1;
            DB::table('project_images')->where('category', $category)->where('position', $nextPosition)->update(['position'=>$position]);
            $position++;
        }

        if(file_exists($largePath)){
            unlink($largePath);
        }
        if(file_exists($thumbPath)){
            unlink($thumbPath);
        }

        DB::table('project_images')->where('id', $id)->delete();

        return redirect()->back();

    }

    public function showGalleryNames()
    {
        $names = DB::table('project_name')->orderBy('position')->get();
        $last = DB::table('project_name')->max('position');
        return view('editProjectNames', compact('names', 'last'));
    }

    public function addGalleryName(Request $request)
    {
        $positionList = DB::table('project_name')->get();
        if(count($positionList) == 0){
            $position = 1;
        }else{
            $position = DB::table('project_name')->max('position') + 1;
        }
        DB::table('project_name')->insert(['gallery' => $request->gallery, 'position' => $position]);
        return redirect('/Projects/'.$request->gallery.'/edit');
    }

    public function editGalleryNames(Request $request)
    {
        $oldGallery = DB::table('project_name')->where('id', $request->id)->first();

        $largePath = DB::table('project_images')->where('category', $oldGallery->gallery)->get();
        $thumbnailPath = DB::table('project_images')->where('category', $oldGallery->gallery)->get();
        if($largePath != null){
            if(!file_exists("ProjectImages/".$request->gallery)) {
                mkdir("ProjectImages/".$request->gallery, 0700);
                mkdir("ProjectImages/".$request->gallery."/thumbs/", 0700);
            }

            foreach($thumbnailPath as $thumbP){
                rename(ltrim($thumbP->thumbnail, '/'), ltrim(str_replace($oldGallery->gallery, $request->gallery, $thumbP->thumbnail), '/'));
                DB::table('project_images')->where('id', $thumbP->id)->update(['thumbnail' => str_replace($oldGallery->gallery, $request->gallery, $thumbP->thumbnail)]);
            }
            rmdir(substr(ltrim($thumbnailPath[0]->thumbnail, '/'), 0, strrpos( ltrim($thumbnailPath[0]->thumbnail, '/'), '/')));
            foreach($largePath as $largeP){
                rename(ltrim($largeP->path, '/'), ltrim(str_replace($oldGallery->gallery, $request->gallery, $largeP->path), '/'));
                DB::table('project_images')->where('id', $largeP->id)->update(['path' => str_replace($oldGallery->gallery, $request->gallery, $largeP->path)]);
            }
            rmdir(substr(ltrim($largePath[0]->path, '/'), 0, strrpos( ltrim($largePath[0]->path, '/'), '/')));
        }
        DB::table('project_images')->where('category', $oldGallery->gallery)->update(['category' => $request->gallery]);
        DB::table('project_name')->where('id', $request->id)->update(['gallery' => $request->gallery]);
        return redirect()->back();
    }

    public function editGalleryPosition(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        $direction = trim(substr($request->path(), strrpos($request->path(), '/') + 1));
        $currentPosition = DB::table('project_name')->where('id', $id)->pluck('position');
        if($direction === 'up'){
            $newPosition = $currentPosition - 1;
            DB::table('project_name')->where('position', $newPosition)->update(['position' => $currentPosition]);
            DB::table('project_name')->where('id', $id)->update(['position' => $newPosition]);
            return redirect()->back();
        }elseif($direction === 'down'){
            $newPosition = $currentPosition + 1;
            DB::table('project_name')->where('position', $newPosition)->update(['position' => $currentPosition]);
            DB::table('project_name')->where('id', $id)->update(['position' => $newPosition]);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function deleteGallery(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        $galleryName = DB::table('project_name')->where('id', $id)->pluck('gallery');
        $filesToDelete = DB::table('project_images')->where('category', $galleryName)->get();

        foreach($filesToDelete as $file){
            if(file_exists(ltrim($file->thumbnail, '/'))){
                unlink(ltrim($file->thumbnail, '/'));
            }
            if(file_exists(ltrim($file->path, '/'))){
                unlink(ltrim($file->path, '/'));
            }
        }
        if(!empty($filesToDelete)) {
            $folders = explode('/', $filesToDelete[0]->path);
            rmdir($folders[1] . '/' . $folders[2] . '/thumbs/');
            rmdir($folders[1] . '/' . $folders[2] . '/');
        }
        DB::table('project_name')->where('id', $id)->delete();
        DB::table('project_images')->where('category', $galleryName)->delete();
        return redirect()->back();
    }

    public function AddMainProjectGal(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        DB::table('project_images')->where('id', $id)->update(['main_gallery' => 1]);
        return redirect()->back();
    }

    public function RemoveMainProjectGal(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        DB::table('project_images')->where('id', $id)->update(['main_gallery' => 0]);
        return redirect()->back();
    }
    public function AddHomePageGal(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        DB::table('project_images')->where('id', $id)->update(['home_page' => 1]);
        return redirect()->back();
    }

    public function RemHomePageGal(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        DB::table('project_images')->where('id', $id)->update(['home_page' => 0]);
        return redirect()->back();
    }

    public function moveImageUp(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        $currentImg = DB::table('project_images')->where('id', $id)->get();
        $currentPos = $currentImg[0]->position;
        $newPos = $currentPos-1;
        $category = $currentImg[0]->category;
        DB::table('project_images')->where('category', $category)->where('position', $newPos)->update(['position' => $currentPos]);
        DB::table('project_images')->where('id', $id)->update(['position' => $newPos]);
        return redirect()->back();
    }

    public function moveImageDown(Request $request)
    {

        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        $currentImg = DB::table('project_images')->where('id', $id)->get();
        $currentPos = $currentImg[0]->position;
        $newPos = $currentPos+1;
        $category = $currentImg[0]->category;
        DB::table('project_images')->where('category', $category)->where('position', $newPos)->update(['position' => $currentPos]);
        DB::table('project_images')->where('id', $id)->update(['position' => $newPos]);
        return redirect()->back();
    }

}
