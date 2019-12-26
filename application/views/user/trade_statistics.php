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
<th>Score</td>
<th>Rate</td>
<th>Bet Amount</td>
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
    <td><?php if($row->team1_score ==5 || $row->team2_score ==5) {?>
        5up
      <?php }else if($row->team1_score ==6 || $row->team2_score ==6){ ?>
        Win
      <?php }else{?>
      <?php echo $row->team1_score ?> - <?php echo $row->team2_score ?>
      <?php }?>
</td>
    <td><?php echo $row->goal_per_rate ?></td>
    <td><?php echo $row->win_amount ?></td>
    <td><?php echo $row->betting_credit ?></td>
    <td>
      <?php if ($row->status==0) { ?>
        <div style="color:blue;">Pending...</div>
        <?php if ($row->match_status == 0) { ?>
          <input type="button" name="submit" value="Match Started" class="btn btn-success" >
        <?php } else { ?>
        <div>
          <a href="<?php echo base_url()?>user/del_bid/<?php echo $row->betting_id ?>">
            <input type="submit" name="submit" value="Cancel Bid" class="btn btn-success" >
          </a>
        </div>
      <?php } }  ?>

      <?php if ($row->status==1) { ?>
        <div style="color:green;">Win</div>
      <?php }  ?>

      <?php if ($row->status==2) { ?>
        <div style="color:red;">Loss</div>
      <?php }  ?>


   </td>

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