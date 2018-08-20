@extends("modes.base")
@section("content")
    <div class="container">
        <table>
            @if($modes)
                @foreach($modes as $mode)
                    <tr>
                        <td class="table-text">
                            <div>
                                <a href="{{route('modes.show', ['id' => $mode->id])}}">{{ $mode->name }}</a>
                            </div>
                        </td>
                        <!-- Tank Delete Button -->
                        <td>
                            <a href="{{route('modes.delete', ['id' => $mode->id])}}">
                                <button >
                                    <i class="fa fa-btn fa-trash">Delete</i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route("modes.create",['id' => $mode->id])}}">
                                <button >
                                    <i class="fa fa-btn fa-trash">Update</i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <p>No tanks found.</p>
            @endif
        </table>
    </div>
@endsection