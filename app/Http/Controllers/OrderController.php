<?php

namespace App\Http\Controllers;

use App\Articolo;
use App\Http\Requests\SetOrderRequest;
use App\Repos\RepoInterfaces\OrderRepoInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    private $orderRepo;
    public function __construct(Request $request,OrderRepoInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function setOrder(SetOrderRequest $request){
        $articolo = Articolo::find($request->articolo_id);
        $this->orderRepo->makeOrder($articolo);
    }
}
