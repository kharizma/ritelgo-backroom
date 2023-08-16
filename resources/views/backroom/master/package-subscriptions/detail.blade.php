@extends('backroom.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Detail Paket</h2>
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
                                <li class="breadcrumb-item">
                                    <a href="#0">Detail Paket Langganan</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Paket
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            <!-- end col -->
            </div>
        <!-- end row -->
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Nama Paket</td>
                                <td class="fw-bold">{{ $package->name }}</td>
                            </tr>
                            <tr>
                                <td>Harga Paket</td>
                                <td class="fw-bold">{{ 'Rp'.number_format($package->price) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <button type="button" class="btn btn-sm btn-ritelgo-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createModal"><i class="mdi mdi-plus me-2"></i><span>Tambah Detail</span></button>
                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <h6>#</h6>
                                </th>
                                <th>
                                    <h6>Nama</h6>
                                </th>
                                <th>
                                    <h6>Tipe Nilai</h6>
                                </th>
                                <th>
                                    <h6>Nilai</h6>
                                </th>
                                <th>
                                    <h6>Aksi</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                            </thead>
                            <tbody>
                                @if (count($details) > 0)
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>
                                                {{ isset($detail->custom_name) ? $detail->custom_name : $detail->default_name }}
                                            </td>
                                            <td>
                                                {{ $detail->value_type }}
                                            </td>
                                            <td>
                                                {{ $detail->value }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="lni lni-more-alt fw-bold"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" style="background-color: #EAEAEA">
                                                        <li><a class="dropdown-item text-center" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $detail->id }}" data-feature_id="{{ $detail->feature_id }}" data-custom_name="{{ $detail->custom_name }}" data-value="{{ $detail->value }}" data-order="{{ $detail->order }}">Ubah</a></li>
                                                        <li><a class="dropdown-item text-center" onclick="btnDelete({{ $detail->id }})">Hapus</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Detail Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('master.package-subscription-details.store') }}" method="POST">
                    @csrf
                    <input type="text" name="package_subscription_id" value="{{ $package->id }}"  hidden>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Fitur</label>
                            <select name="feature_id" class="form-select">
                                <option value="">Silahkan Pilih</option>
                                @foreach ($features as $feature)
                                    <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kustom Nama</label>
                            <input type="text" name="custom_name" class="form-control" placeholder="Kustom Nama">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Nilai</label>
                            <input type="text" name="value" class="form-control" placeholder="Nilai" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Urutan</label>
                            <input type="number" name="order" class="form-control" value="1" min="1" required>
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

    <!-- Update Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Detail Paket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @method('PUT')
                    @csrf

                    <input type="text" name="package_subscription_id" value="{{ $package->id }}"  hidden>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Fitur</label>
                            <select name="feature_id" id="feature_id" class="form-select">
                                <option value="">Silahkan Pilih</option>
                                @foreach ($features as $feature)
                                    <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kustom Nama</label>
                            <input type="text" name="custom_name" id="custom_name" class="form-control" placeholder="Kustom Nama">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Nilai</label>
                            <input type="text" name="value" id="value" class="form-control" placeholder="Nilai" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger me-1">*</span>Urutan</label>
                            <input type="number" name="order" id="order" class="form-control" value="1" min="1" required>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var src = $(event.relatedTarget)

            $('#feature_id').val(src.data('feature_id'))
            $('#custom_name').val(src.data('custom_name'))
            $('#value').val(src.data('value'))
            $('#order').val(src.data('order'))
            
            var url = "{{ route('master.package-subscription-details.update',["package_subscription_detail" => ":package_subscription_detail"]) }}";
            url = url.replace(':package_subscription_detail', src.data('id'));

            $('#editForm').attr('action', url);
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
                    var url = "{{ route('master.package-subscription-details.destroy',["package_subscription_detail" => ":package_subscription_detail"]) }}";
                    url = url.replace(':package_subscription_detail', id);

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