<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>智慧山大</title>

    <!-- Bootstrap Core CSS -->
    <link href="elevator/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="elevator/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="elevator/css/animate.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="elevator/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>


    <!-- Template js -->
    <script src="elevator/js/jquery-2.1.1.min.js"></script>
    <script src="elevator/bootstrap/js/bootstrap.min.js"></script>
    <script src="elevator/js/jquery.appear.js"></script>
    <script src="elevator/js/contact_me.js"></script>
    <script src="elevator/js/jqBootstrapValidation.js"></script>
    <script src="elevator/js/modernizr.custom.js"></script>
    <script src="elevator/js/script.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Start Logo Section -->
<section id="logo-section" class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo text-center">
                    <h1>智慧山大</h1>
                    <span>为你的校园生活添加便捷</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Logo Section -->


<!-- Start Main Body Section -->
<div class="mainbody-section text-center">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <!--登录-->
                <div class="menu-item blue">
                    @if (Auth::guest())
                        <a href="{{ url('/login') }}" data-toggle="modal">
                            <i class="glyphicon glyphicon-user"></i>
                            <p>登录</p>
                        </a>
                    @else
                        <a href="{{ url('/profile') }}" data-toggle="modal">
                            <i class="glyphicon glyphicon-cog"></i>
                            <p>{{ Auth::user()->name }}的设置</p>
                        </a>
                    @endif
                </div>
                <!--课程查询-->
                <div class="menu-item green">
                    <a href="{{ url('/search/course') }}" data-toggle="modal">
                        <i class="glyphicon glyphicon-search"></i>
                        <p>课程查询</p>
                    </a>
                </div>
                <!--成绩查询-->
                <div class="menu-item light-red">
                    <a href="{{ url('/search/grade') }}" data-toggle="modal">
                        <i class="glyphicon glyphicon-search"></i>
                        <p>成绩查询</p>
                    </a>
                </div>

            </div>

            <div class="col-md-6">

                <!-- Start Carousel Section -->
                <div class="home-slider">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                         style="padding-bottom: 40px;">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- 滚动图片 -->
                        <div class="carousel-inner">
                            <div class=" active item menu-item light-orange">
                                {{--<a href="{{ url('/forums') }}" data-toggle="modal">--}}
                                @foreach($a1 as $a)
                                    <a href={{$a->href}}> {{$a->title.'  '.$a->data}}</a>
                                @endforeach
                                {{--</a>--}}
                            </div>
                            <div class="item menu-item green">
                                {{--<a href="{{ url('/forums') }}" data-toggle="modal">--}}
                                @foreach($a2 as $a)
                                    <a href={{$a->href}}> {{$a->title.'  '.$a->data}}</a>
                                @endforeach
                                {{--</a>--}}
                            </div>
                            <div class="item menu-item red">
                                {{--<a href="{{ url('/forums') }}" data-toggle="modal">--}}
                                @foreach($a3 as $a)
                                    <a href={{$a->href}}> {{$a->title.'  '.$a->data}}</a>
                                @endforeach
                                {{--</a>--}}
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Start Carousel Section -->


                <div class="row">
                    <div class="col-md-6">
                        <div class="menu-item color responsive">
                            <a href="{{ url('/pan') }}" data-toggle="modal">
                                <i class="glyphicon glyphicon-file"></i>
                                <p>网盘</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="menu-item light-orange responsive-2">
                            <a href="{{ url('/evaluate') }}" data-toggle="modal">
                                <i class="glyphicon glyphicon-thumbs-up"></i>
                                <p>教师评价</p>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
            <!--第三列   报修抢课  闲谈-->
            <div class="col-md-3">

                <div class="menu-item light-red">
                    <a href="{{ url('/fix') }}" data-toggle="modal">
                        <i class="glyphicon glyphicon-wrench"></i>
                        <p>报修</p>
                    </a>
                </div>

                <div class="menu-item color">
                    <a href="{{ url('/zjt/getc') }}" data-toggle="modal">
                        <i class="glyphicon glyphicon-hdd"></i>
                        <p>自动选课</p>
                    </a>
                </div>
                <div class="menu-item blue">
                    <a href="{{ url('/forums') }}" data-toggle="modal">
                        <i class="glyphicon glyphicon-fire"></i>
                        <p>闲谈</p>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Main Body Section -->

<!-- Start Copyright Section -->
<div class="copyright text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>Copyright &copy; 2017 <a href="{{ url('/admin') }}">智慧山大</a> <a
                            href=" {{ url('/admin/repair')}}">维修人员入口</a></div>
            </div>
        </div>
    </div>
</div>
<!-- End Copyright Section -->



</body>

</html>