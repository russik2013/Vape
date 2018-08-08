@extends("tanks.base")
@section("content")
    <div class="container">
        <table>
        @if(isset($tanks) && count($tanks)!=0)
            @foreach($tanks as $tank)
                    <tr>
                        <td class="table-text">
                            <div>
                                <a href="{{route('tanks.show', ['id' => $tank->id])}}">{{ $tank->name }}</a>
                            </div>
                        </td>
                        <!-- Tank Delete Button -->
                        <td>
                            <a href="{{route('tanks.delete', ['id' => $tank->id])}}">
                                <button >
                                    <i class="fa fa-btn fa-trash">Delete</i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route("tanks.edit",['id' => $tank->id])}}">
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