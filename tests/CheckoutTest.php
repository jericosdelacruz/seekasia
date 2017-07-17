<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutTest extends TestCase
{

    
    //testing with default customer with 1 of each product
    public function testBuyAdWithDefault()
    {
        $this->visit('/')
            ->select('0','customer')
            ->type('default', 'customer_name')
            ->type('1','quantity[1]')
            ->type('1','quantity[2]')
            ->type('1','quantity[3]')
            ->press('Buy Ads')
            ->seePageIs('/checkout')
            ->see('$987.97');
    }

    public function testBuyAdWithUnilever()
    {
        $this->visit('/')
            ->select('1','customer')
            ->type('3','quantity[1]')
            ->type('1','quantity[3]')
            ->press('Buy Ads')
            ->seePageIs('/checkout')
            ->see('$934.97');
    }

    public function testBuyAdWithApple()
    {
        $this->visit('/')
            ->select('2','customer')
            ->type('3','quantity[2]')
            ->type('1','quantity[3]')
            ->press('Buy Ads')
            ->seePageIs('/checkout')
            ->see('$1294.96');
    }

    public function testBuyAdWithNike()
    {
        $this->visit('/')
            ->select('3','customer')
            ->type('4','quantity[3]')
            ->press('Buy Ads')
            ->seePageIs('/checkout')
            ->see('$1519.96');
    }

    public function testBuyAdWithFord()
    {
        $this->visit('/')
            ->select('4','customer')
            ->type('5','quantity[1]')
            ->type('1','quantity[2]')
            ->type('3','quantity[3]')
            ->press('Buy Ads')
            ->seePageIs('/checkout')
            ->see('$2559.92');
    }
}
