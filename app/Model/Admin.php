<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";

    protected $fillable = ['username','nickname','password'];


    public function admin_role(){
        return $this->hasOne('App\Model\AdminRole');
    }
}
