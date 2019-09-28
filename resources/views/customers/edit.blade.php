@extends('layouts.admin.master')
@section('title')
Edit Customer #{{ $customer->id }}
@endsection
@section('content')
@include('layouts.admin.include.alert')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Customer #{{ $customer->id }}</div>
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

                        {!! Form::model($customer, [
                            'method' => 'PATCH',
                            'url' => ['/customers', $customer->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('customers.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
