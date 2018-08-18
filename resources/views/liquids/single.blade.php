@extends("liquids.base")
@section("content")
    <div class="container">
        <table>
            <tr><td>id = {{$liquid->id}}</td></tr>
            <tr><td>name = {{$liquid->name}}</td></tr>
            <tr><td>created at = {{$liquid->created_at}}</td></tr>
            <tr><td>updated at = {{$liquid->updated_at}}</td></tr>
        </table>
        Params:
        <table>
            @foreach($liquid->params as $setting)
                <tr>
                    <td>name = {{$setting->settings->name}}</td>
                    <td>value = {{$setting->value}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
