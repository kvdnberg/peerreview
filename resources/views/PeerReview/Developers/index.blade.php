@if(count($developers))
<table>
    <tr><th></th><th>{{ trans('Name') }}</th><th>{{ trans('Type') }}</th></tr>
    @foreach($developers as $developer)
        <td></td><td>{{ $developer->full_name }}</td><td>{{$developer->developerType->type}}</td>
    @endforeach
</table>
@endif
<a href="{{ URL::route('developers_add') }}">Add a developer</a>