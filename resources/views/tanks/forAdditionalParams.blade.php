<br/>
<button id="paramsButton">Add params</button>
<script>
    var j = 0;
    $('#paramsButton').click(function () {
        $.ajax({
            url: "{{route('settings.all.get')}}",
            type: "POST",
            data: {'_token' : "{{csrf_token()}}"},
            success: function(result) {
                var selector = "<br name='params["+j+"][br]'/>" +
                    "<br name='params["+j+"][br]'/>" +
                    "<select name = 'params["+j+"][id]'>";
                for(var i = 0; i < result.length; i++) {
                    selector += "<option value = '"+result[i].id+"'>"+result[i].name+"</option>";
                }
                selector += "</select><input name = 'params["+j+"][value]'>";
                selector += "<input type='button' name='params["+j+"][delBut]' value='Remove'/>";
                $('form').append(selector);
                j++;
            }});
    });
</script>