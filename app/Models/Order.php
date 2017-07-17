<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;
class Order extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_amount',
        'customer_id',
        'date_ordered'
    ];
    
    public $timestamps = false;

    public static function addOrder($info, $orderContents)
    {
        DB::beginTransaction();
        
        try{
            $orderId = Order::create($info)->id;
            $order['contents'] = self::saveOrderContents($orderContents, $orderId);
            DB::commit();
            return $orderId;
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            DB::rollback();
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public static function getAllOrderInfo($orderId) 
    {
        $order = DB::table('orders')
                ->select('orders.*','customers.name as customer_name')
                ->join('customers','orders.customer_id','=','customers.id')
                ->where('orders.id','=',$orderId)
                ->first();

        $order->contents = DB::table('order_contents')
                            ->select('order_contents.*', 'products.display_name as product_name', 'products.sku as product_sku')
                            ->join('products','order_contents.product_id','=','products.id')
                            ->where('order_contents.order_id','=',$orderId)
                            ->get();
        return $order;
    }

    private static function saveOrderContents($orderContents, $orderId)
    {
        $contents = array();
        foreach ($orderContents as $productId => $content) {
            $contents[] = array(
                'order_id'      => $orderId,
                'product_id'    => $content['product_id'],
                'quantity'      => $content['quantity'],
                'cost'          => $content['cost']
            );
        }

        return DB::table('order_contents')->insert($contents);
    }

}