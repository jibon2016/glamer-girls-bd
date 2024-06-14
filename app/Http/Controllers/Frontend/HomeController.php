<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSectionImage;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Page;

class HomeController extends Controller
{
  	public function sendSMs(){
     
    }
    public function home(){
        $sliders=Slider::latest()->get();
        $brands=Type::whereNotNull('is_top')->take(12)->get();
        $cats= Category::where('is_popular', 1)->with('subcats')->get();
        $products=Product::with('variation')
        ->whereNull('products.discount_type')
        ->select('products.id','products.name','products.is_free_shipping','products.type','products.purchase_price','products.regular_price','products.sell_price','products.image','is_stock','products.category_id','products.discount_type','products.discount','products.after_discount','products.dicount_amount')
        ->latest()
        ->get();
       // dd($products);
        return view('frontend.home', compact('sliders','cats','brands','products'));
    }
    
    public function aboutUs(){
        $page=Page::where('page','about')->first();
        return view('frontend.about_us', compact('page'));
    }

    public function contactUs(){

        return view('frontend.contact_us');

    }
    
    public function privacyPolicy(){

        return view('frontend.privacy_policy');

    }
    
    public function termCondition(){
		$page=Page::where('page','term')->first();
        return view('frontend.term_and_condition', compact('page'));

    }
    
    
    public function faq(){
        return view('frontend.faq');
    }

    public function returnPolicy(){
        return view('frontend.return_policy');
    }

    public function contact(Request $request){

        $data=$request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
            'email' => '',
            'message' => 'required',
        ]);

        Contact::create($data);

        return response()->json(['success'=>true,'msg'=>'Successfully Created Your Info!']);


    }

}
