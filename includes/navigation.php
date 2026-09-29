<!-- Sidemenu -->
<div class="sticky">
    <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
        <div class="main-sidebar-header main-container-1 active">
            <div class="sidemenu-logo">
                <a class="main-logo" href="index.html">
                    MTM
                </a>
            </div>
            <div class="main-sidebar-body main-body-1">
                <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                <ul class="menu-nav nav">
                    <?php  if($_SESSION['mktb_role_id'] == '1'):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$app_path?>modules/dashboard/">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link with-sub" href="javascript:void(0)">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-package sidemenu-icon menu-icon"></i>
                            <span class="sidemenu-label">Products</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="nav-sub" style="display: none;">
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/products/">Products</a>
                            </li>
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/languages/">Languages</a>
                            </li>
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/publishers/">Publishers</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$app_path?>modules/purchase/">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-shopping-cart sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Purchase</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link with-sub" href="javascript:void(0)">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-user sidemenu-icon menu-icon"></i>
                            <span class="sidemenu-label">Customer</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="nav-sub" style="display: none;">
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/customers/">Customer</a>
                            </li>
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/regions/">Regions</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link with-sub" href="javascript:void(0)">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-money sidemenu-icon menu-icon"></i>
                            <span class="sidemenu-label">Sales</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="nav-sub" style="display: none;">
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/sales/create.php">Create Sale</a>
                            </li>
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/sales/dispatch_to_picklist.php">Dispatch to Picklist</a>
                            </li>
                            <li class="nav-sub-item"><a class="nav-sub-link" href="<?=$app_path?>modules/sales/dispatch_to_inv.php">Dispatched to Invoice</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$app_path?>modules/suppliers/">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-stats-up sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Suppliers</span>
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$app_path?>modules/picklist/">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-agenda sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Picklist</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php  if($_SESSION['mktb_role_id'] == '2'):?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$app_path?>modules/picked-by/">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-clipboard sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Assigned Sales</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php  if($_SESSION['mktb_role_id'] == '3'):?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$app_path?>modules/admin/purchase/">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-clipboard sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Purchase</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
<!-- End Sidemenu -->