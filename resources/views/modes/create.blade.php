@extends("modes.base")
@section("content")
    <div class="container">
        <form action="{{route('modes.store', ['id' => $mode->id])}}" method="POST">
            {{ csrf_field() }}
            <input name="name" value="{{$mode->name}}"/> <button type="submit">Add</button>
        </form>
        @include('admin.settings.allSettingsForInclude')
    </div>
@endsection
