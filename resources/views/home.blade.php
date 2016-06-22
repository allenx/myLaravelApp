@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">在售商品</div>

                <div class="panel-body">
                    @foreach($items as $item)
                        <div class="col-md-3" style="margin-top: 36px;">
                            <img class="hero" src="http://images.apple.com/macbook-pro/images/overview_osx_hero_2x.jpg" width="219" height="128" alt="">
                            <p>{{$item->name}}</p>
                            <p>售价: ¥{{$item->price}}</p>
                            <p>库存: {{$item->stock}}</p>
                            <div class="col-md-6">
                                <a href="/showDetail_itemid_{{$item->id}}"><button class="btn btn-success">我想看看</button></a>
                            </div>
                            <div class="col-md-6">
                                <button id="bt_add_to_cart" onclick="addToCart({{$item->id}})" class="btn btn-info">加入购物车</button>
                                <script src="//cdn.bootcss.com/jquery/3.0.0-rc1/jquery.min.js"></script>
                                <script>
                                    var addToCart = function (item_id) {
                                        $.get('/addtocart_itemid_'+item_id,{}, function (data, status) {
                                            var data = eval("("+data+")");
                                            if (data.code == 1) {
                                                alert('已经添加进购物车啦!');
                                                $('#bt_add_to_cart').attr('className','btn btn-default btn-lg');
                                                $('#bt_add_to_cart').attr('disabled',true);
                                        } else {
                                                alert('服务器开小差啦');
                                            }
                                        });
                                    };
                                </script>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
