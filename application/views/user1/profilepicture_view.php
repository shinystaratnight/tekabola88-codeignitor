<?php $this->load->view('user/user_sidebar') ?>
    <div class="pageheader">
      <h2><i class="fa fa-user"></i> Profile Picture </h2>
    </div>

    <div class="contentpanel">

      <div class="row">

        <div class="col-md-12">
      
      <div class="panel panel-default">
        <!--div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">×</a>
            <a href="#" class="minimize">−</a>
          </div>      
        </div-->
        <div style="display: block;" class="panel-body panel-body-nopadding">
          
        <?php  if(isset($error)){ echo $error; }
echo $this->session->flashdata('success_req'); ?>


    							 <form   action="<?php echo base_url() ?>User/profilepicture" method="post" enctype="multipart/form-data" >
<br/>
				  
            <div class="form-group">
              <label class="col-sm-3 control-label">Select Picture</label>
              <div class="col-sm-6"><input name="bgimg" type="file" id="bgimg" /></div>
            </div>
               <input type="hidden" name="id" value="1">
            
        </div><!-- panel-body -->
        
        <div style="display: block;" class="panel-footer">
			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary" type="submit">Submit</button>
				</div>
			 </div>
			 
			 
          </form>
          
			 
		  </div><!-- panel-footer -->
        
		<?php foreach ($pic as $row){?>
        
       Current Image : <br/> &nbsp; &nbsp; <img src="<?php echo base_url() ?>uploads/<?php echo $row->profile_pic ?>" width="300px;" height="300px" alt="IMG">
        <?php } ?>
<br/><br/><br/><br/>
		
		
      </div><!-- panel -->
      
     
      
     
      
      

     
     
    </div>
	  
	  
	  
       

       
      
      </div><!-- row -->

      
      
      
    </div><!-- contentpanel -->



 





<!--script src="js/flot/jquery.flot.min.js"></script>
<script src="js/flot/jquery.flot.resize.min.js"></script>
<script src="js/flot/jquery.flot.spline.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael-2.1.0.min.js"></script>

<script src="js/custom.js"></script>
<script src="js/dashboard.js"></script-->

<!--script src="js/jquery-1.7.0.min.js"></script>
<script type="text/javascript" src="js/jquery.activeNavigation.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
    	$(document).activeNavigation(".nav")
	});	
	</script-->
 
 	
</body>
</html>