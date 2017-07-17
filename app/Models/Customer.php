<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;
class Customer extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date_created'
    ];
    
    public $timestamps = false;

    public static function addCustomer($info)
    {
        DB::beginTransaction();
        
        try{
            $customerId = Customer::create($info)->id;
            DB::commit();
            return $customerId;
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            DB::rollback();
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

}