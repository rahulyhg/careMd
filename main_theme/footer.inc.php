 <footer class="footer">
       <!--  <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="#">
                 OSTECH
                </a>
              </li>
              <li>
                <a href="#">
                  About Us
                </a>
              </li>
              <li>
                <a href="#">
                  Blog
                </a>
              </li>
              <li>
                <a href="#">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="#" target="_blank">Entice</a> for a better Hospital.
          </div>
        </div> -->
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo $root_path ?>/js/care_md/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo $root_path ?>/js/care_md/popper.min.js" type="text/javascript"></script>
  <script src="<?php echo $root_path ?>/js/care_md/bootstrap-material-design.min.js" type="text/javascript"></script>
  <!-- <script src="<?php echo $root_path ?>/js/care_md/plugins/perfect-scrollbar.jquery.min.js"></script> -->
  <!-- Chartist JS -->
  <!-- <script src="<?php echo $root_path ?>/js/care_md/plugins/chartist.js"></script> -->
  <!--  Notifications Plugin    -->
  <script src="<?php echo $root_path ?>/js/care_md/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo $root_path ?>/js/care_md/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="<?php echo $root_path ?>/js/care_md/chartist-plugin-tooltip.js"></script> -->
  <!-- <script src="<?php echo $root_path ?>/js/care_md/chartist-plugin-legend.js"></script> -->
  <script src="<?php echo $root_path ?>/js/care_md/plugins/Chart.bundle.min.js"></script>
  <script src="<?php echo $root_path ?>/js/care_md/plugins/moment.min.js"></script>
  <script src="<?php echo $root_path ?>/js/care_md/plugins/date-time-picker.min.js"></script>
  <script src="<?php echo $root_path ?>/js/care_md/plugins/jquery.Wload.js"></script>

  <script src="<?php echo $root_path ?>/js/care_md/plugins/idle-timer.js"></script>

<?php 

if (empty($_SESSION['sess_login_userid'])) {
    header("location: " . $root_path . "main/login.php");
    exit;
}

(@include_once ( $root_path.'modules/main_js.php'));
 ?>