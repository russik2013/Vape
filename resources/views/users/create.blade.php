@extends("users.base")
@section("content")
    <div class="container">
        @if(!isset($user))
            <form action="{{route('users.store')}}" method="POST">
                <table>
                    {{ csrf_field() }}
                    @if ($errors->has('name'))
                        <p> {{$errors -> first('name')}} </p>
                    @endif
                    <tr><td>name - <input name="name" value="{{old('name')}}"/><br></td></tr>
                    @if ($errors->has('surname'))
                        <p> {{$errors -> first('surname')}} </p>
                    @endif
                    <tr><td>surname - <input name="surname" value="{{old('surname')}}"/><br></td></tr>
                    @if ($errors->has('email'))
                        <p> {{$errors -> first('email')}} </p>
                    @endif
                    <tr><td>email - <input type="email" name="email" value="{{old('email')}}"/><br></td></tr>
                    @if ($errors->has('phone'))
                        <p> {{$errors -> first('phone')}} </p>
                    @endif
                    <tr><td>phone - <input name="phone" value="{{old('phone')}}"/><br></td></tr>
                    @if ($errors->has('password'))
                        <p> {{$errors -> first('password')}} </p>
                    @endif
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