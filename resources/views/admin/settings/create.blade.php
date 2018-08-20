@extends("admin.admin")
@section("content")
    <div class="container">
        <form action="{{route('settings.store', ['id' => $setting->id])}}" method="POST">
            {{ csrf_field() }}
            <input name="name" value="{{old('name', $setting->name)}}"/>
            <input name="activity" type="checkbox" @if($setting->activity == 1) checked @endif/>
            <button type="submit">@if($setting->id) Update @else Add @endif </button>
        </form>
    </div>
@endsection
