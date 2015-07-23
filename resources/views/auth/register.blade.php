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
                    {!! FORM::open(array('action' => 'Auth\AuthController@postRegister','method' => 'post','novalidate','role' => 'form')) !!}
                        <fieldset>
                            @if ($errors->has())
                                <div class="form-group">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            {!! $error !!}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                {!! FORM::email('email', @$email,array('class'=>'form-control','placeholder'=>'E-mail','autofocus')) !!}
                            </div>
                            <div class="form-group">
                                {!! FORM::text('username', @$username,array('class'=>'form-control','placeholder'=>'username')) !!}
                            </div>
                            <div class="form-group">
                                {!! FORM::password('password', array('class'=>'form-control','placeholder'=>'password')) !!}
                            </div>
                            <div class="form-group">
                                {!! FORM::password('passwordConfirm', array('class'=>'form-control','placeholder'=>'passwordConfirm')) !!}
                            </div>
                                {!! FORM::submit('注册', array('class'=>'btn btn-lg btn-success btn-block')) !!}
                        </fieldset>
                    {!! FORM::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>