<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 01/04/20
 * Time: 10.44
 */

namespace App\Repos\RepoBuilders;


use App\Cliente;
use App\Repos\BuilderRepoInterface\OrderRepoBuilderInterface;
use App\Repos\OrderRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class OrderRepoBuilder implements OrderRepoBuilderInterface
{
    private $request;
     public function __construct(Request $request)
     {
         $this->request = $request;
     }

    public function build(){
        $user = Auth::user();
        $customer = Cliente::byEmail($user->email);
        return new OrderRepo($customer, $user);
    }
}