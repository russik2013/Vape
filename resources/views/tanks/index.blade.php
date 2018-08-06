@extends("tanks.base")
@section("content")
    <div class="container">
        <table>
        @if(isset($tanks) && count($tanks)!=0)
            @foreach($tanks as $tank)
                    <tr>
                        <td class="table-text"><div>{{ $tank->name }}</div></td>
                        <!-- Tank Delete Button -->
                        <td>
                            <form action="{{url('tanks/' . $tank->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" id="delete-task-{{ $tank->id }}" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{url('tanks/' . $tank->id . '/edit')}}" method="GET">
                                {{ csrf_field() }}
                                <button type="submit" id="delete-task-{{ $tank->id }}" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>Update
                                </button>
                            </form>
                        </td>
                    </tr>
            @endforeach
        @else
            <p>No tanks found.</p>
        @endif
        </table>
    </div>
@endsection
@section("footer")
    @include("tanks.footer")
@endsection