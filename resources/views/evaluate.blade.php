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
                            @if($where==1)
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
                                                        <li><form action="{{ url('/evaluate/jump')}}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="xnxq" value={{$option_1['3']}}>
                                                                <input type="hidden" name="kch" value={{$option_1['0']}}>
                                                                <input type="hidden" name="jsh" value={{$option_1['4']}}>
                                                                <button type="submit" class="btn btn-default">进入问卷</button>
                                                            </form></li>
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
                            @elseif($where==2)
                                <table class="table table-bordered">
                                    <form action="{{ url('/evaluate/tijiao')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="xnxq" id="xnxq" value={{$xnxq}}>
                                        <input type="hidden" name="kch" id="kch" value={{$kch}}>
                                        <input type="hidden" name="jsh" id="jsh" value={{$jsh}}>

                                        <tr>
                                            <th width="20%">评估项目</th>
                                            <th width="40%">评估指标</th>
                                            <th width="40%">填写答案</th>
                                        </tr>

                                        <tr>

                                            <td rowspan="5">
                                                教学规范性
                                            </td>


                                            <td>
                                                教师公布联系方式，课外能够联系和指导学生

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_0" name="zbda_0" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_0" name="zbda_0" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_0" name="zbda_0" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_0" name="zbda_0" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_0" name="zbda_0" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                教师公布教学大纲、考试大纲、考核方式和成绩计算方法

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_1" name="zbda_1" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_1" name="zbda_1" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_1" name="zbda_1" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_1" name="zbda_1" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_1" name="zbda_1" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                教师公布教学日历并执行

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_2" name="zbda_2" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_2" name="zbda_2" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_2" name="zbda_2" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_2" name="zbda_2" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_2" name="zbda_2" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                教师公布课程（课堂）教学目标并落实

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_3" name="zbda_3" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_3" name="zbda_3" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_3" name="zbda_3" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_3" name="zbda_3" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_3" name="zbda_3" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                教师推荐的教材和参考书对学习有帮助

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_4" name="zbda_4" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_4" name="zbda_4" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_4" name="zbda_4" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_4" name="zbda_4" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_4" name="zbda_4" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>
                                        <tr>

                                            <td rowspan="6">
                                                教学态度
                                            </td>


                                            <td>
                                                教师重视教学，备课充分，课堂教学流畅

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_5" name="zbda_5" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_5" name="zbda_5" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_5" name="zbda_5" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_5" name="zbda_5" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_5" name="zbda_5" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                教师能够通过课程网站或纸质等形式提供丰富的课程学习资源

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_6" name="zbda_6" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_6" name="zbda_6" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_6" name="zbda_6" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_6" name="zbda_6" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_6" name="zbda_6" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                教师关注学生反馈，能够及时调整和改进教学

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_7" name="zbda_7" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_7" name="zbda_7" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_7" name="zbda_7" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_7" name="zbda_7" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_7" name="zbda_7" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>


                                        <tr>

                                            <td>
                                                教师注重启发和培养学生的学习兴趣

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_8" name="zbda_8" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_8" name="zbda_8" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_8" name="zbda_8" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_8" name="zbda_8" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_8" name="zbda_8" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                教师关注学生听课状况，能够有效组织课堂教学

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_9" name="zbda_9" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_9" name="zbda_9" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_9" name="zbda_9" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_9" name="zbda_9" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_9" name="zbda_9" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                教师能够及时批改作业和试卷并及时反馈和指导学生改进学习

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_10" name="zbda_10" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_10" name="zbda_10" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_10" name="zbda_10" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_10" name="zbda_10" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_10" name="zbda_10" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td rowspan="6">
                                                教学水平和有效性
                                            </td>


                                            <td>
                                                教师的讲解有助于学生对概念和原理的理解

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_11" name="zbda_11" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_11" name="zbda_11" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_11" name="zbda_11" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_11" name="zbda_11" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_11" name="zbda_11" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                教师注重互动，学生参与教学的程度高

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_12" name="zbda_12" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_12" name="zbda_12" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_12" name="zbda_12" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_12" name="zbda_12" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_12" name="zbda_12" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                教学内容新颖丰富，能够联系专业、实际和前沿，注重培养学生的能力、素质和情感

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_13" name="zbda_13" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_13" name="zbda_13" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_13" name="zbda_13" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_13" name="zbda_13" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_13" name="zbda_13" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                注重培养学生的自主学习能力，课外学习任务明确并注重检查督促

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_14" name="zbda_14" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_14" name="zbda_14" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_14" name="zbda_14" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_14" name="zbda_14" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_14" name="zbda_14" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                注重培养学生的批判性思维、创新意识和综合能力

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_15" name="zbda_15" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_15" name="zbda_15" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_15" name="zbda_15" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_15" name="zbda_15" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_15" name="zbda_15" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                注重日常学习考核，督促学生学习的效果好

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_16" name="zbda_16" value="5.0"> 很好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_16" name="zbda_16" value="4.0"> 较好&nbsp;&nbsp;

                                                <input type="radio" id="zbda_16" name="zbda_16" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_16" name="zbda_16" value="2.0"> 较差&nbsp;&nbsp;

                                                <input type="radio" id="zbda_16" name="zbda_16" value="1.0"> 很差&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td rowspan="5">
                                                整体评价
                                            </td>


                                            <td>
                                                课程设置的必要性和对个人发展的意义

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_17" name="zbda_17" value="5.0"> 很必要&nbsp;&nbsp;

                                                <input type="radio" id="zbda_17" name="zbda_17" value="4.0"> 较必要&nbsp;&nbsp;

                                                <input type="radio" id="zbda_17" name="zbda_17" value="3.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_17" name="zbda_17" value="2.0"> 较少价值&nbsp;&nbsp;

                                                <input type="radio" id="zbda_17" name="zbda_17" value="1.0"> 无价值&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                对课程教学效果的整体评价

                                            </td>

                                            <td>


                                                <input type="radio" id="zbda_18" name="zbda_18" value="10.0"> 很满意&nbsp;&nbsp;

                                                <input type="radio" id="zbda_18" name="zbda_18" value="8.0"> 较满意&nbsp;&nbsp;

                                                <input type="radio" id="zbda_18" name="zbda_18" value="6.0"> 一般&nbsp;&nbsp;

                                                <input type="radio" id="zbda_18" name="zbda_18" value="4.0"> 较不满意&nbsp;&nbsp;

                                                <input type="radio" id="zbda_18" name="zbda_18" value="2.0"> 很不满意&nbsp;&nbsp;





                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                课程的挑战性和难度

                                            </td>

                                            <td>



                                                <input type="radio" id="zbda_19" name="zbda_19" value="课程过难"> 课程过难&nbsp;&nbsp;

                                                <input type="radio" id="zbda_19" name="zbda_19" value="课程有挑战性"> 课程有挑战性&nbsp;&nbsp;

                                                <input type="radio" id="zbda_19" name="zbda_19" value="课程难度适中"> 课程难度适中&nbsp;&nbsp;

                                                <input type="radio" id="zbda_19" name="zbda_19" value="课程偏易"> 课程偏易&nbsp;&nbsp;

                                                <input type="radio" id="zbda_19" name="zbda_19" value="课程没有难度"> 课程没有难度&nbsp;&nbsp;




                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                您是否推荐该课程参加教学效果优秀教师或优秀课程评选

                                            </td>

                                            <td>



                                                <input type="radio" id="zbda_20" name="zbda_20" value="推荐"> 推荐&nbsp;&nbsp;

                                                <input type="radio" id="zbda_20" name="zbda_20" value="不推荐"> 不推荐&nbsp;&nbsp;




                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                您对课程满意/不满意的主要原因

                                                <font color="red">*</font>

                                            </td>

                                            <td>




                                                <textarea rows="5" cols="40" name="zbda_21" id="zbda_21"></textarea>

                                            </td>
                                        </tr>

                                        <button type="submit" class="btn btn-default">提交</button>
                                    </form>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
