<?php
namespace App\Http\Repository;


use App\Models\BucketProductModel;
use App\Models\BucketRelatedItemsModel;
use Carbon\Carbon;
use App\Models\ProductModel;

class ProductRepository{

    public function addNewProduct($data =[]){

        try {

            if (isset($data['without_attribute'])) {

                $insertArray = [
                    'cat_id' => $data['category_name'],
                    'attribute_id' => null,
                    'product_name' => $data['product_name'],
                    'product_price' => $data['procuctprice'],
                    'product_description' => $data['procuctdescription'],
                    'created_at' => \Carbon\Carbon::now()
                ];

                $insert = ProductModel::insert($insertArray);

            } else {
                $pro_name = $data['product_name'];
                $category_id = $data['category_name'];
                unset($data['product_name']);
                unset($data['category_name']);
                unset($data['_token']);
                $insertArraydif = [];

                foreach ($data['attribute_name'] as $keydata => $valuedata) {

                    $insertArraydif = [
                        'cat_id' => $category_id,
                        'attribute_id' => $data['attribute_id'][$keydata],
                        'attribute_name' => $data['attribute_name'][$keydata],
                        'product_name' => $pro_name,
                        'product_price' => $data['procuctpriceattr'][$keydata],
                        'product_description' => $data['procuctdescription'][$keydata],
                        'created_at' => Carbon::now()
                    ];

                    $insert = ProductModel::insert($insertArraydif);
                }

            }
        }

        catch (\Exception $exception){
            return ['code' => 503, 'message' => $exception->getMessage()];
        }
        return true;
    }


    public function addNewBucket($data = []){
        try {
                $buck_name = $data['bucket_name'];
                $cat_id = $data['cat_id'];
                $bucket_price = $data['bucket_price'];
                $bucket_description = $data['bucket_description'];
                   unset($data['bucket_name']);
                   unset($data['cat_id']);
                   unset($data['bucket_description']);
                   unset($data['bucket_price']);
                 // dd($data);
                   $buck_pro = [
                       'bucket_name'=>$buck_name,
                       'cat_id'=>$cat_id,
                       'bucket_price'=>$bucket_price,
                       'bucket_description'=>$bucket_description,
                       'created_at' =>  \Carbon\Carbon::now()
                   ];

                   $buck_pro_id = BucketProductModel::insertGetId($buck_pro);

                   foreach ($data['optional_item_name'] as $keyitm => $valueitm){
                      $itm_nam = $data['item_name'][$keyitm];
                          $itm_qty = $data['item_qty'][$keyitm];
                          foreach ($valueitm as $ketopt_itm => $valueopt_itm){


                             $insertArray = [
                                  'buk_id'=>$buck_pro_id,
                                  'item_name'=>$itm_nam,
                                  'item_qty'=>$itm_qty,
                                  'optional_item_name'=>$valueopt_itm,
                                  'optional_item_price'=>$data['optional_item_price'][$keyitm][$ketopt_itm],
                                  'created_at'=> \Carbon\Carbon::now()
                              ];


                             $insert = BucketRelatedItemsModel::insert($insertArray);


                          }
                   }


        }

        catch (\Exception $exception){
            return ['code' => 503, 'message' => $exception->getMessage()];
        }
        return true;
    }
}