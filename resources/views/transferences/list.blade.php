@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <x-title>Listado de Transacciones</x-title>

                <div class="card">
                    <div class="card-header">
                        <span>Aquí puede ver todas las transacciones hechas en el sistema</span>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped table-responsive" id="transferences-table">
                            <thead>
                                <tr>
                                    <th># de Transacción</th>
                                    <th>Cuenta origen</th>
                                    <th>Cuenta destino</th>
                                    <th>Valor</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                        </table>

                        <hr>

                        <p class="font-weight-bold">Filtrar transferencias</p>
                        
                        <form method="POST" id="search-form" role="form">
                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="origin_account_id">Cuenta origen</label>
                                        <input type="number" class="form-control" name="origin_account_id" id="origin_account_id" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destination_account_id">Cuenta destino</label>
                                        <input type="number" class="form-control" name="destination_account_id" id="destination_account_id" placeholder="">
                                    </div>
                                </div>
                            </div>
                
                            <button type="submit" class="btn btn-primary d-block">Filtrar</button>
                        </form>
                        
                        <div class="my-2"></div>

                        <x-home-button></x-home-button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(function() {
            // $('#transferences-table').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: '{!! route('transferences.list') !!}',
            //     columns: [
            //         { data: 'id', name: 'id' },
            //         { data: 'origin_account_id', name: 'origin_account_id' },
            //         { data: 'destination_account_id', name: 'destination_account_id' },
            //         { data: 'amount', name: 'amount' },
            //         { data: 'created_at', name: 'created_at' }
            //     ],
            // });

            var oTable = $('#transferences-table').DataTable({
                dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'>>r>"+
                    "<'row'<'col-xs-12't>>"+
                    "<'row'<'col-xs-12'<'col-xs-12'i><'col-xs-12'p>>>",
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{!! route('transferences.get-list') !!}',
                    data: function (d) {
                        d.origin_account_id = $('input[name=origin_account_id]').val();
                        d.destination_account_id = $('input[name=destination_account_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'origin_account_id', name: 'origin_account_id' },
                    { data: 'destination_account_id', name: 'destination_account_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' }
                ],
                initComplete: function () {
                    $('#transferences-table').parent().css('overflow-x','auto');
                    $('#transferences-table_info').closest('.row').addClass('justify-content-center');
                }
            });

            $('#search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        </script>
    @endpush
@endsection