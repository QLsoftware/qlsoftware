<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>智慧山大</title>
    <meta name="description"
          content="智慧大法好"/>
    <meta name="author" content="templatemo">
    <!-- Favicon-->
    <link rel="shortcut icon" href="./favicon.png"/>
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Camera -->
    <link href="css/camera.css" rel="stylesheet">
    <!-- Template  -->
    <link href="css/templatemo_style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>

<body>
{{--目录--}}
<div id="templatemo_mobile_menu">
<ul class="nav nav-pills nav-stacked">
    @if (Auth::guest())
        <li><a href="{{ url('/login') }}">登陆</a></li>
        <li><a href="{{ url('/register') }}">注册</a></li>
        <li><a href="{{ url('/admin') }}">开发者权限</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-expanded="false"
               style="position: relative; padding-left: 50%">
                <img src="{{ Auth::user()->avatar }}"
                     style="width: 32px;height: 32px;position: absolute; top: 10px;left: 10px;border-radius: 50%;">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a><i class='glyphicon glyphicon-user'></i>{{ Auth::user()->name }}</a></li>
                <li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-cog"></i> 设置</a></li>
                <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i>退出</a>
                </li>
            </ul>
        </li>
    @endif
{{--<li><a href="#templatemo_banner_slide"><i class="glyphicon glyphicon-home"></i> &nbsp; Home</a></li>--}}
{{--<li><a href="#templatemo_about"><i class="glyphicon glyphicon-briefcase"></i> &nbsp; About</a></li>--}}
{{--<li><a href="#templatemo_events"><i class="glyphicon glyphicon-bullhorn"></i> &nbsp; Events</a></li>--}}
{{--<li><a href="#templatemo_timeline"><i class="glyphicon glyphicon-calendar"></i> &nbsp; Timeline</a></li>--}}
{{--<li><a href="#templatemo_contact"><i class="glyphicon glyphicon-phone-alt"></i> &nbsp; Contact</a></li>--}}
</ul>
</div>

{{--也是目录--}}
<div class="container_wapper c">
    <div id="templatemo_banner_menu">
        <div class="container-fluid">
            <div class="col-xs-4 templatemo_logo">
                {{--<a rel="nofollow" href="http://www.cssmoban.com/preview/templatemo_411_dragonfruit">--}}
                <img src="images/templatemo_logo.jpg" id="logo_img" alt="dragonfruit free html5 template"/>
                <h2 id="logo_text">智慧<span>山大</span></h2>
                {{--</a>--}}
            </div>
            <div class="col-sm-8 hidden-xs">
                <ul class="nav nav-justified">

                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">登陆</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>
                        <li><a href="{{ url('/admin') }}">开发者权限</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"
                               style="position: relative; padding-left: 50%">
                                <img src="{{ Auth::user()->avatar }}"
                                     style="width: 32px;height: 32px;position: absolute; top: 10px;left: 10px;border-radius: 50%;">
                                 {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a><i class='glyphicon glyphicon-user'></i>{{ Auth::user()->name }}</a></li>
                                <li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-cog"></i> 设置</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i>退出</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    {{--<li><a href="  {{ url('/search/course') }}">课程查询</a></li>--}}
                    {{--<li><a href="  {{ url('/search/grade') }}">成绩查询</a></li>--}}
                    {{--<li><a href="{{ url('/evaluate') }}">教师评价</a></li>--}}
                    {{--<li><a href="  {{ url('/fee') }}">缴费</a></li>--}}
                    {{--<li><a href="  {{ url('/book') }}">图书馆</a></li>--}}
                    {{--<li><a href="  {{ url('/fix') }}">报修</a></li>--}}
                    {{--<li><a href="{{ url('/zjt/getc') }}">抢课</a></li>--}}
                    {{--<li><a href="{{ url('/forums') }}">闲谈</a></li>--}}
                    {{--<li><a href="{{ url('/pan') }}">网盘</a></li>--}}
                    {{--<li><a href=" {{ url('/repairman/index')}}">维修人员入口</a></li>--}}


                    {{--<li><a href="#templatemo_banner_slide">主页</a></li>--}}
                    {{--<li><a href="#templatemo_about">功能导航</a></li>--}}
                    {{--<li><a href="#templatemo_events">最近事件</a></li>--}}
                    {{--<li><a href="#templatemo_timeline">时间轴</a></li>--}}
                    {{--@if (Auth::guest())--}}
                        {{--<li><a href="#templatemo_contact">进入智慧山大</a></li>--}}
                    {{--@else--}}
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                               {{--aria-expanded="false"--}}
                               {{--style="position: relative; padding-left: 50%">--}}
                                {{--<img src="{{ Auth::user()->avatar }}"--}}
                                     {{--style="width: 32px;height: 32px;position: absolute; top: 10px;left: 10px;border-radius: 50%;">--}}
                                 {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li><a><i class='glyphicon glyphicon-user'></i>{{ Auth::user()->name }}</a></li>--}}
                                {{--<li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-cog"></i> 设置</a></li>--}}
                                {{--<li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i>退出</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--@endif--}}

                </ul>
            </div>
            <div class="col-xs-8 visible-xs">
                <a href="#" id="mobile_menu"><span class="glyphicon glyphicon-th-list"></span></a>
            </div>
        </div>
    </div>
</div>


@yield('content')
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.singlePageNav.min.js"></script>
<script src="js/unslider.min.js"></script>

<script src="js/templatemo_script.js"></script>
</body>
</html>

