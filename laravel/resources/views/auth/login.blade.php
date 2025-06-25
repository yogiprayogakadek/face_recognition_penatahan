<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png"
        href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/logos/favicon.png" />

    <!-- Core Css -->
    <link rel="stylesheet" href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/css/styles.css" />

    <title>MatDash Bootstrap Admin</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/logos/favicon.png" alt="loader"
            class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <div
            class="position-relative overflow-hidden auth-bg min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100 my-5 my-xl-0">
                    <div class="col-md-9 d-flex flex-column justify-content-center">
                        <div class="card mb-0 bg-body auth-login m-auto w-100">
                            <div class="row gx-0">
                                <!-- ------------------------------------------------- -->
                                <!-- Part 1 -->
                                <!-- ------------------------------------------------- -->
                                <div class="col-xl-6 border-end">
                                    <div class="row justify-content-center py-4">
                                        <div class="col-lg-11">
                                            <div class="card-body">
                                                <a href="../main/index.html"
                                                    class="text-nowrap logo-img d-block mb-4 w-100 text-center">
                                                    <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/logos/logo.svg"
                                                        class="dark-logo" alt="Logo-Dark" />
                                                </a>
                                                <h3 class="lh-base mb-4 text-center">E Presensi Face Recognition</h3>

                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Email
                                                            Address</label>
                                                        <input type="email" name="email" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter your email"
                                                            aria-describedby="emailHelp">
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Password</label>
                                                            <a class="text-primary link-dark fs-2"
                                                                href="../main/authentication-forgot-password2.html">Forgot
                                                                Password ?</a>
                                                        </div>
                                                        <input type="password" class="form-control"
                                                            id="exampleInputPassword1" name="password"
                                                            placeholder="Enter your password">
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-dark w-100 py-8 mb-4 rounded-1">Sign In</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- ------------------------------------------------- -->
                                <!-- Part 2 -->
                                <!-- ------------------------------------------------- -->
                                <div class="col-xl-6 d-none d-xl-block">
                                    <div class="row justify-content-center align-items-start h-100">
                                        <div class="col-lg-9">
                                            <div id="auth-login" class="carousel slide auth-carousel mt-5 pt-4"
                                                data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#auth-login"
                                                        data-bs-slide-to="0" class="active" aria-current="true"
                                                        aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#auth-login"
                                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#auth-login"
                                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div
                                                            class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                                                            <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/backgrounds/login-side.png"
                                                                alt="login-side-img" width="300" class="img-fluid" />
                                                            <h4 class="mb-0">Feature Rich 3D Charts</h4>
                                                            <p class="fs-12 mb-0">Donec justo tortor, malesuada vitae
                                                                faucibus ac, tristique sit amet
                                                                massa.
                                                                Aliquam dignissim nec felis quis imperdiet.</p>
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-primary rounded-1">Learn More</a>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div
                                                            class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                                                            <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/backgrounds/login-side.png"
                                                                alt="login-side-img" width="300" class="img-fluid" />
                                                            <h4 class="mb-0">Feature Rich 2D Charts</h4>
                                                            <p class="fs-12 mb-0">Donec justo tortor, malesuada vitae
                                                                faucibus ac, tristique sit amet
                                                                massa.
                                                                Aliquam dignissim nec felis quis imperdiet.</p>
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-primary rounded-1">Learn More</a>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div
                                                            class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                                                            <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/backgrounds/login-side.png"
                                                                alt="login-side-img" width="300"
                                                                class="img-fluid" />
                                                            <h4 class="mb-0">Feature Rich 1D Charts</h4>
                                                            <p class="fs-12 mb-0">Donec justo tortor, malesuada vitae
                                                                faucibus ac, tristique sit amet
                                                                massa.
                                                                Aliquam dignissim nec felis quis imperdiet.</p>
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-primary rounded-1">Learn More</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/js/theme/app.init.js"></script>
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/js/theme/theme.js"></script>
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/js/theme/app.min.js"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
