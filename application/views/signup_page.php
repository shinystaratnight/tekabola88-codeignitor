
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Sign Up</title>

  <link href="<?php echo base_url() ?>css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">


<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-2">
            
               
            </div><!-- col-sm-7 -->
            
            <div class="col-md-8">
                
                <form method="post" action="<?php echo base_url() ?>Home/signup">
                    <h3 class="nomargin">Sign Up</h3>
                    <p class="mt5 mb20">Already have an Account? <a href="<?php echo base_url() ?>Home/signin"><strong>Sign In</strong></a></p>

					
                    <?php  if(isset($error)){ echo $error; }
echo $this->session->flashdata('success_req'); ?>


                  <input type="text" class="form-control uname" name="username" placeholder="Username" />
                  

                    <input type="text" class="form-control phn" name="phone" placeholder="Mobile Number" />

                  


                    <input type="password" class="form-control pword" name="password1" placeholder="Password" />
                    <input type="password" class="form-control pword" name="password2" placeholder="Retype Password" />

					
                    <button class="btn btn-success btn-block" type="submit">Sign Up</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2020. All Rights Reserved. 
            </div>
            <div class="pull-right">
             
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>


<script src="<?php echo base_url() ?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap1.min.js"></script>
<script src="<?php echo base_url() ?>js/modernizr.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.cookies.js"></script>

<script src="<?php echo base_url() ?>js/toggles.min.js"></script>
<script src="<?php echo base_url() ?>js/retina.min.js"></script>

<script src="<?php echo base_url() ?>js/custom.js"></script>
<script>
    jQuery(document).ready(function(){
        
        // Please do not use the code below
        // This is for demo purposes only
        var c = jQuery.cookie('change-skin');
        if (c && c == 'greyjoy') {
            jQuery('.btn-success').addClass('btn-orange').removeClass('btn-success');
        } else if(c && c == 'dodgerblue') {
            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
        } else if (c && c == 'katniss') {
            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
        }
    });
</script>

</body>
</html>



