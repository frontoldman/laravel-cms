<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    {!! HTML::style('styles/bootstrap.min.css') !!}
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default"  style="margin-top: 50px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Login</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login">
                        <fieldset>
                            @if (Session::has('message'))
                            <div class="form-group">
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error:</span>
                                    {!! Session::get('message') !!}
                                </div>
                            </div>
                            @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" checked name="remember" value="remember"> 记住我
                                </label>
                            </div>
                            <button class="btn btn-lg btn-success btn-block">登陆</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>