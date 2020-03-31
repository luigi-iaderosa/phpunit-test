<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 31/03/20
 * Time: 12.28
 */

namespace App\Repos;


class BaseRepo
{


    protected $customer,$user;
    public function __construct($customer,$user)
    {
        $this->customer = $customer;
        $this->user = $user;
    }

}