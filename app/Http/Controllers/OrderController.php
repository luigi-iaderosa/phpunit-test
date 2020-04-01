<?php

namespace App\Http\Controllers;

use App\Articolo;
use App\Http\Requests\SetOrderRequest;
use App\Repos\BuilderRepoInterface\OrderRepoBuilderInterface;
use App\Repos\RepoInterfaces\OrderRepoInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    private $orderRepo;
    private $builderRepoInterface;
    public function __construct(Request $request,
                                OrderRepoBuilderInterface $builderRepoInterface)
    {
        $this->builderRepoInterface = $builderRepoInterface;
        $this->middleware(function($request,$next){
            $this->orderRepo = $this->builderRepoInterface->build();
            return $next($request);
        });
    }

    public function setOrder(SetOrderRequest $request){
        $articolo = Articolo::find($request->articolo_id);
        $this->orderRepo->makeOrder($articolo);
    }
}
