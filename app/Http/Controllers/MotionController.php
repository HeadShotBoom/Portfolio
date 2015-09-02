<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Illuminate\Http\Request;
use Response;
use DB;

class MotionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $links = DB::table('motion_links')->orderBy('position')->get();
        $last = DB::table('motion_links')->max('position');
        return view('motion_edit', compact('links', 'last'));
    }

   public function addiframe(Request $request)
   {
       $input = $request->link;
       $linkCheck = substr($input, 0, count($input)+4);

       $lastPosition = DB::table('motion_links')->max('position');
       if($lastPosition == null){
           $lastPosition=0;
       }
       $nextPosition = $lastPosition+1;

       if($linkCheck != 'http:' && $linkCheck != 'https'){
           $first_half = ltrim(strstr($input, 'src='), 'src="');
           $output = substr($first_half, 0, strpos($first_half, ' ')-1);
           DB::table('motion_links')->insert(['link' => $output, 'description' => $request->description, 'position' => $nextPosition]);
       }elseif($linkCheck == 'http:' || $linkCheck == 'https'){
           DB::table('motion_links')->insert(['link' => $input, 'description' => $request->description, 'position' => $nextPosition]);
       }

       return redirect()->back();
   }

    public function delete(Request $request)
    {
        $link = explode('/', $request->path());
        $id = $link[2];
        $position = DB::table('motion_links')->where('id', $id)->pluck('position');
        $last = DB::table('motion_links')->max('position');

        for($i=$position; $i<$last; $i++){
            DB::table('motion_links')->where('position', $position+1)->update(['position'=>$position]);
            $position++;
        }

        DB::table('motion_links')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function moveVideoUp(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        $currentImg = DB::table('motion_links')->where('id', $id)->get();
        $currentPos = $currentImg[0]->position;
        $newPos = $currentPos-1;
        DB::table('motion_links')->where('position', $newPos)->update(['position' => $currentPos]);
        DB::table('motion_links')->where('id', $id)->update(['position' => $newPos]);
        return redirect()->back();
    }

    public function moveVideoDown(Request $request)
    {
        $id = filter_var(str_replace('%20', ' ', $request->path()), FILTER_SANITIZE_NUMBER_INT);
        $currentImg = DB::table('motion_links')->where('id', $id)->get();
        $currentPos = $currentImg[0]->position;
        $newPos = $currentPos+1;
        DB::table('motion_links')->where('position', $newPos)->update(['position' => $currentPos]);
        DB::table('motion_links')->where('id', $id)->update(['position' => $newPos]);
        return redirect()->back();
    }

}
