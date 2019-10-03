@extends('layouts.admin.master')
@section('title')
Customer {{ $customer->id }}
@endsection
@section('content')
@include('layouts.admin.include.alert')
    <div class="container">
        <div class="row">

            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">Customer {{ $customer->name }}</div>
                    <div class="card-body">

                        <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/customers/' . $customer->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        <a href="{{ url('/customer-invoice/' . $customer->id) }}" title="View Role"><button class="btn btn-success btn-sm"><i class="fas fa-file-invoice" aria-hidden="true"></i> Invoice</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['customers', $customer->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Customer',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
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
                                        <th> Is Invoice Automatic? </th>
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
        <br/>
        <br/>

        <div class="row">

            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">Customer {{ $customer->name }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Invoice Create Date</th>
                                    <th>Is Paid</th>
                                    <th>Automatic</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @php
                                        $paid_amount = 0;
                                        $unpaid_amount = 0;
                                    @endphp
                                    @foreach($invoices as $item)
                                    @if($item->is_paid == 1)
                                        @php $paid_amount = $paid_amount + $item->total_amount; @endphp
                                    @else
                                        @php $unpaid_amount = $unpaid_amount + $item->total_amount; @endphp 
                                    @endif
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                        <td>
                                            @if($item->is_paid == 1)
                                                <span style="color: green;">Paid</span>
                                            @else
                                                <span style="color: red;">Unpaid</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->is_autometic == 1) 
                                                <span class="text-success">Yes</span>
                                            @else
                                                <span class="text-danger">No</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->total_amount }}</td>
                                        <td>
                                            <a href="{{ url('/invoice-pdf-view/' . $item->id) }}" title="View Pdf" target="_blank"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/invoice-pdf-download/' . $item->id) }}" title="Download Pdf"><button class="btn btn-info btn-sm"><i class="fa fa-arrow-down" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/invoice-edit/' . $item->id) }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            @if($item->is_paid == 1)
                                                <a href="{{ url('/invoice-unpaid/' . $item->id) }}" title="Paid To Unpaid"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Unpaid</button></a>
                                            @else
                                                <a href="{{ url('/invoice-paid/' . $item->id) }}" title="Unpaid To Paid"><button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Paid</button></a>
                                            @endif

                                            @if($item->is_paid == 0)
                                                <a href="{{ url('/invoice-email-reminder/' . $item->id) }}" title="Paid To Unpaid"><button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Email</button></a>
                                            @endif

                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/invoices', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fas fa-trash" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Invoice',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-right">Total Paid</td>
                                        <td>{{ $paid_amount }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td colspan="4" class="text-right">Total Unpaid</td>
                                        <td>{{ $unpaid_amount }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right">Total Amount</td>
                                        <td>{{ $paid_amount + $unpaid_amount }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
