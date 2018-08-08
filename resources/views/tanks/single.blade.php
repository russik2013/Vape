@extends("tanks.base")
@section("content")
    <div class="container">
        <table>
            <tr><td>id = {{$tank->id}}</td></tr>
            <tr><td>name = {{$tank->name}}</td></tr>
            <tr><td>created at = {{$tank->created_at}}</td></tr>
            <tr><td>updated at = {{$tank->updated_at}}</td></tr>
        </table>
        Params:
        <table>
            @foreach($tank->params as $setting)
                <tr>
                    <td>name = {{$setting->settings->name}}</td>
                    <td>value = {{$setting->value}}</td>
                </tr>
                @endforeach
        </table>
    </div>
@endsection
