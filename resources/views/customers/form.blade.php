<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            {!! Form::email('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('business_name') ? 'has-error' : ''}}">
            {!! Form::label('business_name', 'Business Name', ['class' => 'control-label']) !!}
            {!! Form::text('business_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('business_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
            {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
            {!! Form::text('phone_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
            {!! Form::label('state', 'State', ['class' => 'control-label']) !!}
            {!! Form::text('state', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('zip') ? 'has-error' : ''}}">
            {!! Form::label('zip', 'Zip', ['class' => 'control-label']) !!}
            {!! Form::text('zip', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
            {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
            {!! Form::text('city', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('monthly_payment') ? 'has-error' : ''}}">
            {!! Form::label('monthly_payment', 'Monthly Payment', ['class' => 'control-label']) !!}
            {!! Form::text('monthly_payment', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('monthly_payment', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            {!! Form::textarea('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio" name="is_paid" value="0" 

                        {{ $customer->is_paid == 0 ? 'checked' : '' }}


                    >
                    <label class="custom-control-label" for="customRadio">Unpaid</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio2" name="is_paid" value="1" 
                    {{ $customer->is_paid == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customRadio2">Paid</label>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-md-6">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck" name="is_invoice_auto" 
            {{ $customer->is_invoice_auto == 1 ? 'checked' : '' }}
            >
            <label class="custom-control-label" for="customCheck">Invoice Automatically?</label>
        </div>
    </div>
</div>
<br/>
<div class="row" id="invoice_auto">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('days') ? 'has-error' : ''}}">
            {!! Form::label('days', 'Days', ['class' => 'control-label']) !!}
            {!! Form::select('days', $days, null, ('' == 'required') ? ['class' => 'form-control days', 'required' => 'required'] : ['class' => 'form-control days']) !!}
            {!! $errors->first('days', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('invoice_email') ? 'has-error' : ''}}">
            {!! Form::label('invoice_email', 'Invoice Email', ['class' => 'control-label']) !!}
            {!! Form::email('invoice_email', null, ('' == 'required') ? ['class' => 'form-control invoice_email', 'required' => 'required'] : ['class' => 'form-control invoice_email']) !!}
            {!! $errors->first('invoice_email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>






