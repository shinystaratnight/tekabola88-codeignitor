<script src="<?php echo base_url()?>admindata/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>admindata/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url()?>admindata/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>admindata/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- SlimScroll -->
<script src="<?php echo base_url()?>admindata/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>admindata/bower_components/fastclick/lib/fastclick.js"></script>


<!-- AdminLTE App -->
<script src="<?php echo base_url()?>admindata/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>admindata/dist/js/demo.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>admindata/plugins/iCheck/icheck.min.js"></script>


<!-- Bootstrap 3.3.7 -->
<!-- Sparkline -->
<script src="<?php echo base_url()?>admindata/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo base_url()?>admindata/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url()?>admindata/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>admindata/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()?>admindata/dist/js/pages/dashboard2.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>admindata/bower_components/select2/dist/js/select2.full.min.js"></script>


<!-- bootstrap datepicker -->
<script src="<?php echo base_url()?>admindata/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<!-- bootstrap time picker -->
<script src="<?php echo base_url()?>admindata/plugins/timepicker/bootstrap-timepicker.min.js"></script>


 <script type="text/javascript">
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

        //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })

});
 </script>
