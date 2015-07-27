<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    {!! HTML::style('styles/bootstrap.min.css') !!}
</head>
<body>

<div class="container">

    @section('container')
        <p>This is appended to the master sidebar.</p>
    @show

</div>

</body>
</html>