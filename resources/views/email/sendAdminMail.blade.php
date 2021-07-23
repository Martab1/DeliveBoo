@component('mail::message')
# Deliveboo

Buongiorno **{{$order['deliveboo_client']}}**

Hai appena ricevuto un ordine per la tua attività **{{$order['restaurant_name']}}** 
da {{$order['payer_name']}}, <br>

Ecco il riepilogo dell'ordine effettuato: <br>

@foreach ($order['all_products'] as $product)
    {{$product['name']}} Quantità : {{$product['qty']}}
@endforeach

per un totale di **{{$order['total']}} euro** da consegnare in **{{$order["payer_address"]}}**

Ti auguriamo una buona giornata!

Deliveboo
Team 3

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
