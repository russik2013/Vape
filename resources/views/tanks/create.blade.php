@extends("tanks.base")
@section("content")
    @if(isset($isAdded) && $isAdded == true)
        <p>Tank added.</p>
    @elseif(isset($isUpdated) && $isUpdated == true)
        <p>Tank updated.</p>
    @endif
    <div class="container">
        @if(!isset($tank))
        <form action="{{route('tanks.store')}}" method="POST">
            {{ csrf_field() }}
            <input name="name"/> <button type="submit">Add</button>
            {{--<br/>--}}
            {{--<select name="params[name]">--}}
                {{--<option>name1</option>--}}
                {{--<option>name2</option>--}}
            {{--</select>--}}
            {{--<input name="params[value]"/>--}}


        </form>
        <br/>
            <button>Add params</button>
        @else
        <form action="{{route('tanks.update', ['id' => $tank->id])}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input name="name" value="{{$tank->name}}"/>
            <button type="submit">Update</button>
        </form>
        @endif
    </div>
@endsection
