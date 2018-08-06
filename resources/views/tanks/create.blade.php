@extends("tanks.base")
@section("content")
    @if(isset($isAdded) && $isAdded == true)
        <p>Tank added.</p>
    @endif
    <div class="container">
        <form action="/tanks" method="POST">
            {{ csrf_field() }}
            <input name="name"/>
            <button type="submit">Add</button>
        </form>
    </div>
@endsection