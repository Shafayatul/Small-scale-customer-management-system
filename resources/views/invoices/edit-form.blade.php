<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('invoice_email') ? 'has-error' : ''}}">
            {!! Form::label('invoice_email', 'Invoice Email', ['class' => 'control-label']) !!}
            {!! Form::email('invoice_email', $invoice->invoice_email, ('' == 'required') ? ['class' => 'form-control invoice_email', 'required' => 'required'] : ['class' => 'form-control invoice_email']) !!}
            {!! $errors->first('invoice_email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio" name="is_paid" value="0" {{ $invoice->is_paid == 0 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customRadio">Unpaid</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio2" name="is_paid" value="1" {{ $invoice->is_paid == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customRadio2">Paid</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="custom-control custom-checkbox">
            <label  for="customCheck">Invoice Automatically: {{ $invoice->is_autometic == 1 ? 'Yes' : 'No' }}</label>
        </div>
        
    </div>
</div>

<br/>

@if($invoice->is_autometic == 1)

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('autometic_email_day') ? 'has-error' : ''}}">
                {!! Form::label('autometic_email_day', 'Day', ['class' => 'control-label']) !!}
                {!! Form::select('autometic_email_day', $days, null, ('' == 'required') ? ['class' => 'form-control days', 'required' => 'required'] : ['class' => 'form-control days']) !!}
                {!! $errors->first('autometic_email_day', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
    </div>

@endif
<br/>
@foreach($products as $product)
    <div class="row" id="registration{{ $loop->iteration }}">
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                {!! Form::label('product_name', 'Product Name', ['class' => 'control-label']) !!}
                {!! Form::text('product_name[]', $product->product_name, ('' == 'required') ? ['class' => 'form-control product_name', 'required' => 'required', 'serial' => $loop->iteration, 'id' => 'product_name_'.$loop->iteration] : ['class' => 'form-control product_name', 'serial'=>$loop->iteration, 'id' => 'product_name_'.$loop->iteration]) !!}
                {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                {!! Form::text('description[]', $product->description, ('' == 'required') ? ['class' => 'form-control description', 'required' => 'required', 'serial' => $loop->iteration, 'id' => 'description_'.$loop->iteration] : ['class' => 'form-control description', 'serial'=>$loop->iteration, 'id' => 'description_'.$loop->iteration]) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
                {!! Form::number('amount[]', $product->amount, ('' == 'required') ? ['class' => 'form-control amount', 'required' => 'required', 'serial' => $loop->iteration, 'id' => 'amount_'.$loop->iteration] : ['class' => 'form-control amount', 'serial' => $loop->iteration, 'id' => 'amount_'.$loop->iteration]) !!}
                {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
        <div class="col-md-3">
            <button type="button" class="removeButton btn btn-danger btn-sm" serial="{{ $loop->iteration }}"> <i  class="fas fa-trash-alt"></i></button>  
        </div>
    </div>
@endforeach

<div id="addedRows"></div>
{{-- <input type="hidden" id="is-save-and-email" name="is_save_and_email" value="0"> --}}

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
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            {{-- <button class="btn btn-success" id="save-and-email"><i class="fas fa-envelope" aria-hidden="true"></i> Save & Email</button> --}}

        </div>
    </div>
</div>




