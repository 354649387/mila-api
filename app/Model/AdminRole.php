<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'admin_role';

    public function role(){
        return $this->hasOne('App\Model\Role');
    }
}
