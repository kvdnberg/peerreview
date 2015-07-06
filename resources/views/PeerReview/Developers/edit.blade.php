@extends('app')

@section('content')
    <h1>{{trans('messages.edit_developer')}}</h1>
    {!! Form::model($developer, ['route' => ['developers_update', $developer->id]]) !!}


    @include('PeerReview.Developers.form')
@stop