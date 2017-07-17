<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;

class PriceRule extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'price_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pricing_rule_type',
        'cost_per_ad',
        'minimum_quantity',
        'counted_quantity',
        'customer_id',
        'product_id',
        'date_created',
        'date_updated'
    ];
    
    public $timestamps = false;

    public static function addPriceRule($info)
    {
        DB::beginTransaction();
        
        try{
            $priceRuleId = PriceRule::create($info)->id;
            DB::commit();
            return $priceRuleId;
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            DB::rollback();
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public static function editPriceRule($info,$id)
    {
        DB::beginTransaction();
        
        try{
            $result = PriceRule::where('id','=',$id)->update($info);
            DB::commit();
            return $result;
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            DB::rollback();
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public static function getPriceRulePerCustomer($customerId)
    {
        $priceRules =  PriceRule::where('customer_id', '=', $customerId)->get();
        $priceRulesContent = array();
        if (!empty($priceRules)) {
            foreach($priceRules as $rule){
                $priceRulesContent[$rule['product_id']] = $rule;
            }
        }

        return $priceRulesContent;
    }

    public static function getAllPriceRules()
    {
        $priceRules = DB::table('price_rules')
                    ->select('price_rules.*','products.display_name as product_name','customers.name as customer_name')
                    ->join('products','price_rules.product_id','=','products.id')
                    ->join('customers','price_rules.customer_id','=','customers.id')
                    ->get();

        return $priceRules;

    }

}