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
                        Add Results  
                        <small> Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <!-- <li><a href="#"> Team</a></li> -->
                        <li class="active">Add Results</li>
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
                                    <h3 class="box-title"> Add Results</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="<?php echo base_url()?>admin/betting_results" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="">Select Match:<span class="text-danger">*</span></label>

                                            <select name="match_id" class="form-control select2" require="">
                                              <option selected="selected"  disabled="disabled">Select Match...</option>

                                            <?php foreach ($allteam as $value) {?>

                                            <option value="<?php echo $value->match_id; ?>"><?php echo $value->team_a; ?> <strong>VS</strong> <?php echo $value->team_b; ?> <small class="pull-right">(<?php echo $value->match_date; ?>)(<?php echo $value->match_start_time; ?>)</small></option>

                                            <?php } ?>

                                            </select>
                                        </div>
                                        
                <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Goal & Rate</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12 form-group">
                  
                 <input type="number" class="form-control" placeholder="Team A Score" name="team_a_score">
                </div>
                <div class="col-xs-12 form-group">
                  <input type="number" class="form-control" placeholder="Team B Score" name="team_b_score">
                </div>
                <!-- <div class="col-xs-5">
                  <input type="text" class="form-control" placeholder="Rate" name="matechrate">
                </div> -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
                
                                    

            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <input type="submit" class="btn btn-primary" name="addmaincatg" value="Add Result" />
            
        </div>
        </form>
                            </div><!-- /.box -->
</div>


  <div class="col-md-9">
                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">All Results</h3>   
                                                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Match Id</th>
                                                <th class="text-center" style="width: 25%">Match</th>
                                               <th class="text-center">Score</th>
                                                <th>Date</th>   
                                                <th>Time</th>   
                                                <th>Announce Winner</th>   
                                                <th>Show Winner</th>   
                                                <th>Action</th>
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($allteamrate as $acat){ ?>
                                            <tr>
                                                <td class="text-center"><?php echo $acat->match_id; ?> </td>
                                                <td class="text-center">
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
                                                 <td class="text-center"><?php echo $acat->team_a_winning_score; ?> <strong>-</strong> <?php echo $acat->team_b_winning_score; ?> </td>
                                                <td><?php echo $acat->match_date; ?> </td>
                                                <td><?php echo $acat->match_start_time; ?><strong>-</strong><?php echo $acat->match_stop_time; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                     <?php if($acat->match_winners=='0')
                                                      {
                                                        $x=$acat->match_winners;
                                                        ?>
                                                        <?php echo anchor('admin/announce_winning_result/'.$acat->match_id.'/'.$acat->team_a_winning_score.'/'.$acat->team_b_winning_score, '<i class="fa fa-trophy"></i>', array("class"=>"btn btn-success", "onclick"=>"return confirm('Are you sure Announce ?')")); ?>
                                                       <?php }
                                                        else{
                                                        $x=$acat->match_winners;
                                                        echo '<span class="badge bg-blue" >';
                                                        echo "Declared" ;
                                                        echo '</span>';
                                                      }
                                                       ?>

                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                <?php if($acat->match_winners=='0')
                                                {
                                                  $x=$acat->match_winners;

                                                  echo '<span class="badge bg-blue" >';
                                                  echo "Pending" ;
                                                  echo '</span>';


                                                } 
                                               
                                                else{
                                                  $x=$acat->match_winners;
                                                 echo anchor('admin/show_winner/'.$acat->match_id.'/'.$acat->team_a_winning_score.'/'.$acat->team_b_winning_score, '<i class="fa fa-eye"></i>', array("class"=>"btn btn-success", "onclick"=>"return confirm('Are you sure ?')")); 

                                                }
                                                ?>

                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <?php echo anchor('admin/deletematch_result/'.$acat->match_id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger", "onclick"=>"return confirm('Are you sure delete?')")); ?>

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
