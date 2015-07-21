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
                    <h3 class="panel-title">注册帐号</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="register">
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

                            @if ($errors->has())
                                <div class="form-group">
                                    <div class="alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>
                                        {!! $errors->first() !!}
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="username" name="username" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password-confirm" name="password-confirm" type="password"/>
                            </div>

                            <button class="btn btn-lg btn-success btn-block">注册</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>