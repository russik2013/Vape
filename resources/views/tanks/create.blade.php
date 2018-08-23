@extends("tanks.base")
@section("content")
    <div class="container" >
        @if(!isset($tank))
            <form action="{{route('tanks.store')}}" method="POST">
                {{ csrf_field() }}
                <input name="name"/>
                <button type="submit" id="submitButton">Add</button>
            </form>
            <br/>
            <button onclick="onAddSetting( '{{route('additionalSettings')}}', 'submitButton' )">Add params</button>
        @else

            <form id="updateForm" onclick="" action="{{route('tanks.update', ['id' => $tank->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input name="name" value="{{$tank->name}}"/>
                <button type="submit" id="submitUpdateButton">Update</button>
            </form>
            <br/>
            <button onclick="onAddSetting( '{{route('additionalSettings')}}', 'submitUpdateButton' )">Add params</button>
            <br/>
            <script>
                var settingsValues = <?php echo json_encode( $settings_values );?>;
                var settingsNames = <?php echo json_encode( $settings_names );?>;

                $(document).ready(function(){
                    loadSettingsWhenUpdate( '{{$tank->params->count()}}', '{{route('additionalSettings')}}', 'submitUpdateButton'
                        , settingsNames, settingsValues);
                });
            </script>
        @endif
    </div>
    <script type="text/javascript" src="{{asset('js/onAddSettingToTank.js')}}"></script>
@endsection
