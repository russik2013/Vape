<script>
    $(document).ready(function () {
        $.ajax({
            url: "{{route('getSettingsAndTankParams')}}",
            data: {'_token' : "{{csrf_token()}}", 'tank_id' : "{{$tank->id}}"},
            type: "POST",
            success: function(result) {
                var settingsAndParams = JSON.parse(result);
                var params  = settingsAndParams.params;
                var settings = settingsAndParams.settings;

                for( var i = 0; i < params.length; i++ ) {
                    var selector = "<br/><br/><select name = 'params["+j+"][id]'>";
                    for(var k = 0; k < settings.length; k++) {
                        if(settingsAndParams.params[i].settings_id === settingsAndParams.settings[k].id) {
                            selector += "<option selected = '1' value = '"+settings[k].id+"'>"+settings[k].name+"</option>";
                        }
                        else {
                            selector += "<option value = '"+settings[k].id+"'>"+settings[k].name+"</option>";
                        }
                    }
                    selector += "</select><input name = 'params["+j+"][value]' value = '"+params[i].value+"'>";
                    $('form').append(selector);
                    j++;
                }
            }})
    });
</script>