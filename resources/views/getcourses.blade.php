{{--抢课界面--}}

{{--继承父模板--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        {{--错误显示--}}

        {{--查看抢课列表--}}     {{--TODO 系统暂停--}}
        <div class="well well-lg"><strong>正在抢课的列表<br></strong>>学校系统状态:<strong>{{$status}}</strong><br>
            <table class="table">
                <tr>
                    <th>课程号</th>
                    <th>课序号</th>
                    <th>课序名称</th>
                    <th>状态</th>
                    <th>尝试次数</th>
                    <th>操作</th>
                    <th>删除</th>
                </tr>
                @foreach($courses as $course)
                    @if($course->status==0)
                        <tr class="info">
                            <td>{{$course->kch}}</td>
                            <td>{{$course->kxh}}</td>
                            <td>{{$course->name}}</td>
                            <td>正在抢课</td>
                            <td>{{$course->times}}</td>
                            <td>
                                <form action="{{ url('/zjt/getc/pause')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-info">暂停抢课</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('/zjt/getc/cancel')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-warning">删除此条</button>
                                </form>
                            </td>
                    @elseif($course->status==1)
                        <tr class="success">
                            <td>{{$course->kch}}</td>
                            <td>{{$course->kxh}}</td>
                            <td>{{$course->name}}</td>
                            <td>抢课成功</td>
                            <td>{{$course->times}}</td>
                            <td>
                                <form action="{{ url('/')}}" method="post">
                                    {{--TODO 查看课表 跳转--}}
                                    {{ csrf_field() }}
                                    <button type="submit" class="label label-success">查看课表</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('/zjt/getc/cancel')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-warning">删除此条</button>
                                </form>
                            </td>
                    @elseif($course->status==4)
                        <tr class="active">
                            <td>{{$course->kch}}</td>
                            <td>{{$course->kxh}}</td>
                            <td>{{$course->name}}</td>
                            <td>等待检测...</td>
                            <td>{{$course->times}}</td>
                            <td>
                                <label>等待检测结果</label>
                            </td>
                            <td>
                                <form action="{{ url('/zjt/getc/cancel')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-warning">删除此条</button>
                                </form>
                            </td>
                    @elseif($course->status==-1)
                        <tr class="">
                            <td>{{$course->kch}}</td>
                            <td>{{$course->kxh}}</td>
                            <td>{{$course->name}}</td>
                            <td>暂停抢课</td>
                            <td>{{$course->times}}</td>
                            <td>
                                <form action="{{ url('/zjt/getc/restart')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-success">重新开抢</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('/zjt/getc/cancel')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-warning">删除此条</button>
                                </form>
                            </td>
                    @elseif($course->status==-2)
                        <tr class="warning">
                            <td>{{$course->kch}}</td>
                            <td>{{$course->kxh}}</td>
                            <td>{{$course->name}}</td>
                            <td><strong>异常</strong>{{$course->info}}</td>
                            <td>{{$course->times}}</td>
                            <td>
                                <form action="{{ url('/zjt/getc/restart')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-success">重新开抢</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('/zjt/getc/cancel')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kch" value={{$course->kch}}>
                                    <input type="hidden" name="kxh" value={{$course->kxh}}>
                                    <button type="submit" class="label label-warning">删除此条</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
            </table>
        </div>

        {{--添加新的抢课--}}
        <div class="well well-lg">添加新的抢课任务<br>
            <form class="form-inline" action="{{ url('/zjt/getc/request')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputName2">课程号:</label>
                    <input class="form-control" name="kch">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">课序号:</label>
                    <input type="text" class="form-control" name="kxh">
                </div>
                <button type="submit" class="btn btn-default">添加</button>
            </form>

        </div>

    </div>
@endsection