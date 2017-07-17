<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductsTableSeeder extends Seeder {

    public function run()
    {
        $products = array(
            array(
                'display_name'  => 'Classic Ad',
                'sku'           => 'classic',
                'price'         => 269.99,
                'description'   => 'Offers the most basic level of advertisement',
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
            array(
                'display_name'  => 'Standout Ad',
                'sku'           => 'standout',
                'price'         => 322.99,
                'description'   => 'Allows advertisers to use a company logo and use a longer presentation text',
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
            array(
                'display_name'  => 'Premium Ad',
                'sku'           => 'premium',
                'price'         => 394.99,
                'description'   => 'Same benefits as Standout Ad, but also puts the advertisement at the top 
                of the results, allowing higher visibility',
                'date_created'  => date("Y-m-d H:i:s"),
                'date_updated'  => date("Y-m-d H:i:s")
            ),
        );

        DB::table('products')->insert( $products );
    }

}
