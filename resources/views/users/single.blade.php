@extends("users.base")
@section("content")
    <div class="container">
        <table>
            <tr><td>id = {{$user->id}}</td></tr>
            <tr><td>name = {{$user->name}}</td></tr>
            <tr><td>surname = {{$user->surname}}</td></tr>
            <tr><td>email = {{$user->email}}</td></tr>
            <tr><td>phone = {{$user->phone}}</td></tr>
            <tr><td>password = {{$user->password}}</td></tr>
            <tr><td>created at = {{$user->created_at}}</td></tr>
            <tr><td>updated at = {{$user->updated_at}}</td></tr>
        </table>
    </div>
@endsection
