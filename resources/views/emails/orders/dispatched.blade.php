<x-mail::message>
<div style="text-align: center;">
    <img src="https://securable.com.ng/tailor-api/public/logo.png" alt="Logo of Kikae" style="width:50%;"/>
</div>

<br/><br/>
<h2 style="font-weight:900;">An order has been dispatched to you</h2>

<br/>

An order has been dispatched with Transaction reference <strong>{{$order->transaction->transaction_id}}</strong>. Please be sure to update the status of the order from your dashboard once the order is received.

Please find the details of the order below:

<strong>Product name:</strong> {{ $order->product->name }}<br/>
<strong>Unit Price:</strong> {{ $order->price }}<br/>
<strong>Number of units:</strong> {{ $order->units }}<br/>
<strong>Total:</strong> {{ $order->price * $order->units }}<br/>
<strong>Transaction reference:</strong> {{ $order->transaction->tx_ref }}

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
