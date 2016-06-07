<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $results = DB::select('select * from items;');
        
        return view('home')->with('items',$results);
    }

    public function addToCart($item_id) {
        if(!DB::insert('insert into carts (user_id, item_id, is_bought, visible) values (?, ?, 0, 1)', [Auth::user()->id, $item_id])) {
            echo '{"code":0}';
        } else {
            echo '{"code":1}';
        }
    }
}
