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
                                    <h3 class="box-title">Add Admin Account</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="<?php echo base_url()?>admin/add_account" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <h4>Add Admin Account</h4>


                                          <div class="form-group">
                                            <input type="hidden" name="acc_id" value="<?php echo $getcat->acc_id; ?>">
                                            <label>Payment Method:<span class="text-danger">*</span></label>

                                            <div class="input-group " style="width: 100%;">
                                              
                                              <input type="text" name="payment_method" value="" class="form-control pull-right">
                                            </div>
                                            <!-- /.input group -->
                                          </div>

                                            <div class="bootstrap-timepicker">
                                              <div class="form-group">
                                                <label>Account Details:<span class="text-danger">*</span></label>

                                                <div class="input-group" style="width: 100%;">
                                                  <input type="textarea" name="account_details" value=""  class="form-control">

                                                
                                                </div>
                                                <!-- /.input group -->
                                              </div>

                                              <!-- /.form group -->
                                            </div>


                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" name="savemaincat" value="Add Account" />
                                       
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>

  <div class="col-md-6">
                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Admin Account</h3>   
                                                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center"> Account ID </th>
                                                <th >Payment Method</th>
                                                <th >Account Details</th>
                                                <th >Action</th>
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($account as $acat){ ?>
                                            <tr>
                                                <td class="text-center"><?php echo $acat->acc_id; ?></td>
                                                
                                                 <td><?php echo $acat->payment_method; ?></td>
                                                 <td><?php echo $acat->account_details; ?></td>
                                              
                                                <td class="text-center"><div class="btn-group">
<?php echo anchor('admin/editaccount/'.$acat->acc_id, '<i class="fa fa-edit"></i>', array("class"=>"btn btn-success")); ?>
<?php echo anchor('admin/delete_account/'.$acat->acc_id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger", "onclick"=>"return confirm('Are you sure delete?')")); ?>

                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
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
