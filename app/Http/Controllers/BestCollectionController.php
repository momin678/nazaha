<?php

namespace App\Http\Controllers;

use App\Models\BestCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Input;

class BestCollectionController extends Controller
{
    
    public function best_collections(){
        $all_category = Category::all();
        $all_product = Product::all();
        $all_collections = DB::table('best_collections')->get();
        $all_product_collectoins = BestCollection::all();
        return view('backend.product.best_collections.index', compact('all_collections', 'all_product_collectoins', 'all_category', 'all_product'));
    }
    public function collection_create(Request $request){
        $collection = DB::table('best_collections')->insert([
            'title' => $request->title,
            'banner' => $request->banner,
            'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->title)).'-'.Str::random(5),
            ]);
        if($collection){
            flash(translate('Collection has been inserted successfully'))->success();
            return back();
        }
        
    }
    public function collection_edit(Request $request, $id){
        $collection = DB::table('best_collections')->find($id);
        return view('backend.product.best_collections.edit', compact('collection'));
    }
    public function collection_update(Request $request, $id){
        $collection = DB::table('best_collections')->where('id',$id)
        ->update([
            'title' =>$request->title,
            'banner' => $request->banner,
            'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->title)).'-'.Str::random(5),
            ]);
        if($collection){
            flash(translate('Collection has been update successfully'))->success();
            return back();
        }
    }
    public function collection_destroy(Request $request, $id){
        $collectoin_product_delete = BestCollection::whereIn('best_collections_id',explode(",",$id))->delete();
        if($collectoin_product_delete){
            $collection = DB::table('best_collections')->where('id', $id)->delete();
        }
        flash(translate('Collection has been deleted successfully'))->success();
        return back();
    }
    public function collection_product_update(Request $request, $id){
        BestCollection::whereIn('best_collections_id',explode(",",$id))->delete();
        $input = $request->all();
        $condition = $input['best_callection_category'];
        foreach ($condition as $key => $condition) {
            $detailorder = new BestCollection;
            $best_callection_product_id = $input['best_callection_product_id'][$key];
            if($best_callection_product_id != null){
                $product_info = Product::find($best_callection_product_id);
                $detailorder->best_callection_product_id = $product_info->id;
                $detailorder->best_callection_product_thumbnail_img = $product_info->thumbnail_img;
            }
            $detailorder->best_collections_id = $id;
            $detailorder->best_callection_name = $input['best_callection_name'][$key];
            $detailorder->best_callection_description = $input['best_callection_description'][$key];
            $detailorder->best_callection_category = $input['best_callection_category'][$key];
            $detailorder->best_callection_links = $input['best_callection_links'][$key];
            $detailorder->best_callection_banner = $input['best_callection_banner'][$key];
            $detailorder->save();
        }
    	return back();
    }
    
}
