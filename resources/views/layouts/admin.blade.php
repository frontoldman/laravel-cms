<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    {!! HTML::style('styles/bootstrap.min.css') !!}
</head>
<body>

<nav class="navbar navbar-inverse">
    <ul class="nav nav-pills">
        <li role="presentation" class="dropdown pull-right">
            <a class="btn btn-default dropdown-toggl" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                {{auth()->user()->username}} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ url('/auth/logout')  }}">退出登陆</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<div class="container">

    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked nav-pills-stacked-example">
                <li role="presentation" class="active"><a href="#">主页</a></li>
                <li role="presentation">
                    <a href="#" class="dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        用户
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">所有用户</a></li>
                        <li><a href="#">添加</a></li>
                        <li><a href="#">角色</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="#">文章</a></li>
            </ul>

        </div>
        <div class="col-md-9">
            @section('container')

            @show
        </div>
    </div>

</div>
<script src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>