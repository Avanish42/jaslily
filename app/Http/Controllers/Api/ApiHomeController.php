<?php

namespace App\Http\Controllers\Api;

use App\Models\BucketProductModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Models\CategoryModel;

class ApiHomeController extends Controller
{

    public function allCategories(){

        $datacategory = CategoryModel::all();
        return Response::json($datacategory);
    }


    public function productByCategory(Request $request){
        $buk_id = $request->input('bucket_cat');
        $cat_id = $request->input('cat_id');
        if($buk_id != null){
            $buc_pro = BucketProductModel::BuckProByCategory($cat_id)->get();
            $products = [];
               foreach ($buc_pro as $key_bukpro => $value_bukpro){
                   $pushitm = $value_bukpro->toArray();
                   // dd($pushitm);
                   $pushitm['related_items'] = $value_bukpro->relatedProducts()->get()->toArray();
                array_push($products,$pushitm);
                }
        }
        else{
            $products = ProductModel::ProductsByCategory($cat_id)->get();
        }

        return Response::json($products);
    }
}
