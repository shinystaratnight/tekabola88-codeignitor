
 <?php $this->load->view('user/user_sidebar') ?>

    <div class="pageheader">
      <h2><i class="fa fa-home"></i>  Profile Setting</h2>
    </div>

   <div class="contentpanel">

      <div class="row">
        <div class="col-md-12">
      <div class="panel panel-default">


                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('success_req'); ?>
        
        <div style="display: block;" class="panel-body panel-body-nopadding">
          
          <form action="<?php echo base_url() ?>user/update" method="post" class="form-horizontal form-bordered">
         
      
      
            <div class="form-group">
              <label class="col-sm-3 control-label">Password</label>
              <div class="col-sm-6"><input name="password"  class="form-control" type="password"></div>
            </div>
                
                  
                      <div class="form-group">
              <label class="col-sm-3 control-label">Re-Password</label>
              <div class="col-sm-6"><input name="repassword" class="form-control" type="password"></div>
            </div>
                            
        </div><!-- panel-body -->
        
        <div style="display: block;" class="panel-footer">
       <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <button class="btn btn-primary">Submit</button>
        </div>
       </div>
       
       </form>
          
          
       
      </div><!-- panel-footer -->
        
      </div><!-- panel -->
      
      </div><!-- col-md-12 -->
      
      </div><!-- row -->

      
      
      
    </div>

  </div><!-- mainpanel -->

  
</section>

 	
</body>
</html>