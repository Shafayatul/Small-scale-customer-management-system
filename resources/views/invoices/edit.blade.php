@extends('layouts.admin.master')
@section('title')
Edit Invoice #{{ $invoice->id }}
@endsection
@section('header-additional-script')
<style type="text/css">
    .removeButton{
        margin-top: 35px;
    }
</style>
@endsection
@section('content')
@include('layouts.admin.include.alert')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Invoice #{{ $invoice->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/invoices') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($invoice, [
                            'method' => 'PATCH',
                            'url' => ['/invoices', $invoice->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('invoices.edit-form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-additional-script')
<script type="text/javascript">
        var rowCount = "{{ count($products) }}";
        // alert(rowCount);
        if(rowCount == '0'){
            rowCount = 1;
        }
    function addMoreRows(frm) {
        rowCount ++;
        var html = '<div class="row" id="registration'+rowCount+'"><div class="col-md-3"><div class="form-group "><label for="product_name" class="control-label">Product</label><input class="form-control product_name" id="product_name_'+rowCount+'" serial="'+rowCount+'" name="product_name[]" type="text"></div></div><div class="col-md-3"><div class="form-group "><label for="description" class="control-label">Description</label><input class="form-control description" id="description_'+rowCount+'" serial="'+rowCount+'" name="description[]" type="text"></div></div><div class="col-md-3"><div class="form-group"><label for="amount" class="control-label">Amount</label><input class="form-control amount" id="amount_'+rowCount+'" serial="'+rowCount+'" name="amount[]" type="number"></div></div><div class="col-md-3"><button type="button" class="removeButton  btn btn-danger btn-sm" serial="'+rowCount+'"> <i  class="fas fa-trash-alt"></i></button></div></div>';
        
        $('#addedRows').append(html);
    }

    $(document).on('click','.removeButton',function(){
        var deleteRowSerial = $(this).attr('serial');
        $("#registration"+deleteRowSerial).remove();
     });

    // $(document).on('click','#save-and-email',function(){
    //     $("#is-save-and-email").val("1");
    //  });

    // $("#invoice_auto").hide(500);
    // $('input[type="checkbox"]').click(function(){
         
    //     if($(this).prop("checked") == true){
    //         $("#invoice_auto").show(500);
    //     }
    //     else if($(this).prop("checked") == false){
    //         $("#invoice_auto").hide(500);
    //         $('.days').val([0]);
    //         $('.invoice_email').val('');
    //     }
    // });

</script>
@endsection