<?php

namespace App\Http\Controllers;

use App\EventTypes;

class BetFairController extends Controller
{
    public function __invoke(){
    	return EventTypes::get();
    }
}
