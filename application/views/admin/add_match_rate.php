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
                        Add  Match Rate  
                        <small> Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> Match</a></li>
                        <li class="active">Add Match Rate</li>
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
                                <?php foreach ($allteam as $value) {?>

                                <div class="box-header">
                                    <h3 class="box-title"> Add Match Rate</h3>
                                </div><!-- /.box-header -->
                                <hr>
                                <div class="box-header">
                                    <!-- <div class="row"> -->
                                    <div class="col-md-5">
                                        <div class="row text-center">
                                            <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$value->team_a_img; ?>" height="25px" width="25px">
                                        </div>
                                        <div class="row text-center">
                                            <?php echo $value->team_a; ?> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <strong> VS</strong>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row text-center">
                                            <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$value->team_b_img; ?>" height="25px" width="25px">
                                        </div>
                                        <div class="row text-center">
                                            <?php echo $value->team_b; ?> 
                                        </div>
                                    </div>
                                                  <!-- </div> -->
                                </div><!-- /.box-header -->
                                <hr>
                                <!-- form start -->                               
                                <?php } ?>
                            </div><!-- /.box-body -->     
                        </div>
                        <div class="col-md-12">                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Match Rate</h3>                                                                   
                                </div><!-- /.box-header -->

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Team A</th>  
                                                    </tr>
                                                </thead>
                                                <tbody>      
                                                    <tr>
                                                        <form action="<?php echo base_url()?>admin/add_rate/<?php echo $value->match_id; ?>" method="post" enctype="multipart/form-data">
                                                            <td>
                                                                <input type="hidden" class="form-control" value="6" name="team_a_goal60">
                                                                <input type="hidden" class="form-control" value="0" name="team_b_goal60">
                                                                <span class="pull-left">Win</span>
                                                            </td>                                                            
                                                            <td>
                                                                <span class="pull-right ">
                                                                    <input type="number" step="0.1"  class="form-control" name="matechrate60" placeholder="your rate">
                                                                </span>
                                                            </td>
                                                                <!--   <td>
                                                                    <input type="submit" name="" value="Submit" class="btn btn-success">
                                                                </td> -->                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" value="<?php echo $value->team_a_id; ?>" name="team_id">
                                                                    <input type="hidden" name="match_id" value="<?php echo $value->match_id; ?>">
                                                                    <input type="hidden" class="form-control" value="1" name="team_a_goal10">
                                                                    <input type="hidden" class="form-control" value="0" name="team_b_goal10">
                                                                    <span class="pull-left">1-0</span>
                                                                </td>
                                                                <td>
                                                                    <span class="pull-right ">
                                                                    <input type="number" step="0.1"  class="form-control" name="matechrate10" placeholder="your rate">
                                                                    </span>
                                                                </td>
                                                                <!-- <td>
                                                                    <input type="submit" name="" value="Submit" class="btn btn-success">
                                                                </td> n-->     
                                                            </tr>                                                            
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" class="form-control" value="2" name="team_a_goal20">
                                                                    <input type="hidden" class="form-control" value="0" name="team_b_goal20">
                                                                    <span class="pull-left">
                                                                    2-0
                                                                    </span>
                                                                </td>
   
                                                                <td>
                                                                    <span class="pull-right ">
                                                                    <input type="number" step="0.1"  class="form-control" name="matechrate20" placeholder="your rate">
                                                                    </span>
                                                                </td>

    <!--   <td>
        <input type="submit" name="" value="Submit" class="btn btn-success">
      </td> -->

      
    </tr>




    
     <tr>

   <td>      

   
      <input type="hidden" class="form-control" value="2" name="team_a_goal21">
      <input type="hidden" class="form-control" value="1" name="team_b_goal21">
      <span class="pull-left">
      2-1
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate21" placeholder="your rate">
        </span>
      </td>
<!-- 
      <td>
        <input type="submit" name="" value="Submit" class="btn btn-success">
      </td> -->

   
    </tr>





    
     <tr>

   <td>      

    
      <input type="hidden" class="form-control" value="3" name="team_a_goal30">
      <input type="hidden" class="form-control" value="0" name="team_b_goal30">
      <span class="pull-left">
      3-0
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate30" placeholder="your rate">
        </span>
      </td>

  
    </tr>
     





    
     <tr>

   <td>      

  
      <input type="hidden" class="form-control" value="3" name="team_a_goal31">
      <input type="hidden" class="form-control" value="1" name="team_b_goal31">
      <span class="pull-left">
      3-1
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate31" placeholder="your rate">
        </span>
      </td>

    </tr>





    
     <tr>

   <td>      

     
      <input type="hidden" class="form-control" value="3" name="team_a_goal32">
      <input type="hidden" class="form-control" value="2" name="team_b_goal32">
      <span class="pull-left">
      3-2
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate32" placeholder="your rate">
        </span>
      </td>

      
    </tr>




    
     <tr>

   <td>      

     
      <input type="hidden" class="form-control" value="4" name="team_a_goal40">
      <input type="hidden" class="form-control" value="0" name="team_b_goal40">
      <span class="pull-left">
      4-0
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate40" placeholder="your rate">
        </span>
      </td>

    </tr>




    
     <tr>

   <td>      

     
      <input type="hidden" class="form-control" value="4" name="team_a_goal41">
      <input type="hidden" class="form-control" value="1" name="team_b_goal41">
      <span class="pull-left">
      4-1
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate41" placeholder="your rate">
        </span>
      </td>

  
    </tr>





    
     <tr>

   <td>      

     
      <input type="hidden" class="form-control" value="4" name="team_a_goal42">
      <input type="hidden" class="form-control" value="2" name="team_b_goal42">
      <span class="pull-left">
      4-2
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate42" placeholder="your rate">
        </span>
      </td>

    </tr>




    
     <tr>

   <td>      

     
      <input type="hidden" class="form-control" value="4" name="team_a_goal43">
      <input type="hidden" class="form-control" value="3" name="team_b_goal43">
      <span class="pull-left">
      4-3
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate43" placeholder="your rate">
        </span>
      </td>

     

     
    </tr>



     <tr>

   <td>      

     
      <input type="hidden" class="form-control" value="5" name="team_a_goal50">
      <input type="hidden" class="form-control" value="0" name="team_b_goal50">
      <span class="pull-left">
      5up
      </span>
   </td>
   
      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate50" placeholder="your rate">
        </span>
      </td>

     

     
    </tr>


     <tr>
<td>
      
      </td>

   <td>
        <input type="submit" name="" value="Submit" class="btn btn-success">
      </td>

      </form>
    </tr>
                   
                                        </tbody>
                                      </table>
                                    </div>


                                    <div class="col-md-4">
                                      <table class="table table-bordered table-striped">

                                        <thead>
                                          <tr>
                                          <th class="text-center">Draw</th>  
                                        </tr></thead>
                                        <tbody>
                                       

     <tr>
<form action="<?php echo base_url()?>admin/add_rate_team_d/<?php echo $value->match_id; ?>" method="post" enctype="multipart/form-data">
   <td>      

      <input type="hidden" value="<?php echo $value->team_a_id; ?>" name="team_id">

      <input type="hidden" name="match_id" value="<?php echo $value->match_id; ?>">
      <input type="hidden" class="form-control" value="0" name="team_a_goal00">
      <input type="hidden" class="form-control" value="0" name="team_b_goal00">
      <span class="pull-left">
      0-0
      </span>
   </td>

      <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate00" placeholder="your rate">
        </span>
      </td>

   

     
    </tr>




      <tr>
    
      <td>      

    
          <input type="hidden" class="form-control" value="1" name="team_a_goal11">
          <input type="hidden" class="form-control" value="1" name="team_b_goal11">
          <span class="pull-left">
          1-1
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate11" placeholder="your rate">
          </span>
          </td>
         

      </tr>



      <tr>
     
      <td>      

        
          <input type="hidden" class="form-control" value="2" name="team_a_goal22">
          <input type="hidden" class="form-control" value="2" name="team_b_goal22">
          <span class="pull-left">
          2-2
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate22" placeholder="your rate">
          </span>
          </td>
       
     
      </tr>


      <tr>
    
      <td>      

          <input type="hidden" class="form-control" value="3" name="team_a_goal33">
          <input type="hidden" class="form-control" value="3" name="team_b_goal33">
          <span class="pull-left">
         3-3
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate33" placeholder="your rate">
          </span>
          </td>
          

      </tr>




      <tr>
    
      <td>      

          <input type="hidden" class="form-control" value="4" name="team_a_goal44">
          <input type="hidden" class="form-control" value="4" name="team_b_goal44">
          <span class="pull-left">
          4-4
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate44" placeholder="your rate">
          </span>
          </td>
         
      </tr>

      <tr>
        <td></td>
         <td>
          <input type="submit" name="" value="Submit" class="btn btn-success">
         </td>

      </form>
      </tr>

                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="col-md-4">
                                      <table class="table table-bordered table-striped">

                                        <thead>
                                          <th class="text-center">Team B</th>  
                                        </thead>
                                        <tbody>
                                       





   

      <form action="<?php echo base_url()?>admin/add_rate_team_b/<?php echo $value->match_id; ?>" method="post" enctype="multipart/form-data">
  <tr>
    
      <td><input type="hidden" class="form-control" value="0" name="team_a_goal06">
          <input type="hidden" class="form-control" value="6" name="team_b_goal06">
          <span class="pull-left">
          Win
          </span>
          </td>
          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate06" placeholder="your rate">
          </span>
          </td></tr>
             <tr>
      <td>      

          <input type="hidden" value="<?php echo $value->team_a_id; ?>" name="team_id">
          
          <input type="hidden" name="match_id" value="<?php echo $value->match_id; ?>">
          <input type="hidden" class="form-control" value="0" name="team_a_goal01">
          <input type="hidden" class="form-control" value="1" name="team_b_goal01">
          <span class="pull-left">
          0-1
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate01" placeholder="your rate">
          </span>
          </td>
          
     
      </tr>

      <tr>
    
      <td><input type="hidden" class="form-control" value="0" name="team_a_goal02">
          <input type="hidden" class="form-control" value="2" name="team_b_goal02">
          <span class="pull-left">
          0-2
          </span>
          </td>
          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate02" placeholder="your rate">
          </span>
          </td></tr>

      <tr>
     
      <td>      

         
          <input type="hidden" class="form-control" value="1" name="team_a_goal12">
          <input type="hidden" class="form-control" value="2" name="team_b_goal12">
          <span class="pull-left">
          1-2
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate12" placeholder="your rate">
          </span>
          </td>
         
      </tr>

      <tr>
     
      <td>      

       
          <input type="hidden" class="form-control" value="0" name="team_a_goal03">
          <input type="hidden" class="form-control" value="3" name="team_b_goal03">
          <span class="pull-left">
          0-3
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate03" placeholder="your rate">
          </span>
          </td>
         
   
      </tr>

      <tr>
      
      <td>      

        
          <input type="hidden" class="form-control" value="1" name="team_a_goal13">
          <input type="hidden" class="form-control" value="3" name="team_b_goal13">
          <span class="pull-left">
          1-3
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate13" placeholder="your rate">
          </span>
          </td>
       
      </tr>


      <tr>
  
      <td>      

         
          <input type="hidden" class="form-control" value="2" name="team_a_goal23">
          <input type="hidden" class="form-control" value="3" name="team_b_goal23">
          <span class="pull-left">
          2-3
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate23" placeholder="your rate">
          </span>
          </td>
        
      
      </tr>

      <tr>
    
      <td>      

         
          <input type="hidden" class="form-control" value="0" name="team_a_goal04">
          <input type="hidden" class="form-control" value="4" name="team_b_goal04">
          <span class="pull-left">
          0-4
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate04" placeholder="your rate">
          </span>
          </td>
       
      </tr>


      <tr>
    
      <td>      

          <input type="hidden" class="form-control" value="1" name="team_a_goal14">
          <input type="hidden" class="form-control" value="4" name="team_b_goal14">
          <span class="pull-left">
          1-4
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate14" placeholder="your rate">
          </span>
          </td>
         
      </tr>




      <tr>
   
      <td>      

          <input type="hidden" class="form-control" value="2" name="team_a_goal24">
          <input type="hidden" class="form-control" value="4" name="team_b_goal24">
          <span class="pull-left">
          2-4
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate24" placeholder="your rate">
          </span>
          </td>
         
      </tr>


      <tr>
     
      <td>      

          <input type="hidden" class="form-control" value="3" name="team_a_goal34">
          <input type="hidden" class="form-control" value="4" name="team_b_goal34">
          <span class="pull-left">
          3-4
          </span>
          </td>

          <td>
          <span class="pull-right ">
          <input type="number" step="0.1"  class="form-control" name="matechrate34" placeholder="your rate">
          </span>
          </td>
         
      </tr>

<tr>
  <td>      
      <input type="hidden" class="form-control" value="5" name="team_a_goal51">
      <input type="hidden" class="form-control" value="1" name="team_b_goal51">
      <span class="pull-left">
      5up
      </span>
   </td>
       <td>
        <span class="pull-right ">
        <input type="number" step="0.1"  class="form-control" name="matechrate51" placeholder="your rate">
        </span>
      </td>
    </tr>

      <tr>
        <td></td>
        <td>
          
          <input type="submit" name="" value="Submit" class="btn btn-success">
        
      </form>
        </td>
      </tr>



                                        </tbody>
                                      </table>
                                    </div>

                                     <div class="box box-danger">
  <div class="col-md-12">
                           
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Match Rate</h3>   
                                                                   
                                </div><!-- /.box-header -->

                                <div class="box-body">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <table class="table table-bordered table-striped">

                                        <thead>
                                          <th class="text-center">Team A</th>  
                                        </thead>
                                        <tbody>
                                        <?php foreach($allteamrateA as $acat){ ?>
                                          <tr>
                                            <td >
                                              <span class="pull-left">
                                                <?php if($acat->score_a==5) {?>
                                                    5up
                                                <?php } else {
                                                    if($acat->score_a==6){?>
                                                      Win
                                                    <?php }else{ ?>
                                                        <?php echo $acat->score_a; ?> - <?php echo $acat->score_b; ?>
                                                <?php } }?>           
                                              </span>
                                              <span class="pull-right ">
                                                <?php echo $acat->rate_per_goal; ?>  
                                                 <?php echo anchor('admin/deleterate/'.$acat->team_goal_rate_id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger")); ?>           
                                              </span>
                                          
                                            </td>
                                          </tr>
                                          <?php }?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="col-md-4">
                                      <table class="table table-bordered table-striped">

                                        <thead>
                                          <th class="text-center">Draw</th>  
                                        </thead>
                                        <tbody>
                                        <?php foreach($allteamrateD as $acat){ ?>
                                          <tr>
                                            <td >
                                              <span class="pull-left">
                                                <?php if($acat->score_a==5) {?>
                                                        5up
                                                <?php }else{?>
                                                <?php echo $acat->score_a; ?> - <?php echo $acat->score_b; ?>       <?php }?>      
                                              </span>
                                              <span class="pull-right ">
                                                <?php echo $acat->rate_per_goal; ?> 
                                                 <?php echo anchor('admin/deleterate/'.$acat->team_goal_rate_id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger")); ?>         
                                              </span>


                                            </td>
                                          </tr>
                                          <?php }?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="col-md-4">
                                      <table class="table table-bordered table-striped">

                                        <thead>
                                          <th class="text-center">Team B</th>  
                                        </thead>
                                        <tbody>
                                        <?php foreach($allteamrateB as $acat){ ?>
                                          <tr>
                                            <td >
                                              <span class="pull-left">
                                                  <?php if($acat->score_a==5) {?>
                                                        5up
                                                <?php } else
                                                {
                                                    if($acat->score_b==6){?>
                                                      Win
                                                    <?php }else{ ?>
                                                    <?php echo $acat->score_a; ?> - <?php echo $acat->score_b; ?>       <?php } }?>      
                                              </span>
                                              <span class="pull-right ">
                                                <?php echo $acat->rate_per_goal; ?> 
                                                 <?php echo anchor('admin/deleterate/'.$acat->team_goal_rate_id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger")); ?>        
                                              </span>
                                            </td>
                                          </tr>
                                          <?php }?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>

                                  </div>
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
