<?php
namespace App\Http\Repository;


use Carbon\Carbon;

class CrudRepository{

    public function createNew($data =[],$modal){
       try{
           $data['created_at'] = Carbon::now();
           $modal->create($data);

       }
       catch (\Exception $exception){
           return ['code' => 503, 'message' => $exception->getMessage()];
       }
        return true;
    }
}