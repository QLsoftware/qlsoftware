{{--for 昌奇 TODO 查询界面--}}
@extends('layouts.app')

@section('content')

    <!-- dsfs-->
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">查询</div>
                <div class="panel-body">
                    <div class="row">
                        @if($SearchOption == 0)
                            @if(Auth::user()["j_username"]==null)
                                <h4>貌似你还没有绑定你的学号哦</h4>
                                <form action="{{ url('/link')}}" method="get">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">去绑定</button>
                                </form>

                            @else
                                <form action="{{ url('/search/course')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default">课表查询</button>
                                </form>
                                <form action="{{ url('/search/room')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default">自习室查询</button>
                                </form>
                                <form action="{{ url('/search/car')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default">校车查询</button>
                                </form>
                                <form action="{{ url('/search/grade')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default">绩点查询</button>
                                </form>
                            @endif
                        @elseif($SearchOption == 1)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="container">
                                        <div class="row">

                                <form action="{{ url('/search')}}" method="get">
                                    {{ csrf_field() }}
                                    <h3><div class="col-xs-6 col-sm-8">
                                            学生 <span
                                                class="label label-default">{{Auth::user()["j_username"]}}</span> 的课表：</div>
                                        <div class="col-xs-6 col-sm-2" >
                                    <button type="submit" class="btn btn-default">返回</button></div></h3>
                                </form>
                                </div></div></div>
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
                                </div></div>

                        @elseif($SearchOption == 2)
                            <h2>自习室查询界面</h2>
                        @elseif($SearchOption== 3)
                            <h3>校车查询界面</h3>
                        @elseif($SearchOption == 4)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="container">
                                                <div class="row">

                                                    <form action="{{ url('/search')}}" method="get">
                                                        {{ csrf_field() }}
                                                        <h3><div class="col-xs-6 col-sm-8">
                                                                学生 <span
                                                                        class="label label-default">{{Auth::user()["j_username"]}}</span> 成绩查询：</div>
                                                            <div class="col-xs-6 col-sm-2" >
                                                                <button type="submit" class="btn btn-default">返回</button></div></h3>
                                                    </form>
                                                </div></div></div>
                                        <div class="panel-body">
                                            <div class="panel panel-default">
                                                <div class="panel-heading"><h4>本学期成绩</h4></div>
                                                <div class="panel-body">
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

                                        </div></div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
