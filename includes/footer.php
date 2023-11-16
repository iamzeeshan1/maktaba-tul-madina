</div>
<!-- End Main Content-->

<!-- Main Footer-->
<div class="main-footer text-center">
    <div class="container">
        <div class="row row-sm">
            <div class="col-md-12">
                <span>Copyright © <?=$current_year?> Maktaba Tul Madina All rights reserved.</span>
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
<script src="<?=$app_path?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap js-->
<script src="<?=$app_path?>assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="<?=$app_path?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Internal Chart.Bundle js-->
<script src="<?=$app_path?>assets/plugins/chart.js/Chart.bundle.min.js"></script>

<!-- Peity js-->
<script src="<?=$app_path?>assets/plugins/peity/jquery.peity.min.js"></script>

<!-- Select2 js-->
<script src="<?=$app_path?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?=$app_path?>assets/js/select2.js"></script>

<!-- Perfect-scrollbar js -->
<script src="<?=$app_path?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- Sidemenu js -->
<script src="<?=$app_path?>assets/plugins/sidemenu/sidemenu.js"></script>

<!-- Sidebar js -->
<script src="<?=$app_path?>assets/plugins/sidebar/sidebar.js"></script>

<!-- Internal Morris js -->
<script src="<?=$app_path?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?=$app_path?>assets/plugins/morris.js/morris.min.js"></script>

<!-- Circle Progress js-->
<script src="<?=$app_path?>assets/js/circle-progress.min.js"></script>
<script src="<?=$app_path?>assets/js/chart-circle.js"></script>

<!-- Internal Dashboard js-->
<script src="<?=$app_path?>assets/js/index.js"></script>

<!-- Color Theme js -->
<script src="<?=$app_path?>assets/js/themeColors.js"></script>

<!-- Sticky js -->
<script src="<?=$app_path?>assets/js/sticky.js"></script>
<!-- tinymce -->
<script src="https://cdn.tiny.cloud/1/w395mvczmjfpberas5p9vhfqceu4ciwb6nq1eaxwpxwjross/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Custom js -->
<script src="<?=$app_path?>assets/js/custom.js"></script>
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
      favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'css/content.css'
  });
  </script>


</body>

</html>