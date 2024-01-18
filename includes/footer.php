</div>
<!-- End Main Content-->

<!-- Main Footer-->
<div class="main-footer text-center">
  <div class="container">
    <div class="row row-sm">
      <div class="col-md-12">
        <span>Copyright © <?= $current_year ?> Maktaba Tul Madina All rights reserved.</span>
      </div>
    </div>
  </div>
</div>
<!--End Footer-->

</div>
<!-- End Page -->

<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

<!-- Jquery js-->
<script src="<?= $app_path ?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap js-->
<script src="<?= $app_path ?>assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Internal Chart.Bundle js-->
<script src="<?= $app_path ?>assets/plugins/chart.js/Chart.bundle.min.js"></script>

<!-- Peity js-->
<script src="<?= $app_path ?>assets/plugins/peity/jquery.peity.min.js"></script>

<!-- Select2 js-->
<script src="<?= $app_path ?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= $app_path ?>assets/js/select2.js"></script>

<!-- Perfect-scrollbar js -->
<script src="<?= $app_path ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- Sidemenu js -->
<script src="<?= $app_path ?>assets/plugins/sidemenu/sidemenu.js"></script>

<!-- Sidebar js -->
<script src="<?= $app_path ?>assets/plugins/sidebar/sidebar.js"></script>

<!-- Internal Morris js -->
<script src="<?= $app_path ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/morris.js/morris.min.js"></script>

<!-- Circle Progress js-->
<script src="<?= $app_path ?>assets/js/circle-progress.min.js"></script>
<script src="<?= $app_path ?>assets/js/chart-circle.js"></script>

<!-- Internal Sweet-Alert js-->
<!-- <script src="<?= $app_path ?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/sweet-alert/jquery.sweet-alert.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

<!-- Internal Dashboard js-->
<script src="<?= $app_path ?>assets/js/index.js"></script>

<!-- Color Theme js -->
<script src="<?= $app_path ?>assets/js/themeColors.js"></script>

<!-- Toastify js -->
<script src='https://cdn.jsdelivr.net/npm/toastify-js'></script>

<!-- Sticky js -->
<script src="<?= $app_path ?>assets/js/sticky.js"></script>
<!-- tinymce -->
<script src="https://cdn.tiny.cloud/1/w395mvczmjfpberas5p9vhfqceu4ciwb6nq1eaxwpxwjross/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Internal Data Table js -->
<script src="<?= $app_path ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/js/jszip.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="<?= $app_path ?>assets/plugins/datatable/responsive.bootstrap5.min.js"></script>


<!--Bootstrap-datepicker js-->
<script src="<?= $app_path ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

<!-- Internal jquery-simple-datetimepicker js -->
<script src="<?= $app_path ?>assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>

<!-- Internal Parsley js-->
<script src="<?= $app_path ?>assets/plugins/parsleyjs/parsley.min.js"></script>

<!-- Internal Form-validation js-->
<script src="<?= $app_path ?>assets/js/form-validation.js"></script>

<!-- Custom js -->
<script src="<?= $app_path ?>assets/js/custom.js"></script>
<!-- Custom js -->
<script src="<?= $app_path ?>assets/js/helper.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: '.tiny-mce',
    height: 300,
    plugins: [
      'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
      'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
      'media', 'table', 'emoticons', 'template', 'help'
    ],
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
      'forecolor backcolor emoticons | help',
    menu: {
      favs: {
        title: 'My Favorites',
        items: 'code visualaid | searchreplace | emoticons'
      }
    },
    menubar: 'favs file edit view insert format tools table help',
  });

  function JSconfirm(url, typ = '', text = '') {
    let title, img;

    if (typ != '' && text != '') {
      text = text;
      title = 'Warning!';
      img = "https://cdn.lordicon.com/tdrtiskw.json";
    } else {
      text = "Are you sure to delete the selected record?";
      title = 'Confirmation!';
      img = "https://cdn.lordicon.com/gsqxdxog.json";
    }

    Swal.fire({
      html: '<div class="mt-3"><lord-icon src="' + img + '" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>' + title + '</h4><p class="text-muted mx-4 mb-0">' + text + '</p></div></div>',
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-primary w-xs me-2 mt-2',
        cancelButton: 'btn btn-danger w-xs mt-2'
      },
      confirmButtonText: 'Yes',
      buttonsStyling: false,
      showCloseButton: true
    }).then(function(result) {
      /* Read more about isConfirmed, isDenied below */
      if (result.value) {
        window.location = url;
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // swal.fire('Cancelled','','error')
      }
    });
  }

  function JSajaxconfirm(id, optional = '', typ = '', text = '', ) {
    if (typ != '' && text != '') {
      text = text;
      title = 'Warning!';
      img = "https://cdn.lordicon.com/tdrtiskw.json";

    } else {
      text = "Are you sure to delete selected record ?";
      title = 'Confirmation!';
      img = "https://cdn.lordicon.com/gsqxdxog.json";

    }
    Swal.fire({
      html: '<div class="mt-3"><lord-icon src="' + img + '" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>' + title + '</h4><p class="text-muted mx-4 mb-0">' + text + '</p></div></div>',
      showCancelButton: !0,
      confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
      cancelButtonClass: 'btn btn-danger w-xs mt-2',
      confirmButtonText: 'Yes',
      buttonsStyling: !1,
      showCloseButton: !0
    }).then(function(result) {
      /* Read more about isConfirmed, isDenied below */
      if (result.value) {
        // window.location = url;
        deleteData(id, optional);
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // swal.fire('Cancelled','','error')
      }
    })

  }

  var toastType = "<?php echo (isset($_SESSION['toast_type']) ? $_SESSION['toast_type'] : ''); ?>";
  var toast_msg = "<?php echo (isset($_SESSION['toast_msg']) ? $_SESSION['toast_msg'] : ''); ?>";
  if (toastType != "" && toast_msg != "") {
    window.onload = (event) => {
      Toastify({
        newWindow: !0,
        text: toast_msg,
        gravity: "top",
        position: "center",
        className: "bg-" + toastType,
        stopOnFocus: !0,
        offset: {
          x: "50 : 0",
          y: "10 : 0"
        },
        duration: "3000",
        close: "close" == "close",
        style: {
           background: toastType == 'danger' ? '#dc3545' : toastType == 'success' ? '#198754' : '',
        }
      }).showToast();
    }
  }

  function showToast(toastType, toastMsg) {
  if (toastType !== "" && toastMsg !== "") {
    Toastify({
      newWindow: true,
      text: toastMsg,
      gravity: "top",
      position: "center",
      className: "bg-" + toastType,
      stopOnFocus: true,
      offset: {
        x: 50,
        y: 10
      },
      duration: 3000,
      close: "close" == "close",
      style: {
        background: toastType == 'danger' ? '#dc3545' : toastType == 'success' ? '#198754' : '',
      }
    }).showToast();
  }
}
// loadnotif();
// function loadnotif() {
//   $("#loadnotif").load("../../includes/loadnotif.php", function () {
//   });
// }
function change_notif(notif_id){
  $.ajax({
    type: "POST",
    url: "../../ajax.php",
    data: { ACTION: "notif", notif_id: notif_id },
    success: function (response) {
    //  loadnotif();
    $('.notif').html(response);
    },
  });
}
// function checkNotifications() {
//   $.ajax({
//     url: '../../ajax.php', 
//     method: 'POST',
//     data: { ACTION: "notif_ref" },
//     success: function(data) {
//         alert(data);
//         $('.notif').html(data);
//       }
//     });
//   }

//   setInterval(checkNotifications, 60000);

//   checkNotifications();
</script>
<?php
unset($_SESSION["toast_type"]);
unset($_SESSION["toast_msg"]);
?>
</body>

</html>