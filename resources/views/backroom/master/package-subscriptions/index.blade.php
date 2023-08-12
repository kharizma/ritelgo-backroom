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
                        <h2>Paket Langganan</h2>
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
                                    Paket Langganan
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
                <button type="button" class="btn btn-sm btn-ritelgo-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createModal"><i class="mdi mdi-plus me-2"></i><span>Tambah Paket</span></button>
                
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
                                <th class="text-center">NAMA</th>
                                <th class="text-center">HARGA</th>
                                <th class="text-center">HARGA TAHUNAN</th>
                                <th class="text-center">DITAMPILKAN</th>
                                <th class="text-center">STATUS</th>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('master.package-subscriptions.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Harga</label>
                            <input type="number" name="price" class="form-control" placeholder="Harga" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Harga Tahunan</label>
                            <input type="number" name="price_annual" class="form-control" placeholder="Harga Tahunan" required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_show" value="yes" role="switch">
                                        <label class="form-check-label">Tampilkan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="yes" role="switch">
                                        <label class="form-check-label">Aktifkan</label>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="editForm">
                    @method('PUT')
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Nama</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Harga</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Harga" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Harga Tahunan</label>
                            <input type="number" name="price_annual" id="price_annual" class="form-control" placeholder="Harga Tahunan" required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_show" id="is_show" value="yes" role="switch">
                                        <label class="form-check-label">Tampilkan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="yes" role="switch">
                                        <label class="form-check-label">Aktifkan</label>
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

    <!-- Show Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger me-1">*</span>Tipe</label>
                        <input type="text" name="id" id="editId" class="form-control" placeholder="Tipe Bisnis" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-close me-2"></i><span>Batal</span></button>
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
                ajax: '{!! route('master.package-subscriptions.index') !!}',
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'price_annual',
                        name: 'price_annual'
                    },
                    {
                        data: 'is_show',
                        name: 'is_show'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                columnDefs: [
                    {"className": "dt-center", "targets": [0,1,2,3,4]},
                ],
                order: [
                    [ 1, 'asc' ]
                ]
            });
        });

        $('#editModal').on('show.bs.modal', function(event) {
            var src = $(event.relatedTarget)

            $('#name').val(src.data('name'))
            $('#price').val(src.data('price'))
            $('#price_annual').val(src.data('price_annual'))
            src.data('is_show') == true ? $('#is_show').prop("checked", true) : $('#is_show').prop("checked", false);
            src.data('is_active') == true ? $('#is_active').prop("checked", true) : $('#is_active').prop("checked", false);

            var url = "{{ route('master.package-subscriptions.update',["package_subscription" => ":package_subscription"]) }}";
            url = url.replace(':package_subscription', src.data('id'));

            $('#editForm').attr('action', url);
        })
    </script>
@endpush