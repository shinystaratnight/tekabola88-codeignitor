
 <?php $this->load->view('user/user_sidebar') ?>

 
    <div class="pageheader">
      <h2><i class="fa fa-gamepad"></i>Withdrwal Request</h2>
    </div>

  <div class="contentpanel">
   <div class="panel panel-default">

        <div class="panel-body">
    
     <div class="clearfix mb30"></div>

		<?php  if(isset($error)){ echo $error; }
		echo $this->session->flashdata('success_req'); ?>
          <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="table2">
  <thead>
    
<tr>
<th class="text-center">S. No</td>
<th>Withdrwal Amount</td>
<th>Bank Name</td>
<th>Acconut No</td>
<th>Action</td>

</tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($limit as $value ) { 


if ($value->withdraw_limit < $userwallet->balance) { ?>
    <tr>
      <td><?php echo $i++; ?></td>

      <td><?php  echo $value->withdraw_limit?></td>
<form action="<?php echo base_url() ?>user/w_request" method="post">
      <td><input type="text" name="bank_name"></td>
      <td><input type="text" name="ac_no"></td>
     
	<input type="hidden"name="withdrwa_amount" value="<?php  echo $value->withdraw_limit?>">
      <td><input type="submit" value="Request" class="btn btn-success"></td>
     </form>

  </tr>
  <?php } } ?>
  </tbody>

        </table> 
          </div><!-- table-responsive -->
       </div>
  <div class="clearfix mb30"></div>
  <div class="clearfix mb30"></div>
<div class="col-sm-12">

   <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="table2">
  <thead>
    
<tr>
<th class="text-center">S No.</td>
<th class="text-center">Amount</td>  
<th class="text-center">Bank </td>  
<th class="text-center">Acconut</td>  
<th class="text-center">Withdrwal Date</td>
<th class="text-center">Status</td>


</tr>
  </thead>
  <tbody>
    <?php $x=1; foreach ($Withdrwal as $row) { ?>
   <tr>
    <td class="text-center"><?php echo $x++; ?></td>
    <td class="text-center"><?php echo $row->amount ?></td>
    <td class="text-center"><?php echo $row->bank_ac_name ?></td>
    <td class="text-center"><?php echo $row->bank_ac_details ?></td>
    <td class="text-center"><?php echo $row->w_date ?></td>
   <td class="text-center"><?php if ($row->w_status==0) { ?><div style="color:red;">Pending.</div> <?php } else{ ?> <div style="color:green;">Approved.</div><?php  } ?> </td>
   </tr>
      
  <?php } ?>
  </tbody>

</table> 
          </div>

</div>

</div>


      </div>      
    </div><!-- contentpanel -->
  </div><!-- mainpanel --> 
</section>
<script>
  jQuery(document).ready(function() {
    
    "use strict";
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Select2
    jQuery('select').select2({
        minimumResultsForSearch: -1
    });
    
    jQuery('select').removeClass('form-control');
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
  
  
  });
</script>

  
</body>
</html>