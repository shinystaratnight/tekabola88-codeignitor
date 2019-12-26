
 <?php $this->load->view('user/user_sidebar') ?>

 
    <div class="pageheader">
      <h2><i class="fa fa-gamepad"></i>Result </h2>
    </div>
<?php  echo $this->session->flashdata('success_req'); ?>
  <div class="contentpanel">
   <div class="panel panel-default">

        <div class="panel-body">
    
     <div class="clearfix mb30"></div>
     
        
        
        
        
          <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="table2">
  <thead>
    
<tr>
<th class="text-center">#</td>

<th>Team Name</td>
<th>Betting Team Score</td>
<th>Match Team Score</td>
<th>Match Date</td>
<th>Betting Credit</td>
<!-- <th>Your Balance</td>   -->
<th>Status</td>
</tr>
  </thead>
  <tbody>
    <?php $x=1; foreach ($result as $row) { ?>
    <tr>
      <td><?php echo $x++; ?></td>
      <td><?php echo $row->team1 ?> Vs. <?php echo $row->team2 ?></td>
      <td><?php echo $row->team1_score ?> - <?php echo $row->team2_score ?></td>
      <td><?php echo $row->team_a_winning_score ?> - <?php echo $row->team_b_winning_score ?></td>
      <td><?php echo $row->match_date ?></td>
      <td><?php echo $row->betting_credit ?></td>
      <!-- <td><?php echo $row->credit ?></td> -->
      <td><?php if ( ($row->team1_score==$row->team_a_winning_score) && ($row->team2_score==$row->team_b_winning_score) ) {  ?><div style="color:green;">Win</div> <?php } else{ ?> <div style="color:red;">Loss</div><?php  } ?></td>
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