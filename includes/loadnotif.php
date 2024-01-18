<?php
include('header-min.php');
    $get = fetch_data($link, "SELECT count(notif_id) as total FROM notifications WHERE status='0'");

    $notifications = fetch_data($link, "SELECT *, invt_sales.status as sale_status FROM invt_sales
    INNER JOIN notifications ON notifications.sales_id = invt_sales.sales_id
    INNER JOIN users_detail ON users_detail.user_id = invt_sales.picklist_id
    WHERE notifications.status = '0'
    ORDER BY invt_sales.updated_on DESC");

?>
<div class="dropdown main-header-notification">
    <a class="nav-link icon" href="">
        <i class="fe fe-bell header-icons"></i>
        <span class="badge bg-danger nav-link-badge"><?= $get[0]['total'] ?></span>
    </a>
    <div class="dropdown-menu">
        
        <div class="main-notification-list">
            <?php foreach ($notifications as $notification) : ?>
                <div class="media <?php echo ($notification['status'] == 0) ? 'bg-light' : ''; ?>">
                    <div class="media-body" >
                        <p ><?= $notification['first_name'] ?> changed the status of sale <?= $notification['invoice_number'] ?> to <strong><?= $notification['sale_status'] ?></strong></p>
                        <span><?= $notification['updated_on'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    </div>
</div>