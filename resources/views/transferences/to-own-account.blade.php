@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-title>Transacción entre cuentas propias</x-title>
            
                <div class="card">
                    <div class="card-header">
                        <span>Seleccione las cuentas a operar</span>
                    </div>

                    <div class="card-body">

                        @if(count($accounts) <= 1) 
                        
                        <span class="alert alert-danger">Debe tener mas de una cuenta para hacer transacciones entre cuentas</span>

                        @else

                        <form action="{{ route('transferences.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Cuenta origen</label>
                                <select name="origin_account_id" id="" class="form-control" required>
                                    @foreach($accounts as $account)
                                    <option value="{{ $account->id }}" @if(old('origin_account_id') == $account->id) selected @endif >
                                        {{ $account->name }} ({{ $account->id }})
                                        - $ {{ number_format($account->balance) }}
                                    </option>
                                    @endforeach
                                </select>
                                
                                @error('origin_account_id')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Cuenta destino</label>
                                <select name="destination_account_id" id="" class="form-control" required>
                                    @foreach($accounts as $account)
                                    <option value="{{ $account->id }}" @if(old('destination_account_id') == $account->id) selected @endif >
                                        {{ $account->name }} ({{ $account->id }})
                                        - $ {{ number_format($account->balance) }}
                                    </option>
                                    @endforeach
                                </select>
                                
                                @error('destination_account_id')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Cantidad a transferir</label>
                                <input type="number" min="0" max="999999999999" name="amount" class="form-control" required value="{{ old('amount') }}">
                                
                                @error('amount')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <a class="btn-outline-danger btn" title="Volver" href="{{ route('transferences.index') }}">
                                <i class="mdi mdi-arrow-left-bold"></i>
                            </a>
                            <button class="btn-primary btn">
                                <i class="mdi mdi-arrow-right-bold"></i>
                                Transferir
                            </button>
                        </form>

                        @endif

                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection