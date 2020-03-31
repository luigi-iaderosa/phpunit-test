<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 31/03/20
 * Time: 12.24
 */

namespace App\Repos;


use App\Ordine;
use App\Repos\RepoInterfaces\OrderRepoInterface;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Articolo;

class OrderRepo extends BaseRepo implements OrderRepoInterface
{

    public function __construct($customer, $user)
    {
        parent::__construct($customer, $user);
    }


    public function makeOrder(Articolo $articolo){
        Log::debug('makeOrder chiamato...');
        if ($this->articleIsCustomerCompatible($articolo)){

            Ordine::create([
                'articolo_id'=>$articolo->id,
                'user_id'=>$this->user->id,
            ]);
        }
        else {
            Log::debug('make order fallito');
            throw new \Exception();
        }
    }

    //questa è una dipendenza esterna
    public function articleIsCustomerCompatible($articolo){
        return $this->customer->categoria == $articolo->categoria;
    }



}