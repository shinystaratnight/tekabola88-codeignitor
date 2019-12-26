 <?php $this->load->view('user/user_sidebar') ?>

 
<div class="pageheader">
  <h2><i class="fa fa-gamepad"></i> Deposit Request </h2>
</div>
<?php 
echo $this->session->flashdata('success_req'); 
 ?>
<?php  if(isset($error)){ echo $error; }
 ?>
<div class="contentpanel">
<div class="panel panel-default">

    <div class="panel-body">

 <div class="clearfix mb30"></div>
 <form  action="<?php echo base_url() ?>user/deposite_request" method="post" enctype="multipart/form-data" >
	<div class="form-group">
<label class="col-sm-3 control-label">Payment Method</label>
<div class="col-sm-6">

<select class="form-control" name="pay_method">
  <option>Select bank Account</option>
  <?php foreach ($account as $row) { ?>
  <option value="<?php echo $row->acc_id ?>"><?php echo $row->account_details ?></option>

<?php } ?>
</select>
 </div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Credit</label>
<div class="col-sm-6"><input name="credit"  class="form-control" type="number" ></div>
<input name="user_id"  class="form-control" type="hidden" value="<?php echo $this->session->userdata('id'); ?>">
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Time</label>
<div class="col-sm-6"><input name="time"  class="form-control" type="time" ></div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Transition Id</label>
<div class="col-sm-6"><input name="transition_id"  class="form-control" type="text"></div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Image</label>
<div class="col-sm-6"><input type="file"  name="image"  class="form-control" required=""></div>
</div>
<center>
	
<div class="form-group">
<input name="submit"  class="btn btn-success" type="submit">
</div>
</center>

 
 </form>
  <div class="clearfix mb30"></div>
  <div class="clearfix mb30"></div>
 <div class="col-sm-12">

 	 <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="table2">
  <thead>
    
<tr>
<th class="text-center">#</td>
<th>User Id</td>
<th>Transition Id</td>  
<th>Date</td>
<th>Time</td>
<th>Payment Method</td>
<th>Credit</td>
<th>Image</td>
<th>Requested Action</td>

</tr>
  </thead>
  <tbody>
  	<?php $x=1; foreach ($deposite as $row) { ?>
   <tr>
   	<td><?php echo $x++; ?></td>
   	<td><?php echo $row->member_id ?></td>
   	<td><?php echo $row->transition_id ?></td>
   	<td><?php echo $row->created ?></td>
   	<td><?php echo $row->time ?></td>
   	<td><?php echo $row->payment_method ?></td>
   	<td><?php echo $row->credit ?></td>
   	<td> <img src="<?php echo base_url() ?>uploads/<?php echo $row->image ?>" style="width: 50px;height: 50px;">  </td>
   	<td>
   	
   	
   	 <?php if ($row->requested_action==0) { ?>
      <div style="color:red;">Pending</div>
     <?php } ?> 

     <?php if ($row->requested_action==1) { ?>
      <div style="color:green;">Approved</div>
     <?php } ?> 

     <?php if ($row->requested_action==2) { ?>
      <div style="color:red;">Disapproved</div>
     <?php } ?> 
   	
   	
   	
   	
   	
   	 </td>
   </tr>
  		
  <?php	} ?>
  </tbody>

</table> 
          </div><!-- table-responsive -->
 	
         </div>
        </div>  
     </div>
    </div>
  </div>
  </section>

</body>
</html>