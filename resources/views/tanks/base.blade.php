<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@yield("header")
@yield("content")
<footer>
    <a href="{{url('/admin/tanks/create')}}">add new</a>
    <br>
    <a href="{{url('/admin/tanks')}}">all tanks</a>
</footer>
</body>
</html>