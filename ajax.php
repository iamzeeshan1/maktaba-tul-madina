<?php
include( 'includes/header-min.php' );
// $emp_id = $_SESSION[ 'emp_id' ];

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'notif' ) {
    $notif_id = $_POST[ 'notif_id' ];

  update_data($link,"notifications",['status'=>'1'],['notif_id'=>$notif_id],false);
    
  echo ajax_response($link);
}
if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'notif_ref' ) {
   
    echo ajax_response($link);
 
}

function ajax_response($link){
    $get = fetch_data($link, "SELECT count(notif_id) as total FROM notifications WHERE status='0'");

    $notifications = fetch_data($link, "SELECT *, invt_sales.status as sale_status FROM invt_sales
        INNER JOIN notifications ON notifications.sales_id = invt_sales.sales_id
        INNER JOIN users_detail ON users_detail.user_id = invt_sales.picklist_id
        
        ORDER BY notifications.created_at DESC");
    //$total = $get[0]['total'];
    $total = $get[0]['total']>0?$get[0]['total']:'';
    // Initialize an empty string to store the HTML content
    $htmlContent = '';
    $htmlContent .= '<a class="nav-link icon" href=""><i class="fe fe-bell header-icons"></i>';
    $htmlContent .= ' <span class="badge bg-danger nav-link-badge">' . $total . '</span></a>';
    $htmlContent .= '<div class="dropdown-menu">';
    $htmlContent .= '<div class="main-notification-list">';
        
    foreach ($notifications as $notification) {
        $htmlContent .= '<div class="media ' . (($notification['status'] == 0) ? 'bg-light' : '') . '">';
        $htmlContent .= '<div class="media-body">';
        $htmlContent .= '<p>' . $notification['first_name'] . ' changed the status of sale ' . $notification['invoice_number'] . ' to <strong>' . $notification['type'] . '</strong></p>';
        $htmlContent .= '<span>' . $notification['updated_on'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '</div>';
    }
    
    $htmlContent .= '</div>';
    $htmlContent .= '</div>';
    
  
    // Echo or return the HTML content
    return $htmlContent;
}
?>