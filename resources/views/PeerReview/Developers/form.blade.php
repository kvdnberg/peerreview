<div class="form-group">
{!! Form::label('firstName', trans('messages.firstname')) !!}
{!! Form::text('firstName', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('middleName', trans('messages.middlename')) !!}
{!! Form::text('middleName', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('lastName', trans('messages.lastname')) !!}
{!! Form::text('lastName', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('gitHubHandle', trans('messages.githubhandle')) !!}
{!! Form::text('gitHubHandle', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('developerType', trans('messages.type')) !!}
{!! Form::select('developer_type_id', $types, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::submit(trans('messages.save'), ['class' => 'btn btn-primary form-control']) !!}
</div>
{!! Form::close() !!}
<a href="{{ URL::route('developers') }}">{{trans('messages.return')}}</a>