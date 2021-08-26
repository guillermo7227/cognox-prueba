@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <x-title>Realizar Transacción</x-title>

                <div class="card">
                    <div class="card-header">
                        <span>¿Qué tipo de transacción desea realizar?</span>
                    </div>

                    <div class="card-body">

                        <a href="{{ route('transferences.to-own-account') }}">
                            <x-menu-button :icon="'mdi-transfer'" :color="'success'">A cuenta propia</x-menu-button>
                        </a>

                        <a href="{{ route('transferences.to-external-account') }}">
                            <x-menu-button :icon="'mdi-open-in-new'" :color="'primary'">A cuenta externa</x-menu-button>
                        </a>


                        <a href="{{ route('transferences.list') }}">
                            <x-menu-button :icon="'mdi-view-list-outline'" :color="'secondary'">Listado de transacciones</x-menu-button>
                        </a>

                        <x-home-button></x-home-button>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection