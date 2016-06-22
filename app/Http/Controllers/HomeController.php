<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Item;

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

    public function showDetail($item_id) {
        $detailResult = DB::select('select * from items where id = :id', ['id'=>$item_id]);
        if (!is_null($detailResult)){
            return view('detailView')->with('detail', $detailResult);
        }
    }

    public function deleteFromCart ($item_id) {
        if (!DB::delete('delete from carts where item_id = :iid and user_id = :uid', ['iid'=>$item_id, 'uid'=>Auth::user()->id])) {
            echo '{"code":0}';
        } else {
            echo '{"code":1}';
        }
    }

    public function buy ($item_id) {
        $itemResult = DB::select('select * from items where id = :id', ['id'=>$item_id]);
        if ($itemResult[0]->price <= Auth::user()->fortune) {
            if (!DB::update('update users set fortune = :fortune where id = :id', ['fortune'=>Auth::user()->fortune - $itemResult[0]->price,'id'=>Auth::user()->id])){
                echo '{"code":0}';
            } else {
                if (!DB::insert('insert into trades (buyer_id, item_id, visible, created_at) values (?, ?, 1, ?)', [Auth::user()->id, $item_id, date('y-m-d H-i-s', time())])) {
                    $isRollingBack=0;
                    while($isRollingBack == 0) {
                        if (DB::update('update users set fortune = :fortune where id = :id', ['fortune'=>Auth::user()->fortune + $itemResult[0]->price,'id'=>Auth::user()->id])){
                            $isRollingBack = 1;
                        }
                    }
                } else {
                    echo '{"code":1}';
                }
            }
        }
    }
}
