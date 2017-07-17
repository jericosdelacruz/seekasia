@extends('common.main')

@section('content')
<div id="content">
    <h3>{{ $title }}</h3>

    <form action="{{ $formUrl }}" method="post" id="price-rule-form">
    {!! csrf_field() !!}
    @if(isset($priceRule))
        <input type="hidden" name="price_rule_id" value="{{ $priceRule['id'] }}"/>
    @endif

        <div>
            Discount Type:        
            <select name='pricing_rule_type'>
                <option value="1" 
                    @if(isset($priceRule) && $priceRule['pricing_rule_type'] == 1)
                    selected
                    @endif
                >
                    Discount per ad
                </option>
                <option value="2" 
                    @if(isset($priceRule) && $priceRule['pricing_rule_type'] == 2)
                        selected
                    @endif
                >M for N deal</option>
                <option value="3" 
                @if(isset($priceRule) && $priceRule['pricing_rule_type'] == 3)
                    selected
                @endif
                >Discount per ad if you buy N or more</option>
            </select> 
        </div>

        <div>
            Product:
            <select name="product">
                @foreach($products as $product)
                    <option value="{{ $product['id'] }}"
                        @if(isset($priceRule) && $priceRule['product_id'] == $product['id'])
                            selected
                        @endif
                    >
                        {{$product['display_name']}}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            Customer:
            <select name="customer">
                @foreach($customers as $customer)
                    <option value="{{ $customer['id'] }}"
                        @if(isset($priceRule) && $priceRule['customer_id'] == $customer['id'])
                            selected
                        @endif
                    >
                        {{ $customer['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            Minimum Quantity:
            <input type="number" value="{{ isset($priceRule)?$priceRule['minimum_quantity']:1 }}" min="1" name="minimum_quantity" />
        </div>

        <div>
            Counted Quantity:
            <input type="number" value="{{ isset($priceRule)?$priceRule['counted_quantity']:null }}" min="1" name="counted_quantity" />
        </div>

        <div>
            Cost per Ad:
            <input type="number" placeholder="0.00" value="{{ isset($priceRule)?$priceRule['cost_per_ad']:null }}" min="0.00" name="cost_per_ad" step=".01" />
        </div>
        <br />
        <input type="submit">
    </form>
</div>
@stop