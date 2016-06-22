<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class MobileAppController extends Controller
{
    public function index() {

        $results = DB::select('select * from items;');
        return json_encode($results);
    }
}
