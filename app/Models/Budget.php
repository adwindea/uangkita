<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'budgets';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
