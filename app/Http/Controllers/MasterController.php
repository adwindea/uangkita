<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function garduIndukData(){
        $data['page_title'] = 'Gardu Induk';
        return view('master/garduIndukData', $data);
    }
    function getGarduIndukData(){

    }
}
