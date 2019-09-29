@extends('layouts.admin.master')
@section('title')
Create New Customer
@endsection
@section('content')
@include('layouts.admin.include.alert')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Customer</div>
                    <div class="card-body">
                        <a href="{{ url('/customers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/customers', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('customers.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-additional-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#invoice_auto").hide(500);
        $('input[type="checkbox"]').click(function(){
             
            if($(this).prop("checked") == true){
                $("#invoice_auto").show(500);
            }
            else if($(this).prop("checked") == false){
                $("#invoice_auto").hide(500);
                $('.days').val([0]);
                $('.invoice_email').val('');
            }
        });
    });
</script>
@endsection