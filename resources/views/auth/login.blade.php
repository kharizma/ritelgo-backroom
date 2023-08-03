<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name').' | Login' }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
</head>
<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <div class="d-flex flex-column min-vh-100 min-vw-100">
        <div class="d-flex flex-grow-1 justify-content-center align-items-center">
            <div class="card-style w-25 mb-30">
                <h6 class="text-center">Backroom Login</h6>
                <img src="{{ asset('assets/images/logo.svg') }}" class="mx-auto d-block w-50 mb-25" alt="Logo">
                <form action="#" method="POST">
                    @csrf

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

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="*******" required/>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="1" id="checkbox-remember"/>
                        <label class="form-check-label" for="checkbox-remember">
                            Ingat Saya
                        </label>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-ritelgo-primary text-white">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>