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
        @include("tanks.forAdditionalParams")
        @else

            <form id="updateForm" onclick="" action="{{route('tanks.update', ['id' => $tank->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input name="name" value="{{$tank->name}}"/>
                <button type="submit" id="submitUpdateButton">Update</button>
            </form>
            <br/>
        @endif
    </div>
    <script type="text/javascript" src="{{asset('js/onAddSettingToTank.js')}}"></script>
@endsection
