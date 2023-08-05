@extends('backroom.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Tambah Pengguna</h2>
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
                                    <a href="{{ route('master.users.index') }}">Pelanggan</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Pelanggan
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

                <form action="{{ route('master.users.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" name="role" class="form-control text-bg-secondary" value="superadmin" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="*******" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="*******" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Nomor Telepon</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="mobile_phone" class="form-control" placeholder="81323234293" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <a href="{{ route('master.users.index') }}" class="btn btn-danger w-25"><i class="mdi mdi-close me-2"></i><span>Batal</span></a>
                        <button type="submit" class="btn btn-success w-25"><i class="mdi mdi-content-save me-2"></i><span>Simpan</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection