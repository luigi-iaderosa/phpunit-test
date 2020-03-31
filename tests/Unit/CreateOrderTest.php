<?php

namespace Tests\Unit;

use App\Articolo;
use App\Cliente;
use App\Ordine;
use App\User;
use Tests\TestCase;
use App\Repos\OrderRepo;
use Illuminate\Foundation\Testing\RefreshDatabase;
class CreateOrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_order_can_create_with_customer_defined_category_articles(){
        $this->withoutExceptionHandling();

        $customer = factory(Cliente::class)->create(['categoria'=>'A']);
        $user = User::where('email',$customer->email)->first();

        $i=0;

        while($i<3){
            factory(Articolo::class)->create(['categoria'=>'A']);
            $i++;
        }

        #crea ordini con i tre articoli
        $articoliPerOrdine = Articolo::where('categoria','A')->get();

        $orderRepo = new OrderRepo($customer,$user);

        foreach ($articoliPerOrdine as $articolo){
            $orderRepo->makeOrder($articolo);
        }

        $this->assertCount(3,Ordine::all());

    }



    /**
     * @test
     */
    public function create_order_cannot_create_with_non_customer_defined_categories(){
        $this->withoutExceptionHandling();
        $this->expectException(\Exception::class);
        $customer = factory(Cliente::class)->create(['categoria'=>'A']);
        $user = User::where('email',$customer->email)->first();


        factory(Articolo::class)->create(['categoria'=>'B']);


        $articoliPerOrdine = Articolo::where('categoria','B')->get();

        $orderRepo = new OrderRepo($customer,$user);

        foreach ($articoliPerOrdine as $articolo){
            $orderRepo->makeOrder($articolo);
        }
    }


    /**
     * @test
     */
    public function create_order_general_persistence_mock_tested_object(){

        $customer = factory(Cliente::class)->create(['categoria'=>'A']);
        $user = User::where('email',$customer->email)->first();


        factory(Articolo::class)->create(['categoria'=>'B']);


        $articoliPerOrdine = Articolo::where('categoria','B')->get();


        $orderRepo = $this->getMockBuilder(OrderRepo::class)->setConstructorArgs([$customer,$user])->
        setMethodsExcept(['makeOrder'])->
        getMock();

        $orderRepo->method('articleIsCustomerCompatible')->will($this->returnCallback(
            function ($arg){
                return true;
            }
        ));

        foreach ($articoliPerOrdine as $articolo){
            $orderRepo->makeOrder($articolo);
        }

        $this->assertCount(1,Ordine::all());


    }




}
