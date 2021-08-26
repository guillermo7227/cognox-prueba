@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <x-title>Bienvenido, {{ auth()->user()->firstName }}.</x-title>
            
            <div class="card">
                <div class="card-header">¿Qué quiere hacer hoy?</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('transferences.index') }}">
                        <x-menu-button :icon="'mdi-transfer-right'" :color="'primary'">Transacciones Bancarias</x-menu-button>
                    </a>

                    <a href="{{ route('accounts.index') }}">
                        <x-menu-button :icon="'mdi-currency-usd'" :color="'success'">Estado de las Cuentas</x-menu-button>
                    </a>

                    <a href="{{ route('logout') }}" onclick="logout()">
                        <x-menu-button :icon="'mdi-exit-run'" :color="'light'">Salir</x-menu-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function logout() {
            event.preventDefault();
            if(confirm('¿Desea cerrar la sesión?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
@endpush
@endsection
