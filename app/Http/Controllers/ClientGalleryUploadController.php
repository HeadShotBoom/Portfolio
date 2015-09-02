<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Hash;
use App\Http\Controllers\Controller;

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
}
