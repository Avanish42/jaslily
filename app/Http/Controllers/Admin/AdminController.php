<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repository\CrudRepository;
use App\Http\Repository\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Models\CategoryAttributeModel;
use App\Models\CategoryModel;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Show all Category
     */
    public function categoryIndex(){
        // $cateAttribute = CategoryAttributeModel::all()->toArray();
        $page = 'categories';
        $sub_page = 'add-category';
        return view('vendor.category.category',compact('page','sub_page'));
    }

    /**
     * @param Request $req
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     * Add new Category
     */
    public function categoryAdd(Request $req,CategoryRepository $repo){
        if ($repo->createNew($req->all(),new CategoryModel()))
            return back()->with('returnStatus',true)->with('status' , 101)->with('message','Category Added successfully');

    }

    public function viewCategory(){
        $page = 'categories';
        $sub_page = 'view-category';
       $category = CategoryModel::all()->toArray();
     return view('vendor.category.viewcategory',compact('category','page','sub_page'));
    }




}
