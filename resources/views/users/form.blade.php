<div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
    {!! Form::label('old_password', 'Old Password', ['class' => 'control-label']) !!}
    {!! Form::text('old_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
    {!! Form::label('new_password', 'New Password', ['class' => 'control-label']) !!}
    {!! Form::text('new_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('confirmed_password') ? 'has-error' : ''}}">
    {!! Form::label('confirmed_password', 'Confirmed Password', ['class' => 'control-label']) !!}
    {!! Form::text('confirmed_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('confirmed_password', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
</div>