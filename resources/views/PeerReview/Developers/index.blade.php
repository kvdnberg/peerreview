@extends('app')

@section('content')
    <h1>Developers</h1>

@if(count($developers))
<table class="table">
    <tr><th></th><th>{{ trans('Name') }}</th><th>{{ trans('Type') }}</th></tr>
    @foreach($developers as $developer)
       <tr><td><a href="{{ URL::route('developers_edit', array('id' => $developer->id)) }}" class="glyphicon glyphicon-edit" title="{{ trans('Edit') }}"></a></td><td>{{ $developer->full_name }}</td><td>{{$developer->developerType->type}}</td></tr>
    @endforeach
</table>
@endif
<a href="{{ URL::route('developers_add') }}">Add a developer</a>
@stop