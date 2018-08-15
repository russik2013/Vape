@extends("users.base")
@section("content")
    <div class="container">
        @if(!isset($user))
            <p>{{route('users.store')}}</p>
            <form action="{{route('users.store')}}" method="POST">
                <table>
                    {{ csrf_field() }}
                    <tr><td>name - <input name="name"/><br></td></tr>
                    <tr><td>surname - <input name="surname"/><br></td></tr>
                    <tr><td>email - <input type="email" name="email"/><br></td></tr>
                    <tr><td>phone - <input name="phone"/><br></td></tr>
                    <tr><td>password - <input type="password" name="password"/><br></td></tr>
                    <tr><td><button type="submit">Add</button></td></tr>
                </table>
            </form>
        @else
            <form action="{{route('users.update', ['id' => $user->id])}}" method="POST">
                <table>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <tr><td>name - <input name="name" value="{{$user->name}}"/><br></td></tr>
                    <tr><td>surname - <input name="surname" value="{{$user->surname}}"/><br></td></tr>
                    <tr><td>email - <input type="email" name="email" value="{{$user->email}}"/><br></td></tr>
                    <tr><td>phone - <input name="phone" value="{{$user->phone}}"/><br></td></tr>
                    <tr><td>password - <input type="password" name="password" value="{{$user->password}}"/><br></td></tr>
                    <tr><td><button type="submit">Update</button></td></tr>
                </table>
            </form>
        @endif
    </div>
@endsection