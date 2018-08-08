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
            <input name="name"/>
            <button type="submit">Add</button>
        </form>
        @else
        <form action="{{route('photo.update', ['id' => $tank->id])}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input name="name" value="{{$tank->name}}"/>
            <button type="submit">Update</button>
        </form>
        @endif
    </div>
@endsection
