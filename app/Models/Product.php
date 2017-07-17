<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;
class Product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'sku',
        'description',
        'price',
        'date_created',
        'date_updated'
    ];
    
    public $timestamps = false;

    public static function addProduct($info)
    {
        DB::beginTransaction();
        
        try{
            $productId = Product::create($info)->id;
            DB::commit();
            return $productId;
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            DB::rollback();
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

}