@extends('backroom.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        th, td { white-space: nowrap; }
    
        tr { height: 60px; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Pengguna</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#0" class="nav-link">Master</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Pengguna
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            <!-- end col -->
            </div>
            <!-- end row -->
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('master.users.create') }}" class="btn btn-sm btn-ritelgo-secondary mb-3"><i class="mdi mdi-account-plus me-2"></i><span>Tambah Pengguna</span></a>
                <div class="table-wrapper table-responsive">
                    <table class="table table-bordered table-hover" id="data-table">
                        <thead>
                            <tr class="table-success" style="height: 30px;">
                                <th class="text-center">ID</th>
                                <th class="text-center">ROLE</th>
                                <th class="text-center">NAMA</th>
                                <th class="text-center">EMAIL</th>
                                <th class="text-center">DIBUAT</th>
                                <th class="text-center">STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                ajax: '{!! route('master.users.index') !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
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