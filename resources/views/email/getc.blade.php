{{--邮件模板--}}
@if($status==1)
    恭喜你,你在智慧山大上的抢课任务:<br>
    课程号:{{$kch}}课序号:{{$kxh}}课程名称:{{$name}}<br>
    抢课成功,请查看
    <a href= {{url('\')}} >智慧山大课表查询</a>
@elseif($status==-2)
    抱歉,你在智慧山大上的抢课任务:<br>
    课程号:{{$kch}}课序号:{{$kxh}}课程名称:{{$name}}<br>
    出现异常,请检查任务
    <a href= {{url('\getc')}} >智慧山大抢课任务表</a>
@endif