<script>
    function loadSettings(result) {
        j = 0;
        var settingsAndParams = JSON.parse(result);
        var params  = settingsAndParams.params;
        var settings = settingsAndParams.settings;

        for( var i = 0; i < params.length; i++ ) {
            var selector = "<br name='params["+j+"][br]'/>" +
                "<br name='params["+j+"][br]'/>" +
                "<select name = 'params["+j+"][id]'>";
            for( var k = 0; k < settings.length; k++ ) {
                if(settingsAndParams.params[i].setting_id === settings[k].id) {
                    selector += "<option selected = '1' value = '"+settings[k].id+"'>"+settings[k].name+"</option>";
                }
                else {
                    selector += "<option value = '"+settings[k].id+"'>"+settings[k].name+"</option>";
                }
            }
            selector += "</select><input name = 'params["+j+"][value]' value = '"+params[i].value+"'>";
            selector += "<input type='button' name='params["+j+"][delBut]' value='Remove'/>";
            $('form').append(selector);
            j++;
        }

        for( i = 0;i < j; i++ ) {
            $("[name$='[" + i + "][delBut]']").click({iter:i}, function (event) {
                var selectedOption = $("select[name='params[" + event.data.iter + "][id]']").val();
                var selectedValue = $("input[name='params[" + event.data.iter + "][value]']").val();
                $.ajax({
                    url: "{{route('detachParamFromTank')}}",
                    type: "DELETE",
                    async: false,
                    data: {
                        '_token': "{{csrf_token()}}",
                        'param': {'id': selectedOption, 'value': selectedValue},
                        'tank_id': "{{$tank->id}}"
                    },
                    success: function (result) {
                        $("[name^=params]").remove();
                        loadSettings(result);
                    }
                });
            } );
        }
    }

</script>