<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('pricing_rule_type');
            $table->decimal('cost_per_ad',8,2)->nullable();
            $table->integer('minimum_quantity')->nullable();
            $table->integer('counted_quantity')->nullable();
            $table->integer('customer_id')->nullable()->unsigned();
            $table->integer('product_id')->unsigned();
            $table->datetime('date_created');
            $table->datetime('date_updated');

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('price_rules');
    }
}
