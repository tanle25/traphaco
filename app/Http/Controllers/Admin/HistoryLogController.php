<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HistoryLogController extends Controller
{

    public function index()
    {
        //activity()->log('Look mum, I logged something');

        return \Auth::user()->actions;
    }

}