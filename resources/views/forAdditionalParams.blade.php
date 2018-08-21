<br/>
<select id="params[{{$settingIndex}}][name]" name="params[{{$settingIndex}}][name]">
    @foreach($elems as $elem)
        <option id="{{$elem->name}}[{{$settingIndex}}]">{{$elem->name}}</option>
    @endforeach
</select>
<input id="params[{{$settingIndex}}][value]" name="params[{{$settingIndex}}][value]"/>
<br/>