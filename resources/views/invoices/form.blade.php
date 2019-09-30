<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('business_name', 'Business Name', ['class' => 'control-label']) !!}
            <input type="text" name="business_name" value="{{ $customer->business_name }}" class="form-control" readonly="readonly">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            <input type="text" name="address" value="{{ $customer->address }}" class="form-control" readonly="readonly">
        </div>
    </div>
</div>
<input type="hidden" name="customer_id" value="{{ $customer->id }}">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
            <input type="text" name="city" value="{{ $customer->city }}" class="form-control" readonly="readonly">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('state', 'State', ['class' => 'control-label']) !!}
            <input type="text" name="state" value="{{ $customer->state }}" class="form-control" readonly="readonly">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('zip', 'Zip', ['class' => 'control-label']) !!}
            <input type="text" name="zip" value="{{ $customer->zip }}" class="form-control" readonly="readonly">
        </div>
    </div>
</div>

<div class="row" id="registration1">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
            {!! Form::label('product_name', 'Product Name', ['class' => 'control-label']) !!}
            {!! Form::text('product_name', null, ('' == 'required') ? ['class' => 'form-control product_name', 'required' => 'required', 'serial'=>'1', 'id' => 'product_name_1'] : ['class' => 'form-control product_name', 'serial'=>'1', 'id' => 'product_name_1']) !!}
            {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
            {!! Form::text('description', null, ('' == 'required') ? ['class' => 'form-control description', 'required' => 'required', 'serial'=>'1', 'id' => 'description_1'] : ['class' => 'form-control description', 'serial'=>'1', 'id' => 'description_1']) !!}
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
            {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control amount', 'required' => 'required', 'serial' => '1', 'id' => 'amount_1'] : ['class' => 'form-control amount', 'serial' => '1', 'id' => 'amount_1']) !!}
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

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>






