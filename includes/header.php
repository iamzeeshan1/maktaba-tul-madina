<?php
ob_start();
session_start();
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes

//local path
$app_path = "http://" . $_SERVER['HTTP_HOST'] . "/my_sites/maktaba-tul-madina/";
$web_dir = "my_sites/maktaba-tul-madina/";


//live path
// $web_dir="admin/";
// $app_path="https://" . $_SERVER['HTTP_HOST'] . "/" . $web_dir;

$root_path = $_SERVER['DOCUMENT_ROOT'] . "/" . $web_dir;


include($root_path . "includes/dbcode.php");
include($root_path . "includes/main.php");
include($root_path . "includes/session.php");
include_once($root_path . "includes/file-upload.php");
//include($root_path . "includes/secure.php");

//set global variables
$user_id = $_SESSION['mktb_user_id'];

$today         = date('m/d/Y h:i:s A', time());
$current_month = date("m y", strtotime($today));
$current_year  = date("Y", strtotime($today));
?>
<!DOCTYPE html>
<html lang="en" id="demo">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Maktaba-Tul-Madina Inventory">
    <meta name="author" content="Vintage Tech">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="<?=$app_path?>assets/img/brand/favicon.ico" type="image/x-icon" />

    <!-- Title -->
    <title><?php if(isset($page_title) && $page_title!=""){echo $page_title;} else {echo "Dashboard - Maktaba-Tul-Madina";} ?></title>

    <!-- Bootstrap css-->
    <link id="style" href="<?=$app_path?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons css-->
    <link href="<?=$app_path?>assets/plugins/web-fonts/icons.css" rel="stylesheet" />
    <link href="<?=$app_path?>assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="<?=$app_path?>assets/plugins/web-fonts/plugin.css" rel="stylesheet" />

    <!-- Style css-->
    <link href="<?=$app_path?>assets/css/style.css" rel="stylesheet">

    <!-- Select2 css-->
    <link href="<?=$app_path?>assets/plugins/select2/css/select2.min.css" rel="stylesheet">

    <!-- Sweet Alert css-->
    <!-- <link href="<?=$app_path?>assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Mutipleselect css-->
    <link rel="stylesheet" href="<?=$app_path?>assets/plugins/multipleselect/multiple-select.css">
    
    <!-- toaster css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!--Bootstrap-datepicker css-->
	<link rel="stylesheet" href="<?=$app_path?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">
    
    <!-- Internal Datetimepicker-slider css -->
    <link href="<?=$app_path?>assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
    
    <!-- DATA TABLE CSS -->
    <link href="<?=$app_path?>assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="<?=$app_path?>assets/plugins/datatable/css/buttons.bootstrap5.min.css"  rel="stylesheet">
    <link href="<?=$app_path?>assets/plugins/datatable/css/responsive.bootstrap5.css" rel="stylesheet" />
</head>

<body class="ltr main-body leftmenu">

    <!-- Loader -->
    <div id="global-loader">
        <img src="<?=$app_path?>assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->
    <!-- Page -->
    <div class="page">
        <!-- Main Header-->
        <div class="main-header side-header sticky">
            <div class="main-container container-fluid">
                <div class="main-header-left">
                    <a class="main-header-menu-icon" href="javascript:void(0)" id="mainSidebarToggle"><span></span></a>
                    <div class="hor-logo">
                        <a class="main-logo" href="index.html">
                            <img src="<?=$app_path?>assets/img/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="<?=$app_path?>assets/img/brand/logo-light.png" class="header-brand-img desktop-logo-dark" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="main-header-center">
                    <div class="responsive-logo">
                        <a href="index.html"><img src="<?=$app_path?>assets/img/brand/logo.png" class="mobile-logo" alt="logo"></a>
                        <a href="index.html"><img src="<?=$app_path?>assets/img/brand/logo-light.png" class="mobile-logo-dark" alt="logo"></a>
                    </div>
                </div>
                <div class="main-header-right">
                    <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                    </button><!-- Navresponsive closed -->
                    <div class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                            <div class="d-flex order-lg-2 ms-auto">
                                 <!-- Notification -->
                                <?php
                                if($_SESSION['mktb_role_id']=='1'):
                                    $get = fetch_data($link, "SELECT count(notif_id) as total FROM notifications WHERE status='0'");

                                    $notifications = fetch_data($link, "SELECT *, invt_sales.status as sale_status FROM invt_sales
                                    INNER JOIN notifications ON notifications.sales_id = invt_sales.sales_id
                                    INNER JOIN users_detail ON users_detail.user_id = invt_sales.picklist_id
                                   
                                    ORDER BY notifications.created_at DESC");
                                                                ?>
                                <!-- <div id="loadnotif"></div> -->
                                <div class="dropdown main-header-notification notif">
                                    <a class="nav-link icon" href="#">
                                        <i class="fe fe-bell header-icons"></i>
                                        <span class="badge bg-danger nav-link-badge"><?= $get[0]['total']>0?$get[0]['total']:'' ?></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        
                                        <div class="main-notification-list">
                                            <?php foreach ($notifications as $notification) : ?>
                                                <div class="media <?php echo ($notification['status'] == 0) ? 'bg-light' : ''; ?>">
                                                    <div class="media-body" onclick="change_notif(<?=$notification['notif_id']?>)">
                                                        <p ><?= $notification['first_name'] ?> changed the status of sale <?= $notification['invoice_number'] ?> to <strong><?= $notification['type'] ?></strong></p>
                                                        <span><?= $notification['updated_on'] ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php  endif;?>

								<!-- Notification -->
                                <!-- Theme-Layout -->
                                <div class="dropdown d-flex main-header-theme">
                                    <a class="nav-link icon layout-setting">
                                        <span class="dark-layout">
                                            <i class="fe fe-sun header-icons"></i>
                                        </span>
                                        <span class="light-layout">
                                            <i class="fe fe-moon header-icons"></i>
                                        </span>
                                    </a>
                                </div>
                                <!-- Theme-Layout -->
                               
                                <!-- Full screen -->
                                <div class="dropdown ">
                                    <a class="nav-link icon full-screen-link">
                                        <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                                        <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                                    </a>
                                </div>
                                <!-- Full screen -->
                                <!-- Profile -->
                                <div class="dropdown main-profile-menu">
                                    <a class="d-flex" href="javascript:void(0)">
                                        <span class="main-img-user"><img alt="avatar" src="<?=$app_path?>assets/img/users/1.jpg"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="header-navheading">
                                            <h6 class="main-notification-title"><?=$_SESSION['mktb_user_displayname']?></h6>
                                            <p class="main-notification-text">Web Designer</p>
                                        </div>
                                        <a class="dropdown-item border-top" href="profile.html">
                                            <i class="fe fe-user"></i> My Profile
                                        </a>
                                        <a class="dropdown-item" href="<?=$app_path?>modules/logout/">
                                            <i class="fe fe-power"></i> Sign Out
                                        </a>
                                    </div>
                                </div>
                                <!-- Profile -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Header-->
        <?php include("navigation.php") ?>
        <!-- Main Content-->
        <div class="main-content side-content pt-0">