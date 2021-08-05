@component('mail::message')
# Deliveboo
<div class="container-img">
    <img class="logo" src="{{asset('img/logo_yellow.png')}}" alt="logo">
</div>
Buongiorno {{$order['deliveboo_client']}}

Hai appena ricevuto un ordine per la tua attività **{{$order['restaurant_name']}}** 
da {{$order['payer_name']}}, <br>

Ecco il riepilogo dell'ordine effettuato: <br>

@foreach ($order['all_products'] as $product)
    {{$product['name']}} Quantità : {{$product['qty']}}
@endforeach

per un totale di **{{$order['total']}} euro** da consegnare in **{{$order["payer_address"]}}**

Ti auguriamo una buona giornata!

@component('mail::button', ['url' => "http://127.0.0.1:8000/admin/orders/$restaurant_id"])
Vedi i tuoi ordini
@endcomponent

Grazie,<br>
Deliveboo <br>
**Team 3**
@endcomponent
