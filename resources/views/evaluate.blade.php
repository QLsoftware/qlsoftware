{{--for 昌奇 TODO 评估界面--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">教师评估</div>
                    <div class="panel-body">
                        <div class="row">
                            <table class="table table-bordered">
                                <tr>
                                    <th>课程号</th>
                                    <th>课程名</th>
                                    <th>教师名</th>
                                    <th>学年学期</th>
                                    <th>教师号</th>
                                    <th>评估次数</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($option as $option_1)
                                    <tr>
                                        @foreach($option_1 as $option_2)
                                            <th>{{$option_2}}</th>
                                        @endforeach
                                            <th><div class="dropdown">
                                                    <button type="label" class="well well-sm" id="dropdownMenu1" data-toggle="dropdown">--请选择操作--
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
{{--                                                        <li><a href="  {{ url('202.194.15.39') }}">进入问卷</a></li>--}}
                                                        <li><a href="  {{ url('http://bkjws.sdu.edu.cn/f/pg/xs/jrwq?xnxq='.$option_1['3'].'&kch='.$option_1['0'].'&jsh='.$option_1['4']) }}">进入问卷</a></li>
{{--                                                        <li><a href="  {{ url('/evaluate/yijian') }}"  xnxq="{{$option_1;['3']}}" kch="{{$option_1['0']}}" jsh="{{$option_1['4']}}">一键好评</a></li>--}}
                                                        <li><form action="{{ url('/evaluate/yijian')}}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="xnxq" value={{$option_1['3']}}>
                                                                <input type="hidden" name="kch" value={{$option_1['0']}}>
                                                                <input type="hidden" name="jsh" value={{$option_1['4']}}>
                                                                <button type="submit" class="btn btn-default">一键好评</button>
                                                            </form></li>
                                                    </ul>
                                                </div></th>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
