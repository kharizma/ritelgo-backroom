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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        function btnActive(id){
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, active it!'
            },
            ).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('master.users.activate',["user" => ":user"]) }}";
                    url = url.replace(':user', id);

                    $.ajax({
                        type: "PUT",
                        url: url,
                        data:{
                            "_token": "{{ csrf_token() }}",
                            "_method": "PUT",
                        },
                        success: function (data) {
                            if(data.success){
                                Swal.fire(
                                    'Diubah!',
                                    'Data Berhasil diubah',
                                    "success"
                                );
                            }

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        },
                        error: function (data){
                            console.log(data);
                            Swal.fire(
                                'Gagal',
                                'Data Gagal diubah',
                                'error'
                            );

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        }       
                    });
                }
            })
        };

        function btnDeactive(id){
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, deactive it!'
            },
            ).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('master.users.deactivate',["user" => ":user"]) }}";
                    url = url.replace(':user', id);

                    $.ajax({
                        type: "PUT",
                        url: url,
                        data:{
                            "_token": "{{ csrf_token() }}",
                            "_method": "PUT",
                        },
                        success: function (data) {
                            if(data.success){
                                Swal.fire(
                                    'Diubah!',
                                    'Data Berhasil diubah',
                                    "success"
                                );
                            }

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        },
                        error: function (data){
                            console.log(data);
                            Swal.fire(
                                'Gagal',
                                'Data Gagal diubah',
                                'error'
                            );

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        }       
                    });
                }
            })
        };

        function btnDelete(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            },
            ).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('master.users.destroy',["user" => ":user"]) }}";
                    url = url.replace(':user', id);

                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data:{
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            if(data.success){
                                Swal.fire(
                                    'Terhapus!',
                                    'Data Berhasil dihapus',
                                    "success"
                                );
                            }

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        },
                        error: function (data){
                            console.log(data);
                            Swal.fire(
                                'Gagal',
                                'Data Gagal dihapus',
                                'error'
                            );

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        }       
                    });
                }
            })
        };
    </script>
@endpush