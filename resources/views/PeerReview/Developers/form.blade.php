<div class="form-group">
{!! Form::label('firstName', 'First name') !!}
{!! Form::text('firstName', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('middleName', 'Middle name') !!}
{!! Form::text('middleName', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('lastName', 'Last name') !!}
{!! Form::text('lastName', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('gitHubHandle', 'GitHub handle') !!}
{!! Form::text('gitHubHandle', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('developerType', 'Type') !!}
{!! Form::select('developer_type_id', $types, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
</div>
{!! Form::close() !!}
<a href="{{ URL::route('developers') }}">{{trans('Return to the list')}}</a>