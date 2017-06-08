<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Http\Repository\ProductRepository;
use App\Models\CategoryModel;
use App\Models\CategoryAttributeModel;
use App\Models\ProductModel;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Add New Product
     */
    public function productIndex(){
        $page = 'products';
        $sub_page = 'add-product';
        $category = CategoryModel::GetNormalCategory()->get()->toArray();
        return view('vendor.product.addproduct' ,compact('category','page','sub_page'));
    }

    /**
     * @param $id
     * @return mixed
     * Get Category Attribute By ID
     */
    public function getCategoryAttribute($id){
        $data = CategoryAttributeModel::GetAttributesById($id)->get();
        return Response::json($data);
    }

    /**
     * @param Request $req
     * @param ProductRepository $prorepo
     * @return \Illuminate\Http\RedirectResponse
     * Add New Product Into Catlog
     */
    public function productAdd(Request $req,ProductRepository $prorepo){
        if ($prorepo->addNewProduct($req->all()))
            return back()->with('returnStatus',true)->with('status' , 101)->with('message','Product Added successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * View All Products.
     */
    public function viewProducts(){
        $page = 'products';
        $sub_page = 'view-product';
        $products = ProductModel::all();
        return view('vendor.product.viewproduct' ,compact('products','page','sub_page'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * view of add Bucket Products
     */
    public function bucketProductIndex(){
        $category = CategoryModel::GetBucketCategory()->get();
        $page = 'products';
        $sub_page = 'bucket-product';
        return view('vendor.product.addbucketproduct',compact('category','page','sub_page'));
    }


    /**
     * @param Request $req
     * @param ProductRepository $prorepo
     * Add New Bucket.
     */
    public function bucketProductAdd(Request $req,ProductRepository $prorepo){
        if($prorepo->addNewBucket($req->all()))
        return back()->with('returnStatus',true)->with('status' , 101)->with('message','Bucket Product Added successfully');
    }
}
