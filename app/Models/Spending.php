<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spending extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'spendings';
    protected $guarded = [];

    public function cat(){
        return $this->belongsTo('App\Models\Category', 'category');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
