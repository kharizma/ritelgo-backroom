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
                        <h2>Tipe Bisnis</h2>
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
                                    Tipe Bisnis
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
                <button type="button" class="btn btn-sm btn-ritelgo-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createModal"><i class="mdi mdi-plus me-2"></i><span>Tambah Tipe</span></button>
                
                @if ($errors->any())
                    <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
                        <div>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-wrapper table-responsive">
                    <table class="table table-bordered table-hover" id="data-table">
                        <thead>
                            <tr class="table-success" style="height: 30px;">
                                <th class="text-center">ID</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">DIBUAT</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tipe</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('master.business-types.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger me-1">*</span>Tipe</label>
                        <input type="text" name="id" class="form-control" placeholder="Tipe Bisnis" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-close me-2"></i><span>Batal</span></button>
                    <button type="submit" class="btn btn-ritelgo-primary text-white"><i class="mdi mdi-content-save me-2"></i><span>Simpan</span></button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Tipe</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="editForm">
                @method('PUT')
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger me-1">*</span>Tipe</label>
                        <input type="text" name="id" id="editId" class="form-control" placeholder="Tipe Bisnis" required>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="editIsActive" value="yes" role="switch">
                                    <label class="form-check-label">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-close me-2"></i><span>Batal</span></button>
                    <button type="submit" class="btn btn-ritelgo-primary text-white"><i class="mdi mdi-content-save me-2"></i><span>Simpan</span></button>
                </div>
            </form>
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
                ajax: '{!! route('master.business-types.index') !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                columnDefs: [
                    {"className": "dt-center", "targets": [0,1,2,3]},
                ],
                order: [
                    [ 0, 'asc' ]
                ]
            });
        });

        $('#editModal').on('show.bs.modal', function(event) {
            var src = $(event.relatedTarget)

            $('#editId').val(src.data('id'))
            src.data('is_active') == true ? $('#editIsActive').prop("checked", true) : $('#editIsActive').prop("checked", false);

            var url = "{{ route('master.business-types.update',["business_type" => ":business_type"]) }}";
            url = url.replace(':business_type', src.data('id'));

            $('#editForm').attr('action', url);
        })

        $('#editModal').on('hidden.bs.modal', function(event) {
            location.reload()
        })

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
                    var url = "{{ route('master.business-types.destroy',["business_type" => ":business_type"]) }}";
                    url = url.replace(':business_type', id);

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