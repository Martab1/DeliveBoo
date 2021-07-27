@extends('layouts.app')

@section('content')
    <div class="container order">
        @if (count($orders) != 0)
            <h1>Ordini ricevuti</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome cliente</th>
                        <th class="my_none">Indirizzo cliente</th>
                        <th class="my_none2">Email cliente</th>
                        <th>Importo totale</th>
                        <th>Data ordine</th>
                        <th>orario ordine</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->payer_name }}</th>
                            <td class="my_none">{{ $order->payer_address }}</td>
                            <td class="my_none2">{{ $order->payer_email }}</td>
                            <td>{{ $order->total}} €</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->hour }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="links">{{ $orders->links() }}</div>
            {{-- IF USER DOESN'T HAVE A RESTAURANT --}}
        @else
            <div class="text-center">
                <h1 class="my-4">MI spiace non hai ancora ricevuto nessun ordine</h1>
            </div>
        @endif

        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" id="my-btn" href="{{ route('charts', $id) }}">Statistiche</a>
        </div>

        <div style="margin-top: 20px" class="d-flex justify-content-center">
            <a class="btn btn-secondary" href="{{ route('admin.restaurant.show', $id) }}">Torna indietro</a>
        </div>

    </div>
@endsection
