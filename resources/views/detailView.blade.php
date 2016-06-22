@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$detail[0]->name}}</div>

                    <div class="panel-body">
                        <div class="row">
                            <div id="imgContainer" class="col-md-6" style="width: 290px; height: 280/px;">
                                <img src="{{$detail[0]->img_url}}" style="object-fit: contain; max-width: 100%">
                            </div>
                            <script type="text/javascript">
                                (function() {

                                    var img = document.getElementById('imgContainer').firstChild;
                                    img.onload = function() {
                                        if(img.height > img.width) {
                                            img.height = '100%';
                                            img.width = 'auto';
                                        }
                                    };

                                }());
                            </script>
                            <div class="col-md-6">
                                <p style="font-weight: bold; font-size: 30px">{{$detail[0]->name}}</p>
                                <p style="color: #d43f3a;">{{$detail[0]->description}}</p>
                                <p style="color: #d43f3a;">¥ {{$detail[0]->price}}</p>
                                <p style="color: #d43f3a;">库存: {{$detail[0]->stock}}</p>
                                @if($detail[0]->salecounts <= 300)
                                    <p style="color: grey;">销量: {{$detail[0]->salecounts}}</p>
                                @else
                                    <p style="color: red;">销量: {{$detail[0]->salecounts}}</p>
                                @endif

                                @if($detail[0]->stock === 0)
                                    <button class="btn btn-info" disabled='disabled'>加入购物车</button>
                                    <button class="btn btn-info" disabled='disabled'>加入购物车</button>
                                @else
                                    <button id="bt_add_to_cart" onclick="addToCart({{$detail[0]->id}})" class="btn btn-info">加入购物车</button>
                                    <button id="buy" onclick="buy({{$detail[0]->id}})" class="btn btn-success">立即购买!</button>
                                @endif
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

                                    var buy = function (item_id) {
                                        $.get('/buy_itemid_'+item_id,{}, function (data, status) {
                                            var data = eval("("+data+")");
                                            if (data.code == 1) {
                                                alert('购买成功啦!');
                                            } else {
                                                alert('钱不够啦!');
                                            }
                                        });
                                    };
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
