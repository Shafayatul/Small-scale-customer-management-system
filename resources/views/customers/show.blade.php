@extends('layouts.admin.master')
@section('title')
Customer {{ $customer->id }}
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">Customer {{ $customer->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/customers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/customers/' . $customer->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['customers', $customer->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Role',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $customer->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $customer->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $customer->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Phone Number </th>
                                        <td> {{ $customer->phone_number }} </td>
                                    </tr>
                                    <tr>
                                        <th> Business Name </th>
                                        <td> {{ $customer->business_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Address </th>
                                        <td> {{ $customer->address }} </td>
                                    </tr>
                                    <tr>
                                        <th> City </th>
                                        <td> {{ $customer->city }} </td>
                                    </tr>
                                    <tr>
                                        <th> State </th>
                                        <td> {{ $customer->state }} </td>
                                    </tr>
                                    <tr>
                                        <th> Zip </th>
                                        <td> {{ $customer->zip }} </td>
                                    </tr>
                                    <tr>
                                        <th> Is paid? </th>
                                        <td>
                                            @if($customer->is_paid == 1) 
                                                <span class="text-success">Paid</span>
                                            @else
                                                <span class="text-danger">Unpaid</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Monthly Amount </th>
                                        <td> {{ $customer->monthly_payment }} </td>
                                    </tr>
                                    <tr>
                                        <th> Is Invoice Automatically? </th>
                                        <td>
                                            @if($customer->is_invoice_auto == 1) 
                                                <span class="text-success">Yes</span>
                                            @else
                                                <span class="text-danger">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($customer->is_invoice_auto == 1)
                                        <tr>
                                            <th> Day </th>
                                            <td> {{ $customer->days }} </td>
                                        </tr>

                                        <tr>
                                            <th> Invoice Email </th>
                                            <td> {{ $customer->invoice_email }} </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
