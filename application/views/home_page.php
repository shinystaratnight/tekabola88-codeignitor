<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

<title>PIPA 2022</title>
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
    <nav class="navbar navbar-default"> 
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="<?php echo base_url() ?>">Home</a></li>
          <li><a href="<?php echo base_url() ?>Home/contact">contact us</a></li>
          <li></li>
    <li></li>
          <li></li>
          <li></li>
          <li><a href="<?php echo base_url() ?>Home/signin">Login</a></li>
          <li><a href="<?php echo base_url() ?>Home/signup">Register</a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
      
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <h1 class="navbar-brand">PIPA 2022</h1> 

      </div>
    </nav>
  </div>
</header>
<section class="slider">
  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel"> 
    <!-- Indicators --> 

    <div class="carousel-inner">






      <div class="item active"> <img data-src="<?php echo base_url() ?>uploads/banner1.jpg" alt="First slide" src="<?php echo base_url() ?>uploads/banner1.jpg">
        <div class="container">
          <div class="carousel-caption">
            <h1></h1>
            <p></p>
            <p><a class="btn btn-success" href="<?php echo base_url() ?>Home/signin" role="button">Login</a><a class="btn btn-info" href="<?php echo base_url() ?>Home/signup" role="button">Register</a></p>
          </div>
        </div>
      </div>



      <div class="item "> <img data-src="<?php echo base_url() ?>uploads/banner2.jpg" alt="First slide" src="<?php echo base_url() ?>uploads/banner2.jpg">
        <div class="container">
          <div class="carousel-caption">
            <h1></h1>
            <p></p>
            <p><a class="btn btn-success" href="<?php echo base_url() ?>Home/signin" role="button">Login</a><a class="btn btn-info" href="<?php echo base_url() ?>Home/signup" role="button">Register</a></p>
          </div>
        </div>
      </div>


      
    </div>


    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon carousel-control-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon carousel-control-right"></span></a> </div>
</section>
<!--end of sldier section-->
<!-- <section class="main__middle__container green_bg">
  <div class="container">
    <div class="row">
      <h2 class="text-center">ALL ABOUT THE WEBSITES AND GAMES ARE GOES HERE..</h2>
      <p class="text-center">Live Online Betting, Live Cricket Betting, Live Football Betting, Live Online Game's Betting, Live Ball Trade Game, Live Head & Tail And Many More..</p>
      
    </div>
  </div>
</section> -->



<footer>
  <div class="container">
    
    <p class="text-center">&copy; Copyright . All Rights Reserved.</p>
  </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url() ?>js/bootstrap.min.js"></script> 
<script type="text/javascript">

$('.carousel').carousel({
  interval: 3500, // in milliseconds
  pause: 'none' // set to 'true' to pause slider on mouse hover
})
</script>
</body>

</html>

