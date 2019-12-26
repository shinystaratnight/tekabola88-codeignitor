<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">


<title> PIPA 2022</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Comfortaa:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url() ?>css/style.css" rel="stylesheet">




  <link rel="shortcut icon" href="images/fav.png" type="image/png">

<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<body>
<header class="main__header">
  <div class="container">
    <nav class="navbar navbar-default" > 
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li class="active"><a href="<?php echo base_url() ?>Home/contact">contact us</a></li>
          <li></li>
          <li></li>
          <li><h1 style="color:white;">PIPA 2022</h1></li>
          <li></li>
          <li></li>
          <li><a href="<?php echo base_url() ?>Home/signin">Login</a></li>
          <li><a href="<?php echo base_url() ?>Home/signup">Register</a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
      
      <!-- Brand and toggle get grouped for better mobile display -->
     
    </nav>
  </div>
</header>



<section class="main__middle__container green_bg">


  <div class="container">
    <div class="row">
      <h2 class="text-center">Facing Problem or Any Query ....??</h2>
      <p class="text-center">Please Fell Free to Contact Us </p>
      
   </div>
  </div>

</section>





<section class="main__middle__container">

<h1>&nbsp;</h1>
  <div class="container">
    <div class="row">


<form method="post" action="<?php echo base_url() ?>Home/contact">
<?php  if(isset($error)){ echo $error; }
echo $this->session->flashdata('success_req'); ?>


<div class="form-group">
      <div class="col-sm-4"><input placeholder="Your Name" name="name" class="form-control" type="text"></div>
      <div class="col-sm-4"><input placeholder="Your Email" name="email" class="form-control" type="text"></div>
      <div class="col-sm-4"><input placeholder="Your Phone" name="phone" class="form-control" type="text"></div>

<br/>
<br/>
<br/>
      <div class="col-sm-12"><input placeholder="Subject" name="subject" class="form-control" type="text"></div>

<br/>
<br/>
<br/>
<div class="col-sm-12"><textarea class="form-control" placeholder="Your Message" name="msg" rows="5"></textarea></div>

<br/>
<br/>
<br/>
<div class="col-sm-12"><button class="btn btn-primary btn-block" type="submit">Send Message</button></div>
  </div>                  
                </form>
</div>



      	  
  </div>
</section>


<footer>
  <div class="container">
    
    <p class="text-center">&copy; Copyright. All Rights Reserved.</p>
  </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="indx/js/bootstrap.min.js"></script> 
<script type="text/javascript">

$('.carousel').carousel({
  interval: 3500, // in milliseconds
  pause: 'none' // set to 'true' to pause slider on mouse hover
})
</script>
</body>

</html>

