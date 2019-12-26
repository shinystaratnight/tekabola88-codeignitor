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
                        Add  Match  
                        <small> Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> Match</a></li>
                        <li class="active">Add Match</li>
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
                                <div class="box-header">
                                    <h3 class="box-title"> Add Match</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                         <div class="form-group">
                                            <label>Team A Name :<span class="text-danger">*</span></label>
                                            <select class="form-control select2"  name="team1" style="width: 100%;">
                                              <option selected="selected"  disabled="disabled">Select Team...</option>
                                           <?php foreach($allteam as $acat){ ?>

                                              <option value="<?php echo $acat->team_id; ?>"><?php echo $acat->team_name; ?></option>
                                          <?php }?>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label>Team B Name :<span class="text-danger">*</span></label>
                                            <select class="form-control select2"  name="team2" style="width: 100%;">
                                              <option selected="selected"  disabled="disabled">Select Team...</option>
                                           <?php foreach($allteam as $acat){ ?>

                                              <option value="<?php echo $acat->team_id; ?>"><?php echo $acat->team_name; ?></option>
                                          <?php }?>
                                            </select>
                                          </div>

                                          <!-- Date -->
                                          <div class="form-group">
                                            <label>Match Date:<span class="text-danger">*</span></label>

                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" name="match_date" class="form-control pull-right" id="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                          </div>

                                          <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                              <div class="form-group">
                                                <label>Match Start Time:<span class="text-danger">*</span></label>

                                                <div class="input-group">
                                                  <input type="text" name="match_start_time" class="form-control timepicker">

                                                  <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                  </div>
                                                </div>
                                                <!-- /.input group -->
                                              </div>

                                              <!-- /.form group -->
                                              <div class="form-group">
                                                <label>Match Stop Time:<span class="text-danger">*</span></label>

                                                <div class="input-group">
                                                  <input type="text" name="match_stop_time" class="form-control timepicker">

                                                  <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                  </div>
                                                </div>
                                                <!-- /.input group -->
                                              </div>
                                              <!-- /.form group -->
                                            </div>


                                      
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" name="addmaincatg" value="Add Team" />
                                       
                                    </div>
                                </form>
                            </div><!-- /.box -->
</div>


  <div class="col-md-9">
                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">All Matches</h3>   
                                                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center"> Match ID </th>
                                                <th class="text-center">Match Between</th>
                                                <th>Match Date</th>
                                                <th>Match Time</th>
                                                <!-- <th> Stop Time</th> -->
                                                <th> Add Rate</th>
                                                 <th>End Bid</th>
                                                 <th>Start Bid</th>
                                                <th class="text-center">Action</th>
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($allmatch as $acat){ ?>
                                            <tr>
                                                <td class="text-center"><?php echo $acat->match_id; ?></td>
                                                <td class="text-center" style="width:25%";>
                                                  <div class="row">
                                                    <div class="col-md-5">
                                                      <div class="row">
                                                        <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$acat->team_a_img; ?>" height="25px" width="25px">
                                                      </div>
                                                      <div class="row">
                                                        <?php echo $acat->team_a; ?> 
                                                      </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <strong> VS</strong>
                                                    </div>
                                                    <div class="col-md-5">
                                                      <div class="row">
                                                        <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$acat->team_b_img; ?>" height="25px" width="25px">
                                                      </div>
                                                      <div class="row">
                                                        <?php echo $acat->team_b; ?> 
                                                      </div>
                                                    </div>
                                                  </div>
                                                </td>
                                                 <td><?php echo $acat->match_date; ?></td>
                                                 <td><?php echo $acat->match_start_time; ?> - <?php echo $acat->match_stop_time; ?></td>
                                                 <!-- <td> </td> -->
                                                <td class="text-center"><div class="btn-group">
<?php echo anchor('admin/add_rate/'.$acat->match_id, '<i class="fa fa-plus"></i>', array("class"=>"btn btn-success")); ?>

                                                    </div>
                                                </td>
                                                
                                                  <td class="text-center"><div class="btn-group">
<?php if ($acat->match_status == 1) { ?>
            <?php echo anchor('admin/end_bid_match/'.$acat->match_id, '<i class="fa fa-close">End Bid</i>', array("class"=>"btn btn-danger")); ?>
        <?php } else{?>
<i class="fa fa-success">Ended </i>
        <?php } ?>
   </div>
 </td>
  <td>
<div class="btn-group">
          <?php if ($acat->match_status == 0) { ?>

            <?php echo anchor('admin/start_bid_match/'.$acat->match_id, '<i class="fa fa-start">Start Bid</i>', array("class"=>"btn btn-success")); ?>
           <?php } else{?>
<i class="fa fa-success">Started </i>
        <?php } ?>
                                                 
                                                </td>

                                                <td class="text-center"><div class="btn-group">
<?php echo anchor('admin/editmatch/'.$acat->match_id, '<i class="fa fa-edit"></i>', array("class"=>"btn btn-success")); ?>
<?php echo anchor('admin/delete_teammatch/'.$acat->match_id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger")); ?> 

                                                    </div>
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
