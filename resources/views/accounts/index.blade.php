@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                        
                <h1 class="mb-4">Tus Cuentas</h1>

                <div class="card">

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <th>Nombre</th>
                                <th>Número de Cuenta</th>
                                <th>Saldo</th>
                            </thead>
                            <tbody>
                                @forelse($accounts as $account)
                                <tr>
                                    <td>{{ $account->name }}</td>
                                    <td>{{ $account->id }}</td>
                                    <td>$ {{ number_format($account->balance) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3"><h4>No hay cuentas que mostrar</h3></td>
                                </tr>
                                
                                @endforelse
                            </tbody>
                        </table>

                        
                        <x-home-button></x-home-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection