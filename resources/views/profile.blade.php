@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <img src='{{ $user->avatar }}'
                     style="width: 100px;height: 100px;float:left;border-radius: 50%;margin-right: 25px">
                <h2>{{ $user->name }} 的设置</h2>
                <form class="form-inline" role="form" enctype="multipart/form-data" action="{{url('/profile')}}"
                      method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <span class="input-group-addon">上传图片</span>
                        <!--只需要将输入的内容类型‘type’，定义为file即可；name为键   选中的文件为键值-->
                        <input class="form-control" type="file" name="avatar"></div>
                    <div class="form-group">
                        <input type="submit" class="pull-right btn btn-sm btn-primary">
                    </div>
                </form>
            </div>

        </div>
        <br><br><br>
        <div class="col-md-8 col-md-offset-2">
            <table class="table">
                <tr>
                    <td>项目</td>
                    <td>状态</td>
                    <td>操作</td>
                </tr>


                @if(Auth::user()->sdu_notify){{--当前接收--}}
                <tr class="success">
                    <td>是否接受来自山大的新通知</td>
                    <td>接收</td>
                    <td>
                        <form action="{{url('/profile/sdu_notify_unaccept')}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-sm btn-danger">取消接收</button>
                        </form>
                    </td>
                </tr>
                @else{{--当前不接受--}}
                <tr class="alert-danger">
                    <td>是否接受来自山大的新通知</td>
                    <td>不接收</td>
                    <td>
                        <form action="{{url('/profile/sdu_notify_accept')}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-sm btn-success">我要接收</button>
                        </form>
                    </td>
                </tr>
                @endif

                @if(Auth::user()->j_password){{--当前已绑定--}}
                <tr class="success">
                    <td>绑定本科教育的学号</td>
                    <td>已绑定，{{Auth::user()->j_username}}</td>
                    {{--TODO --}}
                    <td>
                        <form action="{{ url('/link/cancel')}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-sm btn-danger">解绑</button>
                        </form>
                    </td>
                </tr>
                @elseif(!Auth::user()->j_password&&Auth::user()->j_username){{--失效--}}
                <tr class="alert-error">
                    <td>绑定本科教育的学号</td>
                    <td>密码失效</td>
                    <td>
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#link">重新绑定</button>

                    </td>
                </tr>
                @else
                    <tr class="alert-danger">
                        <td>绑定本科教育的学号</td>
                        <td>未绑定</td>
                        <td>
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#link">重新绑定</button>

                        </td>
                    </tr>
                @endif


            </table>

            <!-- 模态框（Modal） -->
            <div class="modal fade" id="link" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                请绑定
                            </h4>
                        </div>

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

                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>


        </div>
    </div>
@endsection
