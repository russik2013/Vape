<script>
    $(document).ready(function () {
        $.ajax({
            url: "{{route('getSettingsAndTankParams')}}",
            data: {'_token' : "{{csrf_token()}}", 'tank_id' : "{{$tank->id}}"},
            type: "POST",
            success: loadSettings})
    });
</script>
