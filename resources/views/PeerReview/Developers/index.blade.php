<table>
    <tr><th></th><th>{{ trans('Name') }}</th><th>{{ trans('Type') }}</th></tr>
    @foreach($developers as $developer)
        <td></td><td>{{ $developer->full_name }}</td><td></td>
    @endforeach
</table>