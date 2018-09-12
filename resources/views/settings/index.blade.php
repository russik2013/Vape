@extends("settings.base")
@section("content")
    @foreach($settings as $setting)
        <tr>
            <td class="table-text">
                <div><a href="{{route('settings.show', ['id' => $setting->id])}}">{{ $setting->name }}</a></div>
            </td>
            <!-- Tank Delete Button -->
            <td>
                <a href="{{route('settings.delete', ['id' => $setting->id])}}">
                    <button >
                        <i class="fa fa-btn fa-trash">Delete</i>
                    </button>
                </a>
            </td>
            <td>
                <a href="{{route('settings.create', ['id' => $setting->id])}}">
                    <button >
                        <i class="fa fa-btn fa-trash">Update</i>
                    </button>
                </a>
            </td>
        </tr>
    @endforeach
@endsection