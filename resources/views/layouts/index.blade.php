@extends('common.main')

@section('content')
<div id="content">
    <h3>Choose your ad</h3>

    <form id='ads-form' action="{{ $formUrl }} " method="post">
    {!! csrf_field() !!}
    <div> 
        Customer Name: 
        
        <select name='customer' id="customer" >
            @foreach($customers as $cust)
                <option value="{{ $cust['id'] }}"> {{ $cust['name'] }} </option>
            @endforeach
            <option value="0">New Customer</option>
        </select>
        <div id='customer-name' style='display:none'>
            <br />
            <span> Please enter the new customer's name:</span>
            <input type="text" name='customer_name'/>
        </div>
    </div>
    <br />
    <div>
        <table style='border:1px solid black;'>
            <thead>
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $prod)
                    <tr>
                        <td>{{$prod['sku']}}</td>
                        <td>{{$prod['display_name']}}</td>
                        <td>{{$prod['description']}}</td>
                        <td>${{$prod['price']}}</td>
                        <td><input type="number" min=0 value="0" name="quantity[{{$prod['id']}}]" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br />
    <input type='submit' value="Buy Ads" />
    </form>
</div>
@stop

@section('scripts')
<script type="text/javascript"> 
    var customer = document.querySelector('#customer');
    var customer_name = document.querySelector('#customer-name');
    customer.addEventListener('change',function(){
        if(this.value == '0') {
            customer_name.style.display = 'block';
        } else {
            customer_name.style.display = 'none';
        }
    });
</script>
@stop