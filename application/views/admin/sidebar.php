<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()?>admindata/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('admin_username'));?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active menu-open">
          <a href="<?php echo base_url() ?>admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>


        <li >
          <a href="<?php echo base_url() ?>admin/member">
            <i class="fa fa-users"></i> <span>Member</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
          <li >
          <a href="<?php echo base_url() ?>admin/add_account">
            <i class="fa fa-plus"></i> <span>Add Account</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
       
        <li>
          <a href="<?php echo base_url() ?>admin/deposit_request">
            <i class="fa fa-plus"></i><span>Deposit Request</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url() ?>admin/withdraw_limit">
            <i class="fa fa-plus"></i><span> Withdraw Limit</span>
          </a>
        </li>
         
        <li>
          <a href="<?php echo base_url() ?>admin/addteam">
            <i class="fa fa-plus"></i> <span>Add Team</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li> 
       
         <li>
          <a href="<?php echo base_url() ?>admin/addmatch">
            <i class="fa fa-plus"></i> <span>Add Match / Rate</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>

  <!--       
       <li >
          <a href="<?php echo base_url() ?>admin/add_rate">
            <i class="fa fa-plus"></i> <span>Add Match & Rate</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li> -->
       
        <li >
          <a href="<?php echo base_url() ?>admin/betting_member_details">
            <i class="fa fa-table"></i> <span>Show Bets</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
       <li >
          <a href="<?php echo base_url() ?>admin/betting_results">
            <i class="fa fa-table"></i> <span>Set Results</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
       <!-- <li >
          <a href="<?php echo base_url() ?>admin/show_winner">
            <i class="fa fa-crown"></i> <span>Show Winners</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li> -->
        
          <li >
          <a href="<?php echo base_url() ?>admin/withdraw_request_by_user">
            <i class="fa fa-table"></i> <span> Withdraw Request</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>