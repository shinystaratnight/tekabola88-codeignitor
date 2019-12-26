 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="" type="image/png">

  <title>PIPA 2022</title>

  <link href="<?php echo base_url()?>css/style.default.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>css/jquery.datatables.css" rel="stylesheet">


<script src="<?php echo base_url()?>userjs/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>userjs/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url()?>userjs/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url()?>userjs/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>userjs/modernizr.min.js"></script>
<script src="<?php echo base_url()?>userjs/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url()?>userjs/toggles.min.js"></script>
<script src="<?php echo base_url()?>userjs/retina.min.js"></script>
<script src="<?php echo base_url()?>userjs/jquery.cookies.js"></script>

<script src="<?php echo base_url()?>userjs/custom.js"></script>

<script src="<?php echo base_url() ?>js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url() ?>js/select2.min.js"></script>

</head>
<body>   
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

  <div class="leftpanel">

    <div class="logopanel">
        <h1><span>[</span> PIPA 2022  <span>]</span></h1>
    </div><!-- logopanel -->

    <div class="leftpanelinner">

        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">

        <h5 class="sidebartitle actitle">Account</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket mb30">
        <li><a href="#"><i class="fa fa-user"></i> <span>View Profile</span></a></li>
        <li><a href="<?php echo base_url() ?>user/update"><i class="fa fa-cog"></i> <span>Change Password</span></a></li>
       
        <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
        </ul>
        </div>

      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li><a href="<?php echo base_url() ?>user"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

				<li class="nav-parent"><a href="#"><i class="fa fa-cog"></i> <span>Setting</span></a>
          <ul class="children">
            <li><a href="<?php echo base_url() ?>user/update"><i class="fa fa-caret-right"></i> Profile Setting</a></li>
            <li><a href="<?php echo base_url() ?>user/profilepicture"><i class="fa fa-caret-right"></i> Profile Picture</a></li>
          </ul>
        </li>  
     	
        <li class="nav-parent"><a href="#"><i class="fa fa-gamepad"></i> <span>Match History</span></a>
          <ul class="children">
            <li><a href="<?php echo base_url() ?>user/all_team"><i class="fa fa-caret-right"></i>Place your Bid</a></li>
            <!-- <li><a href="<?php echo base_url() ?>user/trade_game_view"><i class="fa fa-caret-right"></i>7 Trade Game</a></li> -->
            <li><a href="<?php echo base_url() ?>user/trade_statistics"><i class="fa fa-caret-right"></i>Your Statistics</a></li>
            <!-- <li><a href="<?php echo base_url() ?>user/trade_winner"><i class="fa fa-caret-right"></i>Winner List</a></li> -->
          </ul>
        </li>
        <li><a href="<?php echo base_url() ?>user/deposite_request"><i class="fa fa-cog"></i> <span>Deposit Request</span></a>         
        <li><a href="<?php echo base_url() ?>user/w_request"><i class="fa fa-cog"></i> <span>Withdrawal Request</span></a>         
        <li><a href="<?php echo base_url() ?>user/your_wallet"><i class="fa fa-cog"></i> <span>Wallet</span></a>         
        </li>  
    	

        <!-- <li><a href="#"><i class="fa fa-gamepad"></i> <span>Head And Tail</span></a></li>
        <li><a href="#"><i class="fa fa-gamepad"></i> <span>Bid Game</span></a></li>


        <li class="nav-parent"><a href="#"><i class="fa fa-dollar"></i> <span>Finance &nbsp;		
		<span class="badge badge-success">0</span></span></a>
          <ul class="children">
            <li><a href="#"><i class="fa fa-caret-right"></i>Add Balance</a></li>
            <li><a href="#"><i class="fa fa-caret-right"></i>Withdraw Balance</a></li>
            <li><a href="#"><i class="fa fa-caret-right"></i>Balance Transfer</a></li>
            <li><a href="#"><i class="fa fa-caret-right"></i>Transaction Report</a></li>
          </ul>
        </li> -->


        <!-- <li><a href="#"><i class="fa fa-user"></i> <span>Affiliation</span></a></li> -->
		
      </ul>

      

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">

    <div class="headerbar">

      <a class="menutoggle"><i class="fa fa-bars"></i></a>


      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <?php foreach ($pic as $row){?>
                <img src="<?php echo base_url() ?>uploads/<?php echo $row->profile_pic ?>" alt="" />
              <?php } ?>
                <?php echo ucfirst($this->session->userdata('userid'));?>                
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
			  
              <li><a href="<?php echo base_url() ?>user/profile"><i class="fa fa-user"></i> <span>View Profile</span></a></li>
              <li><a href="<?php echo base_url() ?>user/update"><i class="fa fa-cog"></i> <span>Change Password</span></a></li>
               <li><a href="<?php echo base_url() ?>user/your_wallet"><i class="fa fa-cog"></i> <span>Your Wallet</span></a></li>
			  
              <li><a href="<?php  echo base_url()?>home/signout"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div><!-- header-right -->

    </div><!-- headerbar -->
