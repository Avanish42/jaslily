<?php

namespace App\Http\Controllers\Api;

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


    public function productByCategory($cat_id){
        //
    }
}
