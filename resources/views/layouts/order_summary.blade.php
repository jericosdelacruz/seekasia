@extends('common.main')

@section('content')
<div id="content">
    <h3>Order Summary:</h3>

    Customer Name: {{ $orderInfo->customer_name }}
    <table>
        <thead>
            <th>SKU</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Cost</th>
        </thead>
        <tbody>
        @if (isset($orderInfo->contents))
            @foreach ($orderInfo->contents as $info)
                <tr>
                    <td>{{ $info->product_sku }}</td>
                    <td>{{ $info->product_name }}</td>
                    <td>{{ $info->quantity }}</td>
                    <td>${{ $info->cost }}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="3"><strong>Total Amount:</strong></td>
            <td><strong>${{ $orderInfo->total_amount }}</strong></td>
        </tr>
        </tbody>
    </table>

    <a href="{{ $backUrl }}"> < Back to Home</a>
</div>
@stop