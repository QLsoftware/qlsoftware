{{-- TODO 查询界面--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">费用查询与缴纳界面</div>
                    <div class="panel-body">
                        <div class="row">
                            @if($SearchOption == 0)
                                <form action="{{ url('/fee/card')}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">校园一卡通</button>
                                </form>
                                <form action="{{ url('/fee/room')}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">寝室费用信息</button>
                                </form>

                            @elseif($SearchOption == 1)
                                <h2>校园卡基本信息</h2>
                                <h4>这里显示基本信息</h4>

                                <h2>校园卡花费记录</h2>

                                </form>
                                <form action="{{ url('/fee/card/pay')}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">一卡通缴费</button>
                                </form>

                            @elseif($SearchOption == 2)
                                <h2>寝室费用信息界面</h2>
                                <form action="{{ url('/fee/room/water')}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">寝室水费信息</button>
                                </form>
                                <form action="{{ url('/fee/room/net')}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">寝室网费信息</button>
                                </form>

                            @elseif($SearchOption == 3)
                                <h2>水费界面</h2>
                                <h4>这里显示基本信息</h4>

                            @elseif($SearchOption == 4)
                                <h2>网费界面</h2>
                                <h4>这里显示基本信息</h4>

                            @elseif($SearchOption == 5)
                                <h2>校园卡缴费界面</h2>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
