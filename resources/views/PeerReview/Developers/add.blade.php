<h1>{{trans('Add a developer')}}</h1>

{!! Form::open(['route' => 'developers']) !!}

{!! Form::label('firstName', 'First name') !!}
{!! Form::text('firstName') !!}

{!! Form::label('middleName', 'Middle name') !!}
{!! Form::text('middleName') !!}

{!! Form::label('lastName', 'Last name') !!}
{!! Form::text('lastName') !!}

{!! Form::label('gitHubHandle', 'GitHub handle') !!}
{!! Form::text('gitHubHandle') !!}

{!! Form::label('developerType', 'Type') !!}
{!! Form::select('developer_type_id') !!}



{!! Form::submit('Add developer') !!}

{!! Form::close() !!}
<a href="{{ URL::route('developers') }}">{{trans('Return to the list')}}</a>