<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'incomes';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
