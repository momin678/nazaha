<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\FlashDeal;
use App\Models\BestCollection;
use DB;
use Illuminate\Support\Facades\Log;
class AjaxController extends Controller
{
   
    public function top_categories_request(Request $request){
        $data = $request->get('id');
        if($data){
            return view('frontend.partials.top_categories' );
        }
    }
    public function best_collection_request(Request $request){
        $section = DB::table('best_collections')->get();
        $all_categoty = Category::all();
        $data = $request->get('id');
        if($data){
            return view('frontend.partials.best_collection_product', compact('section', 'all_categoty') );
        }
    }
    public function product_suggest_request(Request $request){
        $product_suggest = DB::table('products')->select('id', 'name', 'thumbnail_img', 'slug', 'rating', 'unit_price', 'purchase_price')->inRandomOrder()->limit(18)->get();
        $data = $request->get('id');
        if($data){
            return view('frontend.partials.product_suggest', compact('product_suggest') );
        }
    }
    public function more_product_suggest_request(Request $request){
        $data = $request->get('id');
        if($data){
            $more_product_suggest_request = Product::inRandomOrder()->limit(12)->get();
            return \view('frontend.partials.more_product_suggest_request', compact('more_product_suggest_request'));   
        }else{
            return "No more product";
        }
    }
    public function top_brand_request(Request $request){
        $data = $request->get('id');
        if($data){
            return view('frontend.partials.top_brand');
        }
    }
    public function footer_load_request(Request $request){
        $data = $request->get('id');
        if($data){
            return view('frontend.inc.footer');
        }
    }
    
    
    
    
    
    
    
    
}