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
        return view('myself')->with('userinfo', $userResult);
    }
}