@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">个人中心</div>

                    <div class="panel-body">
                        <div class="col-md-6 col-md-offset-3">
                            <p>{{$userinfo[0]->name}}</p>
                            <p>{{$userinfo[0]->phone}}</p>
                            <p>{{$userinfo[0]->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
