@extends('common.main')

@section('content')
<div id="content">
    <h3>Price Rules</h3>

    <a href="{{ url('price_rules/add' ) }}"> Add Price Rule </a>
    <br /><br />
    <table>
        <thead>
            <th>Discount Type</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Minimum Quantity</th>
            <th>Counted Quantity</th>
            <th>Cost Per Ad</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($priceRules as $rule)
                <tr>
                    <td>
                    @if($rule->pricing_rule_type == 1)
                    Discount per ad
                    @elseif($rule->pricing_rule_type == 2)
                    M for N deal                    
                    @elseif($rule->pricing_rule_type == 3)
                    Discount per ad if you buy N or more
                    @endif
                    </td>
                    <td>{{ $rule->product_name }}</td>
                    <td>{{ $rule->customer_name }}</td>
                    <td>{{ $rule->minimum_quantity }}</td>
                    <td>{{ $rule->counted_quantity }}</td>
                    <td>{{ isset($rule->cost_per_ad)?'$'.$rule->cost_per_ad:'' }}</td>
                    <td><a href="{{ url('price_rules/edit/').'/'.$rule->id }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop