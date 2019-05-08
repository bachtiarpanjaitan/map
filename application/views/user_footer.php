
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:<?= ASSETS ?>partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="#" target="_blank"><?= APPNAME ?></a>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- <script src="<?= ASSETS ?>js/jquery.min.js"></script>
  <script src="<?= ASSETS ?>js/bootstrap.min.js"></script>
  <script src="<?= ASSETS ?>js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="<?= ASSETS ?>js/swal.js"></script> -->
  <script src="<?= ASSETS ?>vendors/js/vendor.bundle.addons.js"></script>
  <script src="<?= ASSETS ?>js/swal.js"></script>
  <script src="<?= ASSETS ?>vendors/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
  <script src="<?= ASSETS ?>vendors/dropzone/min/dropzone.min.js"></script>
  
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <!-- <script src="<?= ASSETS ?>js/off-canvas.js"></script>
  <script src="<?= ASSETS ?>js/misc.js"></script> -->
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>

<script>
  $(document).ready(function () {
    $('#btnsignout').click(function (e) { 
      $.ajax({
        type: "POST",
        url: "<?= site_url('user/logout') ?>",
        data: {},
        dataType: "JSON",
        success: function (response) {
         
        }
      });
      location.reload();
    });
  });
</script>