@extends("modes.base")
@section("content")
    {{--@if(isset($isAdded) && $isAdded == true)--}}
        {{--<p>Tank added.</p>--}}
    {{--@elseif(isset($isUpdated) && $isUpdated == true)--}}
        {{--<p>Tank updated.</p>--}}
    {{--@endif--}}
    <div class="container">
        @if(!isset($mode))
        <form action="{{route('modes.store')}}" method="POST">
            {{ csrf_field() }}
            <input name="name" value="{{}}"/> <button type="submit">Add</button>
            {{--<br/>--}}
            {{--<select name="params[name]">--}}
                {{--<option>name1</option>--}}
                {{--<option>name2</option>--}}
            {{--</select>--}}
            {{--<input name="params[value]"/>--}}


        </form>
        @include('admin.settings.allSettingsForInclude')

        @else
        <form action="{{route('modes.update', ['id' => $mode->id])}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input name="name" value="{{$mode->name}}"/>
            <button type="submit">Update</button>
        </form>
        @endif
    </div>
@endsection
