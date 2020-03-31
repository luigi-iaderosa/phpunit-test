<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public static function byEmail($email){
        return Cliente::where('email',$email)->first();
    }
}
