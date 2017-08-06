{{--for 昌奇 TODO 查询界面--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">查询</div>
                <div class="panel-body">
                    <div class="row">
                        @if($SearchOption == 0)
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
                        @elseif($SearchOption == 1)
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3>学生 <span
                                        class="label label-default">{{Auth::user()["j_username"]}}</span> 的课表：</h3></div>
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

                        @elseif($SearchOption == 2)
                            <h2>自习室查询界面</h2>
                        @elseif($SearchOption== 3)
                            <h3>校车查询界面</h3>
                        @elseif($SearchOption == 4)
                            <h4>绩点查询界面</h4>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
