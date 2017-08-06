

<link rel="stylesheet" type="text/css"
      href="/res/ui/defineStyle/calendar.css" />
<style>
    .day_ok {
        margin-left: 4px !important;
        margin-top: 2px !important;
        color: white !important;
        background-color: rgb(5, 107, 182) !important;
    }

    .day_no {
        margin-left: 4px !important;
        margin-top: 2px !important;
        color: white !important;
        background-color: rgb(131, 142, 197) !important;
    }
</style>
<!--头部导航信息的制作 -->
<div class="row-fluid">
    <div class="span12" style="margin-top: 15px; height: 50px">
        <ul class="breadcrumb">
            <li><i class="icon-home"></i> <a href="main">主页</a> <i
                    class="icon-angle-right"></i></li>
            <li><a href="javascript:void(0)">选课</a> <i
                    class="icon-angle-right"></i></li>
            <li><a href="javascript:void(0)">本学期课表</a></li>
        </ul>
    </div>
</div>

<!-- 有时间地点课程start -->
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-calendar"></i>  本学期课表 (有时间地点)
                </div>
            </div>
            <!-- 表体 -->
            <div class="portlet-body">
                <div class="my_calendar">
                    <div class="today">
                        <div class="today_calendar e_clear">

                            <div class="today_calendar_pn">
                                <span class="text">学年学期：2017-2018-1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="text"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="calendar">
                        <div class="loadingDiv" id="loadingDiv">
                            <table class="js_tb_head" cellpadding="0" cellspacing="0"
                                   width="100%">
                                <tbody>
                                <tr class="calendar_th">
                                    <th>节次/星期</th>

                                    <th class="weekend">星期一</th>
                                    <th class="weekend">星期二</th>
                                    <th class="weekend">星期三</th>
                                    <th class="weekend">星期四</th>
                                    <th class="weekend">星期五</th>
                                    <th class="weekend">星期六</th>
                                    <th class="weekend">星期日</th>
                                </tr>
                                </tbody>
                            </table>

                            <table class="calendar_table ui-selectable" cellpadding="0"
                                   cellspacing="0" width="100%">
                                <tbody>
                                <tr style="height: 40px;" class="1">
                                    <th class="weekend">第一节</th>
                                    <td valign="top" class="1"></td>
                                    <td valign="top" class="2"></td>
                                    <td valign="top" class="3"></td>
                                    <td valign="top" class="4"></td>
                                    <td valign="top" class="5"></td>
                                    <td valign="top" class="6"></td>
                                    <td valign="top" class="7"></td>
                                </tr>
                                <tr style="height: 40px;" class="2">
                                    <th class="weekend">第二节</th>
                                    <td valign="top" class="1"></td>
                                    <td valign="top" class="2"></td>
                                    <td valign="top" class="3"></td>
                                    <td valign="top" class="4"></td>
                                    <td valign="top" class="5"></td>
                                    <td valign="top" class="6"></td>
                                    <td valign="top" class="7"></td>
                                </tr>
                                <tr style="height: 40px;" class="3">
                                    <th class="weekend">第三节</th>
                                    <td valign="top" class="1"></td>
                                    <td valign="top" class="2"></td>
                                    <td valign="top" class="3"></td>
                                    <td valign="top" class="4"></td>
                                    <td valign="top" class="5"></td>
                                    <td valign="top" class="6"></td>
                                    <td valign="top" class="7"></td>
                                </tr>
                                <tr style="height: 40px;" class="4">
                                    <th class="weekend">第四节</th>
                                    <td valign="top" class="1"></td>
                                    <td valign="top" class="2"></td>
                                    <td valign="top" class="3"></td>
                                    <td valign="top" class="4"></td>
                                    <td valign="top" class="5"></td>
                                    <td valign="top" class="6"></td>
                                    <td valign="top" class="7"></td>
                                </tr>
                                <tr style="height: 40px;" class="5">
                                    <th class="weekend">第五节</th>
                                    <td valign="top" class="1"></td>
                                    <td valign="top" class="2"></td>
                                    <td valign="top" class="3"></td>
                                    <td valign="top" class="4"></td>
                                    <td valign="top" class="5"></td>
                                    <td valign="top" class="6"></td>
                                    <td valign="top" class="7"></td>
                                </tr>
                                <tr style="height: 40px;" class="6">
                                    <th class="weekend">第六节</th>
                                    <td valign="top" class="1"></td>
                                    <td valign="top" class="2"></td>
                                    <td valign="top" class="3"></td>
                                    <td valign="top" class="4"></td>
                                    <td valign="top" class="5"></td>
                                    <td valign="top" class="6"></td>
                                    <td valign="top" class="7"></td>
                                </tr>
                                <tr style="height: 40px;" class="7">
                                    <th class="weekend">第七节</th>
                                    <td valign="top" class="1"></td>
                                    <td valign="top" class="2"></td>
                                    <td valign="top" class="3"></td>
                                    <td valign="top" class="4"></td>
                                    <td valign="top" class="5"></td>
                                    <td valign="top" class="6"></td>
                                    <td valign="top" class="7"></td>
                                </tr>
                                </tbody>
                            </table>
                            <h5>详细上课信息</h5>
                            <table class="table table-striped table-bordered table-hover"
                                   id="ysjddDataTableId">
                                <tr>
                                    <th width="3%">序号</th>
                                    <th width="8%">课程号</th>
                                    <th width="18%">课程名称</th>
                                    <th width="4%">课序号</th>
                                    <th width="3%">学分</th>
                                    <th width="5%">课程属性</th>
                                    <th width="6%">开课学院</th>
                                    <th>任课教师</th>
                                    <th width="15%">上课周次</th>
                                    <th width="4%">上课星期</th>
                                    <th width="4%">上课节次</th>
                                    <th>上课地点</th>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>sd01320190</td>
                                    <td>操作系统课程设计(双语)</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>韩芳溪3</td>
                                    <td>111111111111000000000000</td>

                                    <td>3</td>
                                    <td>2</td>
                                    <td>青岛校区振声苑W302</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>操作系统课程设计(双语)(必修)-韩芳溪3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="2"] td[class="3"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>2</td>
                                    <td>sd01320190</td>
                                    <td>操作系统课程设计(双语)</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>韩芳溪3</td>
                                    <td>111111111111000000000000</td>

                                    <td>1</td>
                                    <td>1</td>
                                    <td>青岛校区振声苑W302</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>操作系统课程设计(双语)(必修)-韩芳溪3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="1"] td[class="1"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>3</td>
                                    <td>sd01330440</td>
                                    <td>计算机网络课程设计</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>张华忠2</td>
                                    <td>111111111111000000000000</td>

                                    <td>1</td>
                                    <td>2</td>
                                    <td>青岛校区振声苑E308</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>计算机网络课程设计(必修)-张华忠2</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="2"] td[class="1"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>4</td>
                                    <td>sd01330440</td>
                                    <td>计算机网络课程设计</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>张华忠2</td>
                                    <td>111111111111000000000000</td>

                                    <td>2</td>
                                    <td>1</td>
                                    <td>青岛校区振声苑E308</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>计算机网络课程设计(必修)-张华忠2</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="1"] td[class="2"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>5</td>
                                    <td>sd01330470</td>
                                    <td>计算引论(双语)</td>
                                    <td>100</td>
                                    <td>2</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>冯好娣2</td>
                                    <td>111111111111111111000000</td>

                                    <td>2</td>
                                    <td>3</td>
                                    <td>青岛校区振声苑W102</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>计算引论(双语)(限选)-冯好娣2</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="3"] td[class="2"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>6</td>
                                    <td>sd01331150</td>
                                    <td>数值计算</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>刘保东2</td>
                                    <td>111111111111111100000000</td>

                                    <td>1</td>
                                    <td>4</td>
                                    <td>青岛校区振声苑N404</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>数值计算(限选)-刘保东2</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="4"] td[class="1"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>7</td>
                                    <td>sd01331150</td>
                                    <td>数值计算</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>刘保东2</td>
                                    <td>111111111111111100000000</td>

                                    <td>3</td>
                                    <td>4</td>
                                    <td>青岛校区振声苑N404</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>数值计算(限选)-刘保东2</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="4"] td[class="3"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>8</td>
                                    <td>sd01331240</td>
                                    <td>Web技术</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>杨义军3</td>
                                    <td>111111111111111100000000</td>

                                    <td>1</td>
                                    <td>3</td>
                                    <td>青岛校区振声苑W301</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>Web技术(限选)-杨义军3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="3"] td[class="1"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>9</td>
                                    <td>sd01331240</td>
                                    <td>Web技术</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>杨义军3</td>
                                    <td>111111111111111100000000</td>

                                    <td>2</td>
                                    <td>4</td>
                                    <td>青岛校区振声苑W301</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>Web技术(限选)-杨义军3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="4"] td[class="2"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>10</td>
                                    <td>sd01331270</td>
                                    <td>编译原理与技术</td>
                                    <td>1</td>
                                    <td>3.5</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>王丽荣3</td>
                                    <td>111111111111111100000000</td>

                                    <td>5</td>
                                    <td>2</td>
                                    <td>青岛校区振声苑E308</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>编译原理与技术(必修)-王丽荣3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="2"] td[class="5"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>11</td>
                                    <td>sd01331270</td>
                                    <td>编译原理与技术</td>
                                    <td>1</td>
                                    <td>3.5</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>王丽荣3</td>
                                    <td>111111111111111100000000</td>

                                    <td>3</td>
                                    <td>1</td>
                                    <td>青岛校区振声苑E308</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>编译原理与技术(必修)-王丽荣3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="1"] td[class="3"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>12</td>
                                    <td>sd01331410</td>
                                    <td>汇编语言</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>杨静3</td>
                                    <td>111111111111111100000000</td>

                                    <td>3</td>
                                    <td>3</td>
                                    <td>青岛校区振声苑N202</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>汇编语言(限选)-杨静3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="3"] td[class="3"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>13</td>
                                    <td>sd01331410</td>
                                    <td>汇编语言</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>杨静3</td>
                                    <td>111111111111111100000000</td>

                                    <td>5</td>
                                    <td>1</td>
                                    <td>青岛校区振声苑N101</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>汇编语言(限选)-杨静3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="1"] td[class="5"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>14</td>
                                    <td>sd01331421</td>
                                    <td>机器学习（双语）</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>李峰4</td>
                                    <td>111111111111111100000000</td>

                                    <td>4</td>
                                    <td>2</td>
                                    <td>青岛校区振声苑N406</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>机器学习（双语）(限选)-李峰4</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="2"] td[class="4"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>15</td>
                                    <td>sd01331421</td>
                                    <td>机器学习（双语）</td>
                                    <td>100</td>
                                    <td>3</td>
                                    <td>限选</td>
                                    <td>计算机学院</td>
                                    <td>李峰4</td>
                                    <td>111111111111111100000000</td>

                                    <td>2</td>
                                    <td>5</td>
                                    <td>青岛校区振声苑N406</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>机器学习（双语）(限选)-李峰4</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="5"] td[class="2"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>16</td>
                                    <td>sd01331480</td>
                                    <td>计算机组成与设计课程设计</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>张瑞华3</td>
                                    <td>111111111111000000000000</td>

                                    <td>2</td>
                                    <td>2</td>
                                    <td>青岛校区振声苑E308</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>计算机组成与设计课程设计(必修)-张瑞华3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="2"] td[class="2"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>17</td>
                                    <td>sd01331480</td>
                                    <td>计算机组成与设计课程设计</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>必修</td>
                                    <td>计算机学院</td>
                                    <td>张瑞华3</td>
                                    <td>111111111111000000000000</td>

                                    <td>4</td>
                                    <td>1</td>
                                    <td>青岛校区振声苑E308</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>计算机组成与设计课程设计(必修)-张瑞华3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="1"] td[class="4"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>18</td>
                                    <td>sd02810360</td>
                                    <td>毛泽东思想和中国特色社会主义理论体系概论</td>
                                    <td>316</td>
                                    <td>6</td>
                                    <td>必修</td>
                                    <td>马克思学院</td>
                                    <td>陈桂香3</td>
                                    <td>111111111111111100000000</td>

                                    <td>5</td>
                                    <td>4</td>
                                    <td>青岛校区振声苑S405</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>毛泽东思想和中国特色社会主义理论体系概论(必修)-陈桂香3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="4"] td[class="5"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>19</td>
                                    <td>sd02810360</td>
                                    <td>毛泽东思想和中国特色社会主义理论体系概论</td>
                                    <td>316</td>
                                    <td>6</td>
                                    <td>必修</td>
                                    <td>马克思学院</td>
                                    <td>陈桂香3</td>
                                    <td>111111111111111100000000</td>

                                    <td>6</td>
                                    <td>2</td>
                                    <td>青岛校区振声苑S405</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>毛泽东思想和中国特色社会主义理论体系概论(必修)-陈桂香3</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="2"] td[class="6"]')
                                        .html(node);
                                </script>

                                <tr>
                                    <td>20</td>
                                    <td>sd09010050</td>
                                    <td>形势政策与社会实践(5)</td>
                                    <td>343</td>
                                    <td>0</td>
                                    <td>必修</td>
                                    <td>学工部</td>
                                    <td></td>
                                    <td>000001010101010100000000</td>

                                    <td>4</td>
                                    <td>3</td>
                                    <td>青岛校区振声苑E205</td>
                                </tr>

                                <script>
                                    var node = "";
                                    node += '<div class="day_ok"  title="课程名\n课程属性">';
                                    node += '<center><span class="text"><h5>形势政策与社会实践(5)(必修)-</h5></span></center>';
                                    node += '</div>';
                                    $(
                                        'tr[class="3"] td[class="4"]')
                                        .html(node);
                                </script>

                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- 无时间地点课程start -->
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box light-grey">
            <!-- 标题 -->
            <div class="portlet-title ">
                <div class="caption">
                    <i class="icon-reorder"></i> 本学期课表 (无时间地点)
                </div>
                <div class="actions"></div>
            </div>
            <!-- 表体 -->
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover"
                       id="wsjddDataTableId">
                    <tr>
                        <th width="3%">序号</th>
                        <th width="8%">课程号</th>
                        <th width="20%">课程名称</th>
                        <th width="4%">课序号</th>
                        <th width="3%">学分</th>
                        <th width="5%">课程属性</th>
                        <th width="10%">开课学院</th>
                        <th>任课教师</th>

                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>