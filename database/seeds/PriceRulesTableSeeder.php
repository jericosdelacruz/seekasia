<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PriceRulesTableSeeder extends Seeder {

    public function run()
    {
        $priceRules = array(
            array(
                'pricing_rule_type' => 2,
                'cost_per_ad'       => null,
                'minimum_quantity'  => 3,
                'counted_quantity'  => 2,
                'customer_id'       => 1,
                'product_id'        => 1,
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
            array(
                'pricing_rule_type' => 1,
                'cost_per_ad'       => 299.99,
                'minimum_quantity'  => 1,
                'counted_quantity'  => null,
                'customer_id'       => 2,
                'product_id'        => 2,
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
            array(
                'pricing_rule_type' => 3,
                'cost_per_ad'       => 379.99,
                'minimum_quantity'  => 4,
                'counted_quantity'  => null,
                'customer_id'       => 3,
                'product_id'        => 3,
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
            array(
                'pricing_rule_type' => 2,
                'cost_per_ad'       => null,
                'minimum_quantity'  => 5,
                'counted_quantity'  => 4,
                'customer_id'       => 4,
                'product_id'        => 1,
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
            array(
                'pricing_rule_type' => 1,
                'cost_per_ad'       => 309.99,
                'minimum_quantity'  => 1,
                'counted_quantity'  => null,
                'customer_id'       => 4,
                'product_id'        => 2,
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
            array(
                'pricing_rule_type' => 3,
                'cost_per_ad'       => 389.99,
                'minimum_quantity'  => 3,
                'counted_quantity'  => null,
                'customer_id'       => 4,
                'product_id'        => 3,
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
        );

        DB::table('price_rules')->insert( $priceRules );
    }

}
