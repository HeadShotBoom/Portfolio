<?php

namespace App\Http\Controllers;
use DB;
use Request;
use App\Faq;
use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use Session;
use Redirect;
use Auth;
use URL;
use Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $portfolioImages = DB::table('images')->where('home_page', 1)->get();
        $projectImages = DB::table('project_images')->where('home_page', 1)->get();
        $allHomeImages = array_merge($portfolioImages, $projectImages);
        if(shuffle($allHomeImages)){
            $allHomeImages = $allHomeImages;
        }
        return view('home', compact('allHomeImages'));
    }

    public function showGallery(Request $request)
    {
        $path = explode('/', Request::path());
        $galleryName = str_replace("%20", " ", $path[1]);

        $images = DB::table('images')->where('category', $galleryName)->get();
        $title = $galleryName;
        if(Auth::check()){
            return redirect('/Portfolio/'.$galleryName.'/edit');
        }
        return view('gallery', compact('images', 'title'));
    }

    public function ShowProjects()
    {
        $path = explode('/', Request::path());
        $galleryName = str_replace("%20", " ", $path[1]);
        $images = DB::table('project_images')->where('category', $galleryName)->get();
        $title = $galleryName;
        if(Auth::check()){
            return redirect('/Projects/'.$galleryName.'/edit');
        }
        return view('projects', compact('images', 'title'));
    }

    public function ShowAllProjects()
    {
        $images = DB::table('project_images')->where('main_gallery', 1)->get();
        if(Auth::check()){
            return redirect('/MyProjects/edit');
        }
        return view('main_projects', compact('images'));    }

    public function ShowAllPortfolio()
    {
        $images = DB::table('images')->where('main_gallery', 1)->get();
        if(Auth::check()){
            return redirect('/MyPortfolio/edit');
        }
        return view('main_gallery', compact('images'));
    }


    public function ShowMotion()
    {
        $links = DB::table('motion_links')->get();
        if(Auth::check()){
            return redirect('/Motion/edit');
        }
        return view('motion', compact('links'));
    }
    public function ShowClientLinks()
    {
        $links = DB::table('client_galleries')->orderBy('name')->get();
        return view('client_links', compact('links'));
    }

    public function ShowContactMe()
    {
        return view('contact');
    }
    public function ShowFAQ()
    {
        $faqs = Faq::all();
        $category = DB::table('faq_cat')->orderBy('category')->get();
        if(Auth::check()){
            return redirect('/FAQ/edit');
        }
        return view('faq', compact('faqs', 'category'));
    }
    public function contact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'message' => 'required',
        ]);

        $data = $request->all();

        Mail::send('emails.contact', ['data' => $data], function($message) use ($data){
            $message->to('headshotboom@live.com', 'Daniel Carroll')->subject('Someone Contacted you through your site');
        });

        Mail::send('emails.contact_reply', ['data' => $data], function($message) use ($data){
            $message->to($data['email'], $data['name'])->subject('Thank You for contacting us.');
        });

        return redirect('/Contact')->with('status', 'Your message has been sent!');
    }

    public function ServiceRequest(Request $request)
    {
        return view('service_request');
    }

    public function SendServiceRequest(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'address' => 'required',
            'eventDate' => 'required',
            'rushDate' => 'required_with:rush'
        ]);

        $data = $request->all();

        Mail::send('emails.serviceRequest', ['data' => $data], function($message) use ($data){
            $message->to('headshotboom@live.com', 'Daniel Carroll')->subject('Youve Received A Service Request');
        });
    }

    public function clientLogin(Request $request)
    {
        $url = Request::path();
        $galleryName = ltrim(strstr($url, '/'), '/');
        $shortGalleryName = urldecode(substr($galleryName, 0, strpos($galleryName, "/")));
        $groupCheck = DB::table('client_galleries')->where('name', $shortGalleryName)->pluck('type');
        if($groupCheck === 'group'){
            Session::put('galleryAccess', $shortGalleryName);
            return redirect('/ClientGallery/'.$shortGalleryName);
        }
        if(Auth::check()){
            $firstTrim = urldecode(ltrim($url, 'Client/'));
            $adminGallery = substr($firstTrim, 0, strpos($firstTrim, "/"));
            $adminRedirect = '/ClientGallery/'.$adminGallery;
            return redirect($adminRedirect);
        }elseif(Session::has('galleryAccess')){
            $firstTrim1 = urldecode(ltrim($url, 'Client/'));
            $intendedGallery = substr($firstTrim1, 0, strpos($firstTrim1, "/"));
            if(Session::get('galleryAccess') === $intendedGallery){
                $hereBeforeString = '/ClientGallery/'.$intendedGallery;
                return redirect($hereBeforeString);
            }else{
                return view('clientLogin', compact('galleryName'));
            }
        }
        return view('clientLogin', compact('galleryName'));
    }

    public function clientLoginAttempt(Request $request)
    {
        $data = Request::all();
        $galleryName = substr(str_replace('%20', ' ', $data['galleryName']), 0, strpos(str_replace('%20', ' ', $data['galleryName']), "/"));
        $password = $data['password'];
        $hashedPassword = DB::table('client_galleries')->select('password')->where('name', $galleryName)->pluck('password');
        if(Hash::check($password, $hashedPassword))
        {
            Session::put('galleryAccess', $galleryName);
            $redirectString = '/ClientGallery/'.$galleryName;
            return redirect($redirectString);
        }
        else{
            Session::flash('message', "That Password is not Correct");
            return Redirect::back();
        }
    }

    public function showClientGallery(Request $request){
        $url = Request::path();
        $galleryName = urldecode(ltrim(strstr($url, '/'), '/'));
        $relevantImages = DB::table('client_images')->where('clientId', $galleryName)->get();
        $groupOrNot = DB::table('client_galleries')->where('name', $galleryName)->pluck('type');
        if(Auth::check()){
            return view('clientGallery', compact('relevantImages', 'galleryName', 'groupOrNot'));
        }elseif(Session::has('galleryAccess')){
            if(Session::get('galleryAccess') === $galleryName) {
                return view('clientGallery', compact('relevantImages', 'galleryName', 'groupOrNot'));
            }else{
                return view('clientLogin', compact('galleryName'));
            }
        }else{
            return view('clientLogin', compact('galleryName'));
        }

    }

    public function pickThis(Request $request){
        $idNum = filter_var(Request::path(),  FILTER_SANITIZE_NUMBER_INT);
        $id = '#'.$idNum;
        DB::table('client_images')->where('id', $idNum)->update(['chosenImage' => 1]);
        $backLink = URL::previous().$id;
        return redirect($backLink);
    }

    public function unPickThis(Request $request){
        $idNum = filter_var(Request::path(),  FILTER_SANITIZE_NUMBER_INT);
        $id = '#'.$idNum;
        DB::table('client_images')->where('id', $idNum)->update(['chosenImage' => 0]);
        $backLink = URL::previous().$id;
        return redirect($backLink);
    }

    public function clientOrderProcessor(Request $request)
    {
        $whichClient = substr(Request::path(), strpos(Request::path(), '/')+1);
        $selectedImages = DB::table('client_images')->where('clientId', $whichClient)->where('chosenImage', 1)->get();
        $imageNames = [];
        foreach($selectedImages as $dasPics){
            $imageNames[$dasPics->id] = $dasPics->imageName;
        }
        Mail::send('emails.order', ['whichClient' => $whichClient, 'imageNames' => $imageNames], function($message) use ($whichClient, $imageNames){
            $message->to('headshotboom@live.com', 'Daniel Carroll')->subject('A client placed an order.');
        });


    }

    public function groupOrderProcessor(Request $request)
    {
        $individualInfo = Request::all();
        $whichGallery = Request::input('galleryName');
        $selectedImages = DB::table('client_images')->where('clientId', $whichGallery)->where('chosenImage', 1)->get();
        $imageNames = [];
        foreach($selectedImages as $dasPics){
            $imageNames[$dasPics->id] = $dasPics->imageName;
        }
        Mail::send('emails.groupOrder', ['whichClient' => $whichGallery, 'imageNames' => $imageNames, 'individualInfo' => $individualInfo], function($message) use ($whichGallery, $imageNames, $individualInfo){
            $message->to('headshotboom@live.com', 'Daniel Carroll')->subject('A client placed an order.');
        });


    }

}
