<footer class="main-footer">
    <strong>Copyright &copy; Meostore
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../assets/admin/vendors/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/admin/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="../assets/admin/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../assets/admin/vendors/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../assets/admin/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../assets/admin/js/pages/dashboard3.js"></script> -->


<!-- DataTables  & Plugins -->
<script src="../assets/admin/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/admin/vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/admin/vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/admin/vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/admin/vendors/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/admin/vendors/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/admin/vendors/jszip/jszip.min.js"></script>
<script src="../assets/admin/vendors/pdfmake/pdfmake.min.js"></script>
<script src="../assets/admin/vendors/pdfmake/vfs_fonts.js"></script>
<script src="../assets/admin/vendors/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/admin/vendors/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/admin/vendors/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- date-range-picker -->
<script src="../assets/admin/vendors/moment/moment.min.js"></script>
<script src="../assets/admin/vendors/daterangepicker/daterangepicker.js"></script>

<!-- Toastr -->
<script src="../assets/admin/vendors/toastr/toastr.min.js"></script>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<?php
if (isset($_SESSION['success'])) :
?>
    <script>
        $(document).ready(function() {
            toastr.success("<?=$_SESSION['success']?>");
        });
    </script>

<?php
endif;
unset($_SESSION['success']);
?>

<?php
if (isset($_SESSION['error'])) :
?>
    <script>
        $(document).ready(function() {
            toastr.error("<?=$_SESSION['error']?>");
        });
    </script>

<?php
endif;
unset($_SESSION['error']);
?>