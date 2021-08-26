@extends('layouts.app')

@section('content')
    <div class="container">
            
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if($transference)
                <x-title>Transacción exitosa</x-title>

                <div class="card">
                    <div class="card-header">
                        <span class="text-success font-weight-bold">¡Su transacción se ha realizado con éxito!</span>
                    </div>

                    <div class="card-body">

                        <p>Datos de la transacción:</p>

                        <table class="table">
                            <tr>
                                <th>Número de transacción</th>
                                <td>{{ $transference->id }}</td>
                            </tr>
                            <tr>
                                <th>Cuenta origen</th>
                                <td>{{ $transference->origin_account_id }}</td>
                            </tr>
                            <tr>
                                <th>Cuenta destino</th>
                                <td>{{ $transference->destination_account_id }}</td>
                            </tr>
                            <tr>
                                <th>Valor transferido</th>
                                <td>$ {{ number_format($transference->amount) }}</td>
                            </tr>
                            <tr>
                                <th>Fecha</th>
                                <td>{{ $transference->created_at }}</td>
                            </tr>
                        </table>
                        @else
                        <x-title>Transacción fallida</x-title>
                        
                        <div class="card">
                            <div class="card-header">
                                <span class="text-danger font-weight-bold">Ocurrió un error al procesar su transacción:</span>
                            </div>

                            <div class="card-body">
                                <p>Ocurró un error interno. Su transacción no fue exitosa. Por favor, intente mas tarde.</p>
                            </div>
                        </div>
                        <p></p>
                        @endif
        
                        <x-home-button></x-home-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection