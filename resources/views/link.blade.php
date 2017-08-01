{{--绑定界面--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">绑定</div>
                    <div class="panel-body">
                        <div class="row">
                            @if($where == 1)
                                <h3>你已经成功绑定，学号:<span class="label label-default">{{$j_u}}</span></h3>
                            @elseif($where ==-2)
                                <h3>解绑成功，网站已删除您的学号信息</h3>
                            @elseif($where ==-2)
                                <h3>网络故障验证失败，请重试</h3>
                            @elseif($where==-1)
                                <h4><span class="error">抱歉您的学号和密码不匹配</span></h4>
                                {{--zjt  绑定学生的学号--}}
                                <form action="{{ url('/link/request')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="col-md-4 control-label">学号:</label>
                                        <input type="text" class="form-control" name="j_username">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="col-md-4 control-label">密码:</label>
                                        <input type="password" class="form-control" name="j_password"
                                               placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-default">绑定</button>
                                </form>
                                {{--zjt--}}
                            @elseif($where==0)

                                @if(Auth::user()["j_username"]==null)
                                    <h4>貌似你还没有绑定你的学号哦</h4>
                                    {{--zjt  绑定学生的学号--}}
                                    <form action="{{ url('/link/request')}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputName2">学号:</label>
                                            <input type="text" class="form-control" name="j_username" placeholder="学号">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" name="j_password"
                                                   placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-default">绑定</button>
                                    </form>
                                    {{--zjt--}}
                                @elseif(Auth::user()["j_username"]!=null&&Auth::user()["j_password"]==null)
                                    <h4>您的学号的密码已失效，请重新绑定</h4>
                                    {{--zjt  绑定学生的学号--}}
                                    <form action="{{ url('/link/request')}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputName2">学号:</label>
                                            <input type="text" class="form-control" name="j_username" placeholder="学号">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" name="j_password"
                                                   placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-default">绑定</button>
                                    </form>
                                    {{--zjt--}}
                                @else
                                    <h3>你已经成功绑定，学号:<span
                                                class="label label-default">{{Auth::user()["j_username"]}}</span></h3>
                                    <form action="{{ url('/link/cancel')}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-default">解绑</button>
                                        </div>
                                    </form>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
