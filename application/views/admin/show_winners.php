  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | FootBall</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
 <?php $this->load->view('admin/css') ?>
 
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

 <?php $this->load->view('admin/navbar') ?>
 <?php $this->load->view('admin/sidebar') ?>
 

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                 <section class="content-header">
                    <h1>
                       Show Winners  
                        <small> Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <!-- <li><a href="#"> Match</a></li> -->
                        <li class="active">Show Winners</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">
<?php  if(isset($error)){ echo $error; }
echo $this->session->flashdata('success_req'); ?>
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header text-center">
                                    <h3 class="box-title "> Match </h3>
                                    <?php foreach ($match as $acat) {?>
                                </div><!-- /.box-header -->
                                <hr>
                                                  <div class="box-body">

                                                    <div class="col-md-5">
                                                      <div class="row text-center">
                                                        <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$acat->team_a_img; ?>" height="25px" width="25px">
                                                      </div>
                                                      <div class="row text-center">
                                                        <?php echo $acat->team_a; ?> 
                                                      </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <strong> VS</strong>
                                                    </div>
                                                    <div class="col-md-5">
                                                      <div class="row text-center">
                                                        <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$acat->team_b_img; ?>" height="25px" width="25px">
                                                      </div>
                                                      <div class="row text-center">
                                                        <?php echo $acat->team_b; ?> 
                                                      </div>
                                                    </div>
                                                  </div>
                                    <?php } ?>

                                                
                            </div>
</div>


  <div class="col-md-9">
                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Match Winners</h3>   
                                                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Betting Id</th>
                                                <th class="text-center">Member Id</th>
                                                <th class="text-center">Match Id</th>
                                                <th class="text-center">Match Score</th>
                                               <th>Match Date</th>
                                                 <th>Rate</th>
                                               <th>Bet Amount</th>
                                               <th>Win Balance</th>
                                       
                                                <th>Action</th>
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($winner as $acat){ ?>
                                            <tr>
                                                <td class="text-center"><?php echo $acat->betting_id; ?> </td>
                                                <td class="text-center"><?php echo $acat->member_id; ?> </td>

                                                <td class="text-center"><?php echo $acat->match_id; ?> </td>
                                                <td class="text-center"><?php if($acat->team1_score ==5 || $acat->team2_score ==5) {?>
                                                    5up
                                                  <?php }else if($acat->team1_score ==6 || $acat->team2_score ==6){ ?>
                                                    Win
                                                  <?php }else{?>
                                                  <?php echo $acat->team1_score ?> - <?php echo $acat->team2_score ?>
                                                  <?php }?> </td>

                                                <td><?php echo $acat->match_date; ?></td>
                                                <td><?php echo $acat->goal_per_rate; ?></td>
                                                <td><?php echo $acat->win_amount; ?></td>
                                                <td><?php echo $acat->betting_credit; ?></td>
                                              
<td>
  <?php if ($acat->pay_status==0) { ?>
   
                                               <form method="post" action="<?php echo base_url()?>Admin/add_balance_by_user">
              
                   <input type="hidden" name="user_id" value="<?php echo $acat->member_id; ?>">
                   <input type="hidden" name="team1_score" value="<?php echo $acat->team1_score; ?>">
                    <input type="hidden" name="betting_id" value="<?php echo $acat->betting_id; ?>">
                   <input type="hidden" name="team2_score" value="<?php echo $acat->team2_score; ?>">
                    <input type="hidden" name="match_id" value="<?php echo $acat->match_id; ?>">

                    <input type="hidden" name="bet_amt" value="<?php echo $acat->betting_credit; ?>">
                  <button type="submit" class="btn-sm btn-info confirmation">Add Balance</button>
</form>
<?php } ?>

  <?php if ($acat->pay_status==1) { ?>
<span class="badge bg-green">Paid</span>
    <?php } ?>

</td>

                                              
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>

                        <!-- </div> -->
                    </div>
                    <!-- Main row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- /.content-wrapper -->
      
 <?php $this->load->view('admin/footer') ?>
     

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

 <?php $this->load->view('admin/js') ?>
 <!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<!-- script for alert conformation -->
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script> 

  </body>
</html>
