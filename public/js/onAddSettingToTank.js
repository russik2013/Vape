var index = 0;

function loadSettingsWhenUpdate( iterations, url, elemId, settingsNamesJson, settingsValuesJson) {
    for( var i = 0; i < iterations; i++ ) {
        onAddSetting(url, elemId);
    }

    if(settingsNamesJson.length === settingsValuesJson.length) {

        for( var i = 0 ; i < settingsValuesJson.length ; i++ ) {
            $("#" + settingsNamesJson[i] + "\\[" + i + "\\]").attr('selected',1);
            $("#params\\[" + i + "\\]\\[value\\]").attr('value', settingsValuesJson[i]);
        }

    }
}
function onAddSetting(path, idElemAfterWhichAppend) {
    $.ajax({
        url:path,
        type:"get",
        async:false,
        data:{'settingIndex':index++},
        success:       function(data){
            $("#"+idElemAfterWhichAppend).after(data);
        }
    });
}

