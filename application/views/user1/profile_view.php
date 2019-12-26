<?php $this->load->view('user/user_sidebar') ?>

    <div class="pageheader">
      <h2><i class="fa fa-user"></i>View Profile </h2>
    </div>

    <div class="contentpanel">
    <?php foreach ($pic as $row){?>
      <div class="row">
 
        <div class="col-sm-3 col-md-3">

<img src="<?php echo base_url() ?>uploads/<?php echo $row->profile_pic ?>" width="100%" alt="IMG">
</div>		

 
 <div class="col-sm-9">

          <div class="profile-header">
            <h2 class="profile-name"><i class="fa fa-phone"></i> <?php echo ucfirst($this->session->userdata('userid'));?> </h2>
           
            <div class="mb20"></div>
			
 
		
        </div><!-- profile-header -->
        </div><!-- col-sm-9 -->
      
	  
	  
	  
	  </div><!-- row -->
      <?php } ?>
      
      
      
    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>



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