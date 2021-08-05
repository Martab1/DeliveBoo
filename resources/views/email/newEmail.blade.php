@component('mail::message')
# Deliveboo
<div class="container-img">
    <img class="logo" src="{{asset('img/logo_yellow.png')}}" alt="logo">
</div>
Grazie {{$order['payer_name']}}, 

il tuo acquisto dall'importo totale di **{{$order['total']}} euro** è stato processato con successo!<br>

a breve riceverai i prodotti selezionati all'indirizzo **{{$order["payer_address"]}}**<br>

Il tuo ordine:<br>

@foreach ($order['all_products'] as $product)
    {{$product['name']}} Quantità : {{$product['qty']}}
@endforeach

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Torna al sito
@endcomponent

Grazie,<br>
Deliveboo <br>
**Team 3**
@endcomponent
