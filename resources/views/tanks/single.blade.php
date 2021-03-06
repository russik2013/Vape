@extends("tanks.base")
@section("content")
    <div class="container">
        <table>
            <tr><td>id = {{$tank->id}}</td></tr>
            <tr><td>name = {{$tank->name}}</td></tr>
            <tr><td>created at = {{$tank->created_at}}</td></tr>
            <tr><td>updated at = {{$tank->updated_at}}</td></tr>
        </table>
        Settings:
        <table>
            @foreach($params as $param)
                <tr>
                    <td>name = {{$tank->settings->find($param->setting_id)->name}}</td>
                    <td>value = {{$param->value}}</td>
                </tr>
                @endforeach
        </table>
    </div>
@endsection
