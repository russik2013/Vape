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
                    <tr><td><button type="submit" id="submitButton">Add</button></td></tr>
                </table>
            </form>
            <br/>
            <button onclick="onAddSetting( '{{route('additionalSettingsForUsers')}}', 'submitButton' )">Add tanks</button>
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
                    <tr><td><button type="submit" id="submitUpdateButton">Update</button></td></tr>
                </table>
            </form>
            <br/>
            <button onclick="onAddSetting( '{{route('additionalSettingsForUsers')}}', 'submitUpdateButton' )">Add tanks</button>
            <br/>
            <script>
                var tanksNames = <?php echo json_encode( $tanks_names );?>;
                $(document).ready(function() {
                    loadTanksWhenUpdate( '{{$user->tanks->count()}}', '{{route('additionalSettingsForUsers')}}', 'submitUpdateButton'
                        , tanksNames);
                });
            </script>
        @endif
    </div>
    <script type="text/javascript" src="{{asset('js/onAddSettingToTank.js')}}"></script>
@endsection