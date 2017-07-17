<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Product;
use App\Models\Customer;
use App\Models\PriceRule;
use App\Models\Order;


class CheckoutController extends Controller
{
    public function home()
    {
        $title = "Buy Job Ads";
        $products = Product::all();
        $customers = Customer::all();
        $formUrl = url('/checkout');

        return view('layouts.index',array(
            'title'     => $title, 
            'products'  => $products, 
            'customers' => $customers,
            'formUrl'   => $formUrl,
        ));
    }

    public function checkout(Request $request)
    {
        $inputs = $request->all();

        if ($inputs['customer'] == 0){
            $customer = Customer::where('name','like',$inputs['customer_name'])->first();

            if(empty($customer)){
                $info = array(
                    'name'          => $inputs['customer_name'],
                    'date_created'  => date("Y-m-d H:i:s") 
                );

                $customer = Customer::addCustomer($info);
                $customer = array('id'=>$customer);   
            }
            
            $inputs['customer'] = $customer['id'];
            
        }

        list($costs,$totalCost) = self::computeTotal($inputs);

        $orderInfo = array(
            'customer_id'   => $inputs['customer'],
            'total_amount'  => $totalCost,
            'date_ordered'  => date("Y-m-d H:i:s")
        );

        $orderContents = array();
        foreach($costs as $productId => $cost){
            $orderContents[] = array(
                'product_id' => $productId,
                'cost'       => $cost,
                'quantity'   => $inputs['quantity'][$productId]
            );
        }

        $orderId = Order::addOrder($orderInfo,$orderContents);

        if (empty($orderId['error'])) {
            $orderInfo = Order::getAllOrderInfo($orderId);

            $title = "Order Summary";
            $backUrl = url('/');

            return view('layouts.order_summary',array(
                'title'     => $title, 
                'orderInfo' => $orderInfo, 
                'backUrl'   => $backUrl,
            ));
        }
    }


    private function computeTotal($info)
    {

        $totalCost = 0;
        $costs = array();
        $products = Product::all();
        $productsContainer = array();
        
        foreach($products as $product){
            $productsContainer[$product['id']] = $product;
        }

        $priceRules = PriceRule::getPriceRulePerCustomer($info['customer']);

        foreach ($info['quantity'] as $productId => $quantity) {
            if ($quantity > 0) {
                $priceRule = isset($priceRules[$productId])?$priceRules[$productId]:null;
                
                if(isset($priceRule)) {
                    
                    switch($priceRule['pricing_rule_type']) {

                        case 1: $cost = $quantity * $priceRule['cost_per_ad'];
                                break;

                        case 2: if($quantity > $priceRule['minimum_quantity']) {
                                //get how many sets can be considered
                                    $sets = floor($quantity/$priceRule['minimum_quantity']);
                                    $cost = $sets * ($priceRule['counted_quantity'] * $productsContainer[$productId]['price']);
                                    $normalPriceQuantity = $quantity - ($sets * $priceRule['minimum_quantity']);
                                    $cost += $normalPriceQuantity * $productsContainer[$productId]['price'];                               
                                } else if($quantity == $priceRule['minimum_quantity'] ) {
                                    $cost = $priceRule['counted_quantity'] * $productsContainer[$productId]['price'];
                                } else {
                                    $cost = $quantity * $productsContainer[$productId]['price'];
                                }

                                break;


                        case 3: if ($quantity >= $priceRule['minimum_quantity']) {
                                    $cost = $quantity * $priceRule['cost_per_ad'];
                                }
                                break;

                        default: $cost = $quantity * $productsContainer[$productId]['price'];
                                break;
                    }             
                } else {
                    $cost = $quantity * $productsContainer[$productId]['price'];
                }

                $costs[$productId] = $cost; 
                $totalCost += $cost;
            }
                
        }

        return array($costs,$totalCost);
    }
}
