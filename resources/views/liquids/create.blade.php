@extends("liquids.base")
@section("content")
    <div class="container">
        @if(!isset($liquid))
            <form action="{{route('liquids.store')}}" method="POST">
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
            <form action="{{route('liquids.update', ['id' => $liquid->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input name="name" value="{{$liquid->name}}"/>
                <button type="submit">Update</button>
            </form>
        @endif
    </div>
@endsection
