
 <?php $this->load->view('user/user_sidebar') ?>

 
<div class="pageheader">
  <h2><img src="<?php echo base_url() ?>images/wallet.png" style="width: 25px;"> Your Wallet</h2>
</div>
<?php 
echo $this->session->flashdata('success_req'); 
 ?>

<div class="contentpanel">
<div class="panel panel-default">

    <div class="panel-body">
 
    <?php // echo $this->session->flashdata('success_req'); ?>
  <div class="clearfix mb30"></div>
 <div class="col-sm-12">

  <div class="clearfix">
  <?php 
    $x=1; 
    foreach ($wallet as $row) { 
      $balance = $row->balance;
    } 
  ?>
  <form class="form-inline" action="<?php echo base_url() ?>user/transfer" method="post">
    <div class="form-group">
      <input type="number" class="form-control input-sm" name="amount" step="0.01" min="0" max="<?php echo $balance; ?>" style="width:100px;" id="form_amount" placeholder="Amount">
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Transfer</button>
  </form>
  </div>
 	 <div class="table-responsive" style="margin-top: 10px;">       
      <table class="table table-bordered table-striped table-hover" id="table2">
        <thead>    
          <tr>
            <th class="text-center">#</td>
            <th>Your Balance</td>
            <th>Your Credit</td>
          </tr>
        </thead>
        <tbody>
          <?php $x=1; foreach ($wallet as $row) { ?>
          <tr>
            <td class="text-center"><?php echo $x++; ?></td>
            <td><?php echo $row->balance ?></td>
            <td><?php echo $row->credit ?></td>
            <!-- <td> <img src="<?php echo base_url() ?>uploads/<?php echo $row->image ?>" style="width: 50px;height: 50px;">  </td> -->
            <!--    	<td><?php if ($row->requested_action==0) { ?><div style="color:red;">Disapproved</div> <?php } else{ ?> <div style="color:green;">Approved</div><?php  } ?> </td> -->
          </tr>
            
        <?php	} ?>
        </tbody>

      </table> 
    </div><!-- table-responsive -->
 	
 </div>
  
    </div>
  </div>
              
  

  
</div><!-- contentpanel -->





</div><!-- mainpanel -->


</section>

</body>
</html>