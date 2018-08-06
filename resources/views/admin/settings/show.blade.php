@extends("tanks.base")
@section("content")
    <div class="container">
        <table>
            <tr><td>id = {{$setting->id}}</td></tr>
            <tr><td>name = {{$setting->name}}</td></tr>
            <tr><td>created at = <input name="activity" type="checkbox" @if($setting->activity == 1) checked @endif/></td></tr>
        </table>
    </div>
@endsection
