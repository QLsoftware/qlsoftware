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
            </table>
        </div>
    </div>
@endsection
