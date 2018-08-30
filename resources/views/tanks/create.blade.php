@extends("tanks.base")
@section("content")
    <div class="container" >
        @if(!isset($tank))
            <form action="{{route('tanks.store')}}" method="POST">
                {{ csrf_field() }}
                <input name="name"/>
                <button type="submit" id="submitButton">Add</button>
            </form>
            <br/>
        @else
            <form action="{{route('tanks.update', ['id' => $tank->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input name="name" value="{{$tank->name}}"/>
                <button type="submit" id="submitUpdateButton">Update</button>
                @include('tanks.forUpdate')
            </form>
            <br/>
        @endif
            @include("tanks.forAdditionalParams")
    </div>
@endsection
