<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\PriceRule;
use App\Models\Product;
use App\Models\Customer;

class PriceRuleController extends Controller
{
    //

    public function index()
    {
        $priceRules = PriceRule::getAllPriceRules();
        $title = 'Price Rules';

        return view('layouts.price_rules',array(
            'title'     => $title, 
            'priceRules' => $priceRules,
        ));
    }

    public function addPriceRule()
    {
        $title = 'Add Price Rule';
        $formUrl = url('/price_rules/save');
        $customers = Customer::all();
        $products = Product::all();
        return view('layouts.price_rules_form',array(
            'title'     => $title, 
            'formUrl'   => $formUrl,
            'products'  => $products, 
            'customers' => $customers,
        ));
    }

    public function editPriceRule($id)
    {
        $title = 'Edit Price Rule';
        $formUrl = url('/price_rules/save');
        $priceRule = PriceRule::find($id);
        $customers = Customer::all();
        $products = Product::all();
        return view('layouts.price_rules_form',array(
            'title'     => $title, 
            'formUrl'   => $formUrl,
            'products'  => $products, 
            'customers' => $customers,
            'priceRule' => $priceRule
        ));
    }

    public function savePriceRule(Request $request)
    {
         $inputs = $request->all();

         $info = self::buildInfo($inputs);
         $info['date_updated'] = date("Y-m-d H:i:s");
         if(isset($inputs['price_rule_id'])) {
            $result = PriceRule::editPriceRule($info,$inputs['price_rule_id']);
         } else {
            $info['date_created'] = $info['date_updated'];
            $result = PriceRule::addPriceRule($info);
         }

         return redirect('/price_rules');
    }

    private function buildInfo($inputs)
    {
        $info = array();

        switch($inputs['pricing_rule_type']) {
            case 1:
                $info = array(
                    'pricing_rule_type' => $inputs['pricing_rule_type'],
                    'cost_per_ad'       => $inputs['cost_per_ad'],
                    'minimum_quantity'  => 1,
                    'counted_quantity'  => null,
                    'customer_id'       => $inputs['customer'],
                    'product_id'        => $inputs['product'],
                );
                break;
            case 2:
                $info = array(
                    'pricing_rule_type' => $inputs['pricing_rule_type'],
                    'cost_per_ad'       => null,
                    'minimum_quantity'  => $inputs['minimum_quantity'],
                    'counted_quantity'  => $inputs['counted_quantity'],
                    'customer_id'       => $inputs['customer'],
                    'product_id'        => $inputs['product'],
                );
                break;
            case 3:
                $info = array(
                    'pricing_rule_type' => $inputs['pricing_rule_type'],
                    'cost_per_ad'       => $inputs['cost_per_ad'],
                    'minimum_quantity'  => $inputs['minimum_quantity'],
                    'counted_quantity'  => null,
                    'customer_id'       => $inputs['customer'],
                    'product_id'        => $inputs['product'],
                );
                break;
        }

        return $info;
    }
}
