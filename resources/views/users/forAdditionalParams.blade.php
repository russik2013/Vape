<br/>
<select id="tanks[{{$index}}]" name="tanks[{{$index}}]">
    @foreach( $elems as $elem )
        <option id="{{$elem->name}}[{{$index}}]">{{$elem->name}}</option>
    @endforeach
</select>
<br/>