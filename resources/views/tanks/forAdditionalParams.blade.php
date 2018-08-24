<br/>
<select id="params[{{$index}}][name]" name="params[{{$index}}][name]">
    @foreach($elems as $elem)
        <option id="{{$elem->name}}[{{$index}}]">{{$elem->name}}</option>
    @endforeach
</select>
<input id="params[{{$index}}][value]" name="params[{{$index}}][value]"/>
<br/>