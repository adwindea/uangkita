<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = [];

    public function spending(){
        return $this->hasMany('App\Models\Spending');
    }
    public function category(){
        return $this->hasMany('App\Models\Category');
    }

}
