<?php
/**
 * Created by PhpStorm.
 * User: allenx
 * Date: 6/6/16
 * Time: 8:22 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\User;

class InfoController extends Controller
{
    public function showInfo() {
        $userResult = DB::select('select * from users where id = :id', ['id'=>Auth::user()->id]);
        $cartsResult = DB::select('select * from carts where user_id = :id', ['id' => Auth::user()->id]);
        $itemsResult = [];
        for ($i = 0; $i < count($cartsResult); ++$i) {
            $itemsResult[$i] = DB::select('select * from items where id = :id', ['id'=>$cartsResult[$i]->item_id]);
        }
        return view('myself')->with('userInfo', $userResult)->with('itemsResults', $itemsResult);
    }
}
