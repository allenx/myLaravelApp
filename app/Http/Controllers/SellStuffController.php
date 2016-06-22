<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\DB;

class SellStuffController extends Controller {
    
    public function index() {
        return view('sellView');
    }
    
    public function publishGood($price, $name, $description, $stock, $img_url) {
        if(!DB::insert('insert into items (seller_id, price, name, description, stock, img_url) values (?, ?, ?, ?, ?, ?)', [Auth::user()->id, $price, $name, $description, $stock, $img_url])) {
            echo '{"code":0}';
        } else {
            echo '{"code":1}';
        }
    }
}