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
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            {!! Form::text('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
            {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
            {!! Form::text('city', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
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
            {!! Form::label('zip', 'Zip Code', ['class' => 'control-label']) !!}
            {!! Form::text('zip', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
{{-- @if($formMode == 'create') --}}

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('invoice_email') ? 'has-error' : ''}}">
            {!! Form::label('invoice_email', 'Invoice Email', ['class' => 'control-label']) !!}
            {!! Form::email('invoice_email', null, ('' == 'required') ? ['class' => 'form-control invoice_email', 'required' => 'required'] : ['class' => 'form-control invoice_email']) !!}
            {!! $errors->first('invoice_email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck" name="is_autometic">
            <label class="custom-control-label" for="customCheck">Invoice Automatically?</label>
        </div>
    </div>
    
    <div class="col-md-6">
        
    </div>
    
</div>



<br/>

<div id="invoice_auto">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('day') ? 'has-error' : ''}}">
                {!! Form::label('days', 'Day', ['class' => 'control-label']) !!}
                {!! Form::select('days', $days, null, ('' == 'required') ? ['class' => 'form-control days', 'required' => 'required'] : ['class' => 'form-control days']) !!}
                {!! $errors->first('days', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
    </div>

    <div class="row" id="registration1">
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                {!! Form::label('product_name', 'Product Name', ['class' => 'control-label']) !!}
                {!! Form::text('product_name[]', null, ('' == 'required') ? ['class' => 'form-control product_name', 'required' => 'required', 'serial'=>'1', 'id' => 'product_name_1'] : ['class' => 'form-control product_name', 'serial'=>'1', 'id' => 'product_name_1']) !!}
                {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                {!! Form::text('description[]', null, ('' == 'required') ? ['class' => 'form-control description', 'required' => 'required', 'serial'=>'1', 'id' => 'description_1'] : ['class' => 'form-control description', 'serial'=>'1', 'id' => 'description_1']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
                {!! Form::number('amount[]', null, ('' == 'required') ? ['class' => 'form-control amount', 'required' => 'required', 'serial' => '1', 'id' => 'amount_1'] : ['class' => 'form-control amount', 'serial' => '1', 'id' => 'amount_1']) !!}
                {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <button type="button" class="removeButton btn btn-danger btn-sm" serial="1"> <i  class="fas fa-trash-alt"></i></button>  
        </div>
    </div>

    <div id="addedRows"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button class="pull-right add-product-btn  btn btn-success" onclick="addMoreRows(this.form);" type="button">
                        <i  class="fas fa-plus"></i>
                    </button>    
                </div>
            </div>
        </div>

</div>

{{-- @endif --}}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>