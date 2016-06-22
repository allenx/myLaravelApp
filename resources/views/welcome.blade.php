@extends('layouts.app')

<style>
    body{text-align: center;}
    #center{margin-right: auto;
    margin-left: auto;
        margin-top: 220px;
    vertical-align: middle;
    line-height: 200px;}
    @keyframes center-in {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0px); opacity: 1; }
    }
    #center {
        animation: center-in 2s ease-out;
        animation-fill-mode: both;
        animation-delay: 1s;
    }
</style>
@section('content')
<div id="center" class="container" style="margin-left: auto; margin-right: auto;">
            <p style="font-family: 'PingFang SC'; font-size: 88px; color: white; margin-left: auto; margin-right: auto; text-shadow: 0 2px 2px #000;">
                天外天商城
            </p>
</div>


@endsection
