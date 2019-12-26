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
                        Update Team
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>  Home</a></li>
                        <li><a href="#">Team</a></li>
                        <li class="active">Update Team</li>
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
                                    <h3 class="box-title">Update Team</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="<?php echo base_url()?>admin/editteam/<?php echo $getcat->team_id?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="">Team A Name :<span class="text-danger">*</span></label>
                                            <input type="text" name="team" class="form-control" placeholder="Team Name" value="<?php echo $getcat->team_name; ?>"/>
                                            <input type="hidden" name="team_id" class="form-control" placeholder="Team id" value="<?php echo $getcat->team_id; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Team Name (short name) :<span class="text-danger">*</span></label>
                                            <input type="text" name="team_short_name" class="form-control" placeholder="Team Short Name" value="<?php echo $getcat->team_short_name; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Team Image: </label>
                                            <div class="cat-img pull-right" style="width: 50px; height: 50px;">
                                                <img width="100%" height="100%" src="<?php echo $this->config->item('base_url').'uploads/team/'.$getcat->team_image ?>" id="update_cover" />
                                            </div>
                                            <input type="file" name="team_image"  id="changeCover" onchange="imgchange(this)"/>
                                        </div>
                                         
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" name="savemaincat" value="Update Team" />
                                       
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
   <script type="text/javascript">
       function imgchange(f) 
{
    // var base_url=' http://localhost/jobfinder/uploads';
    var filePath = $('#changeCover').val();
    var reader = new FileReader();
    reader.onload = function (e) 
    {
        var target=e.target.result;
        var newimg=$('#update_cover').attr('src',target);
    };
    reader.readAsDataURL(f.files[0]);  

};
   </script>

  </body>
</html>
