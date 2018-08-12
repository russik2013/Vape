@extends("users.base")
@section("content")
    <div class="container">
        <table>
            @if( isset($users) && count($users)!= 0 )
                @foreach( $users as $user )
                    <tr>
                        <td class="table-text">
                            <div>
                                <a href="{{route('users.show', ['id' => $user->id])}}">{{ $user->name }}</a>
                            </div>
                        </td>
                        <!-- User Delete Button -->
                        <td>
                            <a href="{{route('users.delete', ['id' => $user->id])}}">
                                <button >
                                    <i class="fa fa-btn fa-trash">Delete</i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route("users.edit",['id' => $user->id])}}">
                                <button >
                                    <i class="fa fa-btn fa-trash">Update</i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <p>No users found.</p>
            @endif
        </table>
    </div>
@endsection