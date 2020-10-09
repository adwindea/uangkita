<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $guarded = [];

    public function spending(){
        return $this->hasMany('App\Models\Spending', 'category', 'id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function budget(){
        return $this->hasMany('App\Models\Budget', 'category', 'id');
    }
}
