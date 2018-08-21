<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/jquery.js')}}"></script>
    <title>Tanks</title>
</head>
<body id="bd">
@yield("header")
@yield("content")
<footer>
    <a href="{{route('tanks.create')}}">add new</a>
    <br>
    <a href="{{route('tanks.index')}}">all tanks</a>
</footer>
</body>
</html>