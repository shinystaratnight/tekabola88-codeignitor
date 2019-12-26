<?php $this->load->view('user/user_sidebar') ?>

    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard </h2>
    </div>

    <div class="contentpanel">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-body">    
                        <div class="clearfix mb30"></div>
                        <div class="table-responsive">        
                            <table class="table table-bordered table-striped table-hover" id="table2">
                                <thead>    
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Match Id</th>
                                        <th class="text-center">Team Name</th>  
                                        <th class="text-center">Match Date</th>  
                                    </tr>
                                </thead>  
                                <tbody>
                                    <?php $i=1; foreach ($match as $row ) {  ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>   
                                        <td class="text-center"><?php echo $row->match_id; ?></td>
                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col-md-5">
                                                <div class="row">
                                                    <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$row->team_a_img; ?>" height="25px" width="25px">
                                                </div>
                                                <div class="row">
                                                    <?php echo $row->team_a; ?> 
                                                </div>
                                                </div>
                                                <div class="col-md-2">
                                                <strong> VS</strong>
                                                </div>
                                                <div class="col-md-5">
                                                <div class="row">
                                                    <img src="<?php echo $this->config->item('base_url').'uploads/team/'.$row->team_b_img; ?>" height="25px" width="25px">
                                                </div>
                                                <div class="row">
                                                    <?php echo $row->team_b; ?> 
                                                </div>
                                                </div>
                                            </div>
                                        </td>   
                                        <td class="text-center"><?php echo $row->match_date; ?></td>                                
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