{{--for 昌奇 TODO 查询界面--}}
@extends('layouts.app')

@section('content')

    <!-- dsfs-->
    <div class="container">
        {{--<div class="col-md-10 col-md-offset-1">--}}
            {{--<div class="panel panel-default">--}}
                <div class="panel-body">
                    <div class="row">
                        @if($SearchOption == 1)
                            @if(Auth::user()["j_username"]==null)
                                <h4>貌似你还没有绑定你的学号哦</h4>
                                <form action="{{ url('/profile')}}" method="get">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">去绑定</button>
                                </form>
                            @else
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="container">
                                            <div class="row">

                                                <form action="{{ url('/search')}}" method="get">
                                                    {{ csrf_field() }}
                                                    <h3>
                                                        <div class="col-xs-6 col-sm-8">
                                                            学生 <span
                                                                    class="label label-default">{{Auth::user()["j_username"]}}</span>
                                                            的课表：
                                                        </div>
                                                        <div class="col-xs-6 col-sm-2">
                                                            {{--<button type="submit" class="btn btn-default">返回</button>--}}
                                                        </div>
                                                    </h3>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><h4>本学期课表</h4></div>
                                            <div class="panel-body">
                                                <table class="table table-bordered">
                                                    @foreach($CourseArray as $CourseArray_1)
                                                        <tr>
                                                            @foreach($CourseArray_1 as $CourseArray_2)
                                                                <th>{{$CourseArray_2}}</th>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading"><h4>详细上课信息</h4></div>
                                            <div class="panel-body">
                                                <table class="table table-bordered">
                                                    @foreach($countarray as $countarray_1)
                                                        <tr>
                                                            @foreach($countarray_1 as $countarray_2)
                                                                <th>{{$countarray_2}}</th>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{--@elseif($SearchOption == 2)--}}
                            {{--<h2>自习室查询界面</h2>--}}
                            {{--<!DOCTYPE html>--}}
                            {{--<html>--}}
                            {{--<head>--}}
                            {{--<meta charset="utf-8">--}}
                            {{--<title>Bootstrap 实例 - 选择框</title>--}}
                            {{--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
                            {{--<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>--}}
                            {{--<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
                            {{--</head>--}}
                            {{--<body>--}}
                            {{--<form action="{{ url('/search/roomrequest')}}" method="post">--}}
                            {{--<form role="form">--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="name">选择列表</label>--}}
                            {{--<select class="form-control">--}}
                            {{--<option>1</option>--}}
                            {{--<option>2</option>--}}
                            {{--<option>3</option>--}}
                            {{--<option>4</option>--}}
                            {{--<option>5</option>--}}
                            {{--</select>--}}

                            {{--</div>--}}
                            {{--</form>--}}

                            {{--{{ csrf_field() }}--}}
                            {{--<button type="submit" class="btn btn-default">查询</button>--}}
                            {{--</form>--}}
                            {{--</body>--}}
                            {{--</html>--}}

                            {{--@elseif($SearchOption== 3)--}}
                            {{--<h3>校车查询界面</h3>--}}
                            {{--<!DOCTYPE html>--}}
                            {{--<html>--}}
                            {{--<head>--}}
                            {{--<meta charset="utf-8">--}}
                            {{--<title>Bootstrap 实例 - 选择框</title>--}}
                            {{--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
                            {{--<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>--}}
                            {{--<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
                            {{--</head>--}}
                            {{--<body>--}}
                            {{--<form action="{{ url('/search/carrequest')}}" method="post">--}}
                            {{--<form role="form">--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="name">从：</label>--}}
                            {{--<select type="text" class="form-control" name="qidian">--}}
                            {{--<option>中心校区</option>--}}
                            {{--<option>洪家楼校区</option>--}}
                            {{--<option>软件园校区</option>--}}
                            {{--<option>趵突泉校区</option>--}}
                            {{--<option>兴隆山校区</option>--}}
                            {{--<option>千佛山校区</option>--}}
                            {{--</select>--}}
                            {{--<label for="name">到：</label>--}}
                            {{--<select class="form-control" name="zhongdian">--}}
                            {{--<option>中心校区</option>--}}
                            {{--<option>洪家楼校区</option>--}}
                            {{--<option>软件园校区</option>--}}
                            {{--<option>趵突泉校区</option>--}}
                            {{--<option>兴隆山校区</option>--}}
                            {{--<option>千佛山校区</option>--}}
                            {{--</select>--}}
                            {{--<label for="name">时间：</label>--}}
                            {{--<select class="form-control" name="zhou">--}}
                            {{--<option>工作日</option>--}}
                            {{--<option>非工作日</option>--}}
                            {{--</select>--}}

                            {{--</div>--}}
                            {{--</form>--}}

                            {{--{{ csrf_field() }}--}}
                            {{--<button type="submit" class="btn btn-default">查询</button>--}}
                            {{--</form>--}}
                            {{--</body>--}}
                            {{--</html>--}}
                        @elseif($SearchOption == 4)
                            @if(Auth::user()["j_username"]==null)
                                <h4>貌似你还没有绑定你的学号哦</h4>
                                <form action="{{ url('/link')}}" method="get">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">去绑定</button>
                                </form>
                            @else
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="container">
                                            <div class="row">

                                                <form action="{{ url('/search')}}" method="get">
                                                    {{ csrf_field() }}
                                                    <h3>
                                                        <div class="col-xs-6 col-sm-8">
                                                            学生 <span
                                                                    class="label label-default">{{Auth::user()["j_username"]}}</span>
                                                            成绩查询：
                                                        </div>
                                                        <div class="col-xs-6 col-sm-2">
                                                            {{--<button type="submit" class="btn btn-default">返回</button>--}}</div>
                                                    </h3>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel panel-default">
                                            {{--<div class="panel-heading"><h4>成绩</h4></div>--}}
                                            <div class="panel-body">
                                                <form action="{{ url('/search/grade')}}" method="get">
                                                    <form role="form">
                                                        <div class="form-group">
                                                            <label for="name">请选择学年学期：</label>
                                                            <div class = "row">
                                                            <div class="col-md-11">
                                                            <select type="text" class="form-control" name="xnxq">
                                                                <option>全部</option>
                                                                @foreach($xnxqarray as $item)
                                                                    <option>{{$item}}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                            <button type="submit" class="btn btn-success">查询</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </form>

                                                    {{ csrf_field() }}

                                                </form>
                                                <table class="table table-bordered">
                                                    @foreach($gradearray as $gradearray_1)
                                                        <tr>
                                                            @foreach($gradearray_1 as $gradearray_2)
                                                                <th>{{$gradearray_2}}</th>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        {{$bjgarray}}
                                        @if($bjgarray!=null)
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><h4>不及格成绩</h4></div>
                                            <div class="panel-body">
                                                <table class="table table-bordered">
                                                    @foreach($bjgarray as $bjgarray_1)
                                                        <tr>
                                                            @foreach($bjgarray_1 as $bjgarray_2)
                                                                <th>{{$bjgarray_2}}</th>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection
