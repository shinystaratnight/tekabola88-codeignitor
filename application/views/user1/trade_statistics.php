
 <?php $this->load->view('user/user_sidebar') ?>

 
    <div class="pageheader">
      <h2><i class="fa fa-gamepad"></i>Match History </h2>
    </div>

  <div class="contentpanel">
   <div class="panel panel-default">

        <div class="panel-body">
    
     <div class="clearfix mb30"></div>
     
        
        
        
        
          <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="table2">
  <thead>
    
<tr>
<th class="text-center">#</td>
<th>Match Name</td>
<th>Date</td>
<th>Time</td>
<th>Credit</td>
<th>Status</td>
</tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($statistics as $row ) { ?>
    <tr>
      <td><?php echo $i++; ?></td>
    <td><?php echo $row->team_a ?> Vs. <?php echo $row->team_b ?></td>
    <td><?php echo $row->match_date ?></td>
    <td><?php echo $row->match_start_time ?></td>
    <td><?php echo $row->betting_credit ?></td>
    <td><?php if ($row->status==0) { ?> <div style="color:red;">Loss</div><?php } else{  ?><div style="color:green;">Winner</div><?php }  ?></td>
  </tr>
  <?php } ?>
  </tbody>

</table> 
          </div><!-- table-responsive -->
      
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