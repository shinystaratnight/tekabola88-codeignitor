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
                        Add  Team  
                        <small> Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> Team</a></li>
                        <li class="active">Add Team</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-4">
<?php  if(isset($error)){ echo $error; }
echo $this->session->flashdata('success_req'); ?>
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"> Add Team</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="">Team Name :<span class="text-danger">*</span></label>
                                            <input type="text" name="team" class="form-control" placeholder="Team Name"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Team Name (short name) :<span class="text-danger">*</span></label>
                                            <input type="text" name="team_short_name" class="form-control" placeholder="Team Short Name"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Team Logo :<span class="text-danger">*</span></label>
                                            <input type="file" name="team_image" class="form-control" />
                                        </div>
                                    
                                        <!-- <div class="form-group">
                                            <label> Image:</label>
                                            <input type="file" name="teamimg" />
                                        </div> -->
                                      
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" name="addmaincatg" value="Add Team" />
                                       
                                    </div>
                                </form>
                            </div><!-- /.box -->
</div>


  <div class="col-md-8">
                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">All Team</h3>   
                                                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center"> Team ID </th>
                                                <th class="text-center">Team Image</th>
                                                <th >Team Name</th>
                                                <th >Team Short Name</th>
                                               
                                                <th class="text-center">Action</th>
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($allteam as $acat){ ?>
                                            <tr>
                                                <td class="text-center"><?php echo $acat->team_id; ?></td>
                                                <td class="text-center">
                                                    <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$acat->team_image; ?>" height="50px" width="50px"></td>
                                                 <td><?php echo $acat->team_name; ?></td>
                                                 <td><?php echo $acat->team_short_name; ?></td>
                                              
                                                <td class="text-center"><div class="btn-group">
<?php echo anchor('admin/editteam/'.$acat->team_id, '<i class="fa fa-edit"></i>', array("class"=>"btn btn-success")); ?>
<?php echo anchor('admin/deleteteam/'.$acat->team_id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger", "onclick"=>"return confirm('Are you sure delete?')")); ?>

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

  </body>
</html>
