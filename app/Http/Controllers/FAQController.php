<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Faq;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowFAQEdit()
    {
        $faqs = Faq::all();
        $category = DB::table('faq_cat')->orderBy('category')->get();
        return view('faqedit', compact('faqs', 'category'));
    }
    public function create(Faq $faq, Request $request)
    {
        $set = new Faq;
        $set->category = $request->category;
        $set->question = $request->question;
        $set->answer = $request->answer;
        $set->save();
        return redirect()->back();
    }

    public function addCat(Request $request)
    {
        DB::table('faq_cat')->insert(array('category' => $request->add_cat));
        return redirect()->back();
    }

    public function editFaq(Request $request)
    {
        DB::table('faqs')->where('id', $request->id)->update(['category' => $request->category, 'question' => $request->question, 'answer' => $request->answer]);
        return redirect()->back();
    }

    public function deleteFaq(Request $request)
    {
        DB::table('faqs')->where('id', $request->id)->delete();
        return redirect()->back();
    }

    public function editCat(Request $request)
    {
        DB::table('faq_cat')->where('id', $request->id)->update(['category' => $request->category]);
        return redirect()->back();
    }

    public function deleteCat(Request $request)
    {
        DB::table('faq_cat')->where('id', $request->id)->delete();
        return redirect()->back();
    }
}
