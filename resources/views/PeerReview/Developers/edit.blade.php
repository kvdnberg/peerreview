@extends('app')

@section('content')
    <h1>{{trans('Edit a developer')}}</h1>
    {!! Form::model($developer, ['route' => 'developers']) !!}

    @include('PeerReview.Developers.form')
@stop