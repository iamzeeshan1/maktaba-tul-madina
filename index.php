<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Maktaba-Tul-Madina -  Inventory">
    <meta name="author" content="Vintage Tech">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.ico" type="image/x-icon" />

    <!-- Title -->
    <title>Signin - Maktaba-Tul-Madina</title>

    <!-- Bootstrap css-->
    <link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons css-->
    <link href="assets/plugins/web-fonts/icons.css" rel="stylesheet" />
    <link href="assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/web-fonts/plugin.css" rel="stylesheet" />

    <!-- Style css-->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="ltr main-body leftmenu error-1">

    <!-- Loader -->
    <div id="global-loader">
        <img src="assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    <!-- Page -->
    <div class="page main-signin-wrapper">

        <!-- Row -->
        <div class="row signpages text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="row row-sm">
                        <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
                            <div class="mt-5 pt-4 p-2 pos-absolute">
                                <img src="assets/img/brand/logo-light.png" class="d-lg-none header-brand-img text-start float-start mb-4 error-logo-light" alt="logo">
                                <img src="assets/img/brand/logo.png" class=" d-lg-none header-brand-img text-start float-start mb-4 error-logo" alt="logo">
                                <div class="clearfix"></div>
                                <img src="assets/img/svgs/user.svg" class="ht-100 mb-0" alt="user">
                                <h5 class="mt-4 text-white">Signin to Your Account</h5>
                                <span class="tx-white-6 tx-13 mb-5 mt-xl-0">Signin to create, discover and connect with the global community</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                            <div class="main-container container-fluid">
                                <div class="row row-sm">
                                    <div class="card-body mt-2 mb-2">
                                        <img src="assets/img/brand/logo.png" class=" d-lg-none header-brand-img text-start float-start mb-4" alt="logo">
                                        <div class="clearfix"></div>
                                        <form method="POST" action="modules/login/index.php">
                                            <h5 class="text-start mb-2">Signin to Your Account</h5>
                                            <p class="mb-4 text-muted tx-13 ms-0 text-start">Signin to create, discover and connect with the global community</p>
                                            <div class="form-group text-start">
                                                <label>User Name</label>
                                                <input class="form-control" placeholder="Enter your username" type="text" name="username"  id="username" value="aazaz.raza">
                                            </div>
                                            <div class="form-group text-start">
                                                <label>Password</label>
                                                <input class="form-control" placeholder="Enter your password" type="password" id="userpassword" name="password" value="123456">
                                            </div>
                                            <button class="btn ripple btn-main-primary btn-block" type="submit">Sign In</button>
                                        </form>
                                        <!-- <div class="text-start mt-5 ms-0">
                                            <div class="mb-1"><a href="">Forgot password?</a></div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
    <!-- End Page -->

    <!-- Jquery js-->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Select2 js-->
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>

    <!-- Perfect-scrollbar js -->
    <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- Color Theme js -->
    <script src="assets/js/themeColors.js"></script>

    <!-- Custom js -->
    <script src="assets/js/custom.js"></script>

</body>

</html>