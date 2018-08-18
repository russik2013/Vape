@extends("liquids.base")
@section("content")
    <div class="container">
        <table>
            @if(isset($liquids) && count($liquids)!=0)
                @foreach($liquids as $liquid)
                    <tr>
                        <td class="table-text">
                            <div>
                                <a href="{{route('liquids.show', ['id' => $liquid->id])}}">{{ $liquid->name }}</a>
                            </div>
                        </td>
                        <!-- Tank Delete Button -->
                        <td>
                            <a href="{{route('liquids.delete', ['id' => $liquid->id])}}">
                                <button >
                                    <i class="fa fa-btn fa-trash">Delete</i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route("liquids.edit",['id' => $liquid->id])}}">
                                <button >
                                    <i class="fa fa-btn fa-trash">Update</i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <p>No liquids found.</p>
            @endif
        </table>
    </div>
@endsection