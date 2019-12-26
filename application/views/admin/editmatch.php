<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | FootBall</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
                        Update Match
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>  Home</a></li>
                        <li><a href="#">Team</a></li>
                        <li class="active">Update Match</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('success_req'); ?>
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Update Match</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="<?php echo base_url()?>admin/editmatch/<?php echo $getcat->match_id?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <h4><?php echo $getcat->team_a; ?><b> VS </b><?php echo $getcat->team_b; ?></h4>
                                    <!--     <div class="form-group">
                                            <label class="">Team A Name :<span class="text-danger">*</span></label>
                                            <input type="text" name="team1" class="form-control" placeholder="Team A" value="<?php echo $getcat->team_a; ?>"/>
                                            <input type="hidden" name="match_id" class="form-control" placeholder="Categories id" value="<?php echo $getcat->match_id; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Team B Name :<span class="text-danger">*</span></label>
                                            <input type="text" name="team2" class="form-control" placeholder="Team B" value="<?php echo $getcat->team_b; ?>"/>
                                        </div>
                                        -->
                                        <div class="form-group">
                                          <input type="hidden" name="match_id" value="<?php echo $getcat->match_id; ?>" />

                                            <label>Team A Name :<span class="text-danger">*</span></label>
                                            <select class="form-control select2"  name="team1" style="width: 100%;">
                                                <option selected="selected"  disabled="disabled">Select Team...</option>
                                                <?php foreach($allteam as $acat){ ?>

                                                <option  <?php if($acat->team_name == $getcat->team_a){  echo 'selected="selected"';} ?> value="<?php echo $acat->team_id; ?>">
                                                    <?php echo $acat->team_name; ?>
                                                </option>
                                                <?php }
                                                ?>
                                              
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Team B Name :<span class="text-danger">*</span></label>
                                            <select class="form-control select2"  name="team2" style="width: 100%;">
                                                <option selected="selected"  disabled="disabled">Select Team...</option>
                                                <?php foreach($allteam as $acat){ ?>

                                                <option  <?php if($acat->team_name == $getcat->team_b){  echo 'selected="selected"';} ?> value="<?php echo $acat->team_id; ?>">
                                                    <?php echo $acat->team_name; ?>
                                                </option>
                                                <?php }
                                                ?>
                                            </select>
                                          </div>


                                          <!-- Date -->
                                          <div class="form-group">
                                            <label>Match Date:<span class="text-danger">*</span></label>

                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" name="match_date" value="<?php echo $getcat->match_date; ?>" class="form-control pull-right" id="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                          </div>

                                          <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                              <div class="form-group">
                                                <label>Match Start Time:<span class="text-danger">*</span></label>

                                                <div class="input-group">
                                                  <input type="text" name="match_start_time" value="<?php echo $getcat->match_start_time; ?>"  class="form-control timepicker">

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
                                                  <input type="text" name="match_stop_time" value="<?php echo $getcat->match_stop_time; ?>"  class="form-control timepicker">

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
                                        <input type="submit" class="btn btn-primary" name="savemaincat" value="Update Match" />
                                       
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
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

  </body>
</html>
