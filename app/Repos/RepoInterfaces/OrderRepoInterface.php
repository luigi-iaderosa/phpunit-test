<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 31/03/20
 * Time: 17.24
 */

namespace App\Repos\RepoInterfaces;


use App\Articolo;

interface OrderRepoInterface
{
    public function makeOrder(Articolo $articolo);
}