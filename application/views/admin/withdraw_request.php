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
                        Withdraw Request 
                        <small> Limit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li> Request</li>
                        <li class="active">Withdraw Request</li>
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
                                    <h3 class="box-title"> Change Withdraw Request Limit For Free User</h3>
                                    <small>its now 555/888/1288</small>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="<?php echo base_url() ?>admin/withdraw_limit" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="">Withdraw Request Limit :<span class="text-danger">*</span></label>
                                            <input type="number" name="limit" class="form-control" placeholder="withdraw limit 1"  />
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="">Withdraw Request Limit :<span class="text-danger">*</span></label>
                                            <input type="text" name="limit[]" class="form-control" placeholder="withdraw limit 2"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Withdraw Request Limit :<span class="text-danger">*</span></label>
                                            <input type="text" name="limit[]" class="form-control" placeholder="withdraw limit 3"/>
                                        </div> -->
                                       
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" name="addmaincatg" value="Change Limit" />
                                       
                                    </div>
                                </form>
                            </div><!-- /.box -->
</div>


  <div class="col-md-6">
                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">All Limits</h3>   
                                                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Limit </th>
                                                <th class="text-center">Changed Date </th>
                                                <th class="text-center">Delete </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($data as $value){ ?>
                                            <tr>
                                                <td class="text-center"><?php echo $value->withdraw_limit; ?></td>
                                                <td class="text-center"><?php echo $value->created; ?></td>
                                                <td class="text-center">
                                                <?php echo anchor('admin/deletewithdraw_limit/'.$value->id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger", "onclick"=>"return confirm('Are you sure delete?')")); ?>
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

  </body>
</html>
