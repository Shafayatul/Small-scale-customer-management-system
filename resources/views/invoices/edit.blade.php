@extends('layouts.admin.master')
@section('title')
Edit Invoice #{{ $invoice->id }}
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