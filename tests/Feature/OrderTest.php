<?php

namespace Tests\Feature;

use App\Articolo;
use App\Ordine;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Cliente;

class OrderTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function set_order_ok_article_customer_category_match()
    {
        $this->withoutExceptionHandling();
        $customer = factory(Cliente::class)->create(['categoria'=>'A']);
        $user = User::where('email','=',$customer->email)->first();
        $articoloSceltoId = factory(Articolo::class)->create(['categoria'=>'A'])->id;


        $response = $this->actingAs($user)->post('/set-order',['articolo_id'=>$articoloSceltoId]);

        $this->assertCount(1,Ordine::all());
        $response->assertStatus(200);

    }

    /**
     * @test
     */
    public function set_order_ko_article_customer_category_mismatch(){
        $this->withoutExceptionHandling();
        $this->expectException(\Exception::class);
        $customer = factory(Cliente::class)->create(['categoria'=>'A']);
        $user = User::where('email','=',$customer->email)->first();
        $articoloSceltoId = factory(Articolo::class)->create(['categoria'=>'B'])->id;

        $response = $this->actingAs($user)->post('/set-order',['articolo_id'=>$articoloSceltoId]);

        $this->assertCount(1,Ordine::all());
    }



    /**
     * @test
     */
    public function set_order_ko_customer_not_tied_to_user(){
        $this->withoutExceptionHandling();
        $this->expectException(\Exception::class);
        $customer = factory(Cliente::class)->create(['categoria'=>'A']);
        $user = User::where('email','=',$customer->email)->first();
        $customer->email = 'deceptive@email.com';
        $customer->save();

        $articoloSceltoId = factory(Articolo::class)->create(['categoria'=>'B'])->id;
        $response = $this->actingAs($user)->post('/set-order',['articolo_id'=>$articoloSceltoId]);
    }









}
