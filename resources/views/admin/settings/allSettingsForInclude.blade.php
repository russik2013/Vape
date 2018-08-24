<br/>
<button id="addParam">Add params</button>


<script src="{{asset('js/jquery.js')}}"></script>
<script>
    $(function() {
        var settingsNumber = 1;
        $("#addParam").click( function()
            {
                console.log('russik');
                $.ajax({
                    url: "{{route('settings.all.get')}}",
                    type: "POST",
                    data: {// change data to this object
                        _token : "{{csrf_token()}}",
                    },
                    success: function(date){

                        selector = "<br/><br/><select name='Settings["+settingsNumber+"][settingID]'>";
                        for(j = 0; j < date.length; j++){
                            selector+= "<option value='"+date[j].id+"'>"+date[j].name+"</option>";
                        }
                        selector+= "</select>";
                         $('form').append( selector + " <input name='Settings["+settingsNumber+"][settingValue]'>" );
                        
                        // console.log(settingsNumber);
                        settingsNumber++;
                    }
                });
            }
        );
    });
</script>