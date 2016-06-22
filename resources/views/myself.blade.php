@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">个人中心</div>

                    <div class="panel-body">
                        <div class="col-md-6 col-md-offset-3">
                            <p>你好, {{$userInfo[0]->name}}</p>
                            <p>你的余额: ¥<span id="leftOver">{{$userInfo[0]->fortune}}</span></p>
                            <p>你的手机号码: {{$userInfo[0]->phone}}</p>
                            <p>你的电子邮箱: {{$userInfo[0]->email}}</p>
                        </div>
                        <div class="col-md-10 col-lg-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        我心仪的商品
                                    </div>
                                    <div class="panel-body">
                                        @foreach($itemsResults as $itemsResult)
                                        <div id="{{$itemsResult[0]->id}}" class="col-md-10" style="margin-top: 20px; border-bottom: solid 1px #dddddd;width: 100%;">
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-5">
                                                <p>{{$itemsResult[0]->name}}</p>
                                                <p>{{$itemsResult[0]->description}}</p>
                                                <p>
                                                    <span style="color: #d43f3a">{{$itemsResult[0]->price}}</span>
                                                </p>
                                            </div>
                                            <div class="col-md-5">

                                                <button id="buy" onclick="buy({{$itemsResult[0]->id}}, {{Auth::user()->fortune}}, {{$itemsResult[0]->price}})" class="btn btn-success">立即购买!</button>
                                                <button id="deleteFromCart" onclick="deleteFromCart({{$itemsResult[0]->id}})" class="btn btn-danger">不想要了!</button>
                                            </div>
                                            <script src="//cdn.bootcss.com/jquery/3.0.0-rc1/jquery.min.js"></script>
                                            <script>

                                                var deleteFromCart = function (item_id) {
                                                    $.get('/deletefromcart_itemid_'+item_id,{}, function (data, status) {
                                                        var data = eval("("+data+")");
                                                        if (data.code == 1) {
                                                            $('#'+item_id).slideToggle(500, function () {
                                                                $('#'+item_id).remove();

                                                            });
                                                        } else {
                                                            alert('服务器开小差啦');
                                                        }
                                                    });
                                                }

                                                var buy = function (item_id, moneyLeft, price) {

                                                    $.get('/buy_itemid_'+item_id,{}, function (data, status) {
                                                        var data = eval("("+data+")");
                                                        if (data.code == 1) {
                                                            $.get('/deletefromcart_itemid_'+item_id,{}, function (data, status) {
                                                                var data = eval("("+data+")");
                                                                if (data.code == 1) {
                                                                    $('#'+item_id).slideToggle(500, function () {
                                                                        $('#'+item_id).remove();
                                                                        $('#leftOver').text(moneyLeft-price);
                                                                    });
                                                                } else {
                                                                    alert('服务器开小差啦');
                                                                }
                                                            });
                                                        } else {
                                                            alert('钱不够啦!');
                                                        }
                                                    });
                                                };
                                            </script>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    购买历史
                                </div>
                                <div class="panel-body">
                                    @foreach($itemsResults as $itemsResult)
                                        <div id="{{$itemsResult[0]->id}}" class="col-md-10" style="margin-top: 20px; border-bottom: solid 1px #dddddd;width: 100%;">
                                            <div class="col-md-2">
                                                <img src=""/>
                                            </div>
                                            <div class="col-md-10">
                                                <p>{{$itemsResult[0]->name}}</p>
                                                <p>{{$itemsResult[0]->description}}</p>
                                                <p>
                                                    <span style="color: #d43f3a">{{$itemsResult[0]->price}}</span>
                                                </p>
                                            </div>
                                            </div>
                                        </div>
                                @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
