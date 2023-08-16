@extends('backroom.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        th, td { white-space: nowrap; }
    
        tr { height: 60px; }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Invoice</h2>
                        </div>
                    </div>
                <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <div class="card">
                <div class="card-body">
                    <div class="table-wrapper table-responsive">
                        <table class="table table-bordered table-hover" id="data-table">
                            <thead>
                                <tr class="table-success" style="height: 30px;">
                                    <th class="text-center">ID</th>
                                    <th class="text-center">PELANGGAN</th>
                                    <th class="text-center">PAKET</th>
                                    <th class="text-center">HARGA</th>
                                    <th class="text-center">TIPE HARGA</th>
                                    <th class="text-center">TOTAL BAYAR</th>
                                    <th class="text-center">DIBUAT</th>
                                    <th class="text-center">STATUS</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('invoices.index') !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_email',
                        name: 'user_email'
                    },
                    {
                        data: 'package_subscription_name',
                        name: 'package_subscription_name'
                    },
                    {
                        data: 'package_subscription_price',
                        name: 'package_subscription_price'
                    },
                    {
                        data: 'price_type',
                        name: 'price_type'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ],
                columnDefs: [
                    {"className": "dt-center", "targets": [5,6]},
                ],
                order: [
                    [ 1, 'asc' ],
                    [ 4, 'desc' ]
                ]
            });
        });
    </script>
@endpush