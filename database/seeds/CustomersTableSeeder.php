<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustomersTableSeeder extends Seeder {

    public function run()
    {
        $customers = array(
            array(
                'name'          => 'Unilever',
                'date_created'  => date("Y-m-d H:i:s")
            ),
            array(
                'name'          => 'Apple',
                'date_created'  => date("Y-m-d H:i:s")
            ),
            array(
                'name'          => 'Nike',
                'date_created'  => date("Y-m-d H:i:s")
            ),
            array(
                'name'          => 'Ford',
                'date_created'  => date("Y-m-d H:i:s")
            ),
        );

        DB::table('customers')->insert( $customers );
    }

}
