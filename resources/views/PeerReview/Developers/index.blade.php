@extends('app')

@section('content')
    <h1>{{ trans('messages.developers') }}</h1>

@if(count($developers))
<table class="table">
    <tr><th></th>
        <th>{{ trans('messages.name') }}</th><th>{{ trans('messages.type') }}</th></tr>
    @foreach($developers as $developer)
       <tr><td><a href="{{ URL::route('developers_edit', array('id' => $developer->id)) }}" class="glyphicon glyphicon-edit" title="{{ trans('messages.edit') }}"></a></td><td>{{ $developer->full_name }}</td><td>{{$developer->developerType->type}}</td></tr>
    @endforeach
</table>
@endif
<a href="{{ URL::route('developers_add') }}">{{ trans('messages.add_developer') }}</a>
@stop