@extends('app')

@section('content')
    <h1>{{trans('Add a developer')}}</h1>

    {!! Form::model(new PeerReview\Developer, ['route' => 'developers']) !!}

    @include('PeerReview.Developers.form')
@stop