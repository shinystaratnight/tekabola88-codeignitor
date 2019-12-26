 <?php $this->load->view('user/user_sidebar') ?>

 
    <div class="pageheader">
      <h2><i class="fa fa-gamepad"></i> Match Bid</h2>
    </div>

  <div class="contentpanel">
   <div class="panel panel-default">

        <div class="panel-body">
    
     <div class="clearfix mb30"></div>
     
        
        
        <h2>Team A</h2>
        <div class="col-sm-4">
          <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="">
  <thead>
    
<tr>
<th class="text-center">#</td>
<th>Score</td>
<th>Rate</td> 
<th>Action</td>
</tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($allteamrateA as $row ) { ?>
    <tr>
      <td><?php echo $i++; ?></td>   
    <td>
      <?php if($row ->score_a==5) {?>
                                                        5up
                                                <?php } else
                                                {
                                                    if($row ->score_a==6){?>
                                                      Win
                                                    <?php }else{ ?>
                                                    <?php echo $row ->score_a; ?> - <?php echo $row ->score_b; ?>       <?php } }?>  
    </td>   
    <td><?php echo $row->rate_per_goal ?></td>    
    <td><a href="<?php echo base_url() ?>user/bid_now/<?php echo $row->team_goal_rate_id ?>">Bid Now</a></td>
  </tr>
  <?php } ?>
  </tbody>

</table> 

          </div><!-- table-responsive -->
          </div><!-- table-responsive -->
      
   
        <h2>Draw</h2>
        <div class="col-sm-4">
          <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="">
  <thead>
    
<tr>
<th class="text-center">#</td>
<th>Score</td>
<th>Rate</td> 
<th>Action</td>
</tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($allteamrateD as $row ) { ?>
    <tr>
      <td><?php echo $i++; ?></td>   
    <td><?php echo $row->rate_score ?></td>   
    <td><?php echo $row->rate_per_goal ?></td>    
    <td><a href="<?php echo base_url() ?>user/bid_now/<?php echo $row->team_goal_rate_id ?>">Bid Now</a></td>
  </tr>
  <?php } ?>
  </tbody>

</table> 

          </div><!-- table-responsive -->
          </div><!-- table-responsive -->
      


        <h2>Team B</h2>
        <div class="col-sm-4">
          <div class="table-responsive">
        
<table class="table table-bordered table-striped table-hover" id="">
  <thead>
    
<tr>
<th class="text-center">#</td>
<th>Score</td>
<th>Rate</td> 
<th>Action</td>
</tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($allteamrateB as $row ) { ?>
    <tr>
      <td><?php echo $i++; ?></td>   
    <td> <?php if($row ->score_a==5) {?>
                                                        5up
                                                <?php } else
                                                {
                                                    if($row ->score_b==6){?>
                                                      Win
                                                    <?php }else{ ?>
                                                    <?php echo $row ->score_a; ?> - <?php echo $row ->score_b; ?>       <?php } }?>  </td>   
    <td><?php echo $row->rate_per_goal ?></td>    
    <td><a href="<?php echo base_url() ?>user/bid_now/<?php echo $row->team_goal_rate_id ?>">Bid Now</a></td>
  </tr>
  <?php } ?>
  </tbody>

</table> 

          </div><!-- table-responsive -->
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