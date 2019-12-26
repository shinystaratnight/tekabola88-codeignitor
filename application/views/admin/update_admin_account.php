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
                        Admin Account
                        <small>Account</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>  Home</a></li>
                        <!-- <li><a href="#">Team</a></li> -->
                        <li class="active">Admin Account</li>
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
                                    <h3 class="box-title">Update Admin Account</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="<?php echo base_url()?>admin/editaccount" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <h4>Update Admin Account</h4>


                                          <div class="form-group">
                                            <input type="hidden" name="acc_id" value="<?php echo $getaccount->acc_id; ?>">
                                            <label>Payment Method:<span class="text-danger">*</span></label>

                                            <div class="input-group " style="width: 100%;">
                                              
                                              <input type="text" name="payment_method" value="<?php echo $getaccount->payment_method; ?>" class="form-control pull-right">
                                            </div>
                                            <!-- /.input group -->
                                          </div>

                                            <div class="bootstrap-timepicker">
                                              <div class="form-group">
                                                <label>Account Details:<span class="text-danger">*</span></label>

                                                <div class="input-group" style="width: 100%;">
                                                  <input type="textarea" name="account_details" value="<?php echo $getaccount->account_details; ?>"  class="form-control">

                                                
                                                </div>
                                                <!-- /.input group -->
                                              </div>

                                              <!-- /.form group -->
                                            </div>


                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" name="savemaincat" value="Update Account" />
                                       
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
