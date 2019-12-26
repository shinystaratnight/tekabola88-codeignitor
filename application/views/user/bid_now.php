    <?php $this->load->view('user/user_sidebar') ?>

    <div class="pageheader">
        <h2><i class="fa fa-gamepad"></i> Match Bid</h2>
    </div>
    <?php echo $this->session->flashdata('error'); ?>
    <?php echo $this->session->flashdata('success_req'); ?>
        <div class="contentpanel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="clearfix mb30"></div>
                    <div class="col-sm-5">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</td>
                                        <th>Score</td>
                                        <th>Rate</td>
                                        <th>Your Amount</td>
                                        <th>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($bid as $row ) {  ?>
                                        <tr>
                                            <td>
                                                <?php echo $i++; ?>
                                            </td>
                                            <td>
                                                <?php if($row ->score_a==5) {?>
                                                    5up
                                                    <?php } else
                                                {
                                                    if($row ->score_a==6 || $row ->score_b==6 ){?>
                                                        Win
                                                        <?php }else{ ?>
                                                            <?php echo $row ->score_a; ?> -
                                                                <?php echo $row ->score_b; ?>
                                                                    <?php } }?>
                                            </td>
                                            <td>
                                                <?php echo $row->rate_per_goal ?>
                                            </td>
                                            <form action="<?php echo base_url() ?>user/bid_now/<?php echo $row->team_goal_rate_id; ?>" method="post">
                                                <td>
                                                    <input type="hidden" value="<?php echo $row->rate_per_goal ?>" name="rate_per_match">
                                                    <input type="number" name="amount" placeholder="Amount" min="5" required="" class="form-control">
                                                    <input type="hidden" name="team_a" class="form-control" value="<?php echo $row->team_name?>">
                                                    <input type="hidden" name="team_b" class="form-control" value="<?php echo $row->team_b ?>">
                                                    <input type="hidden" name="match_id" class="form-control" value="<?php echo $row->match_id ?>">
                                                    <input type="hidden" name="match_date" class="form-control" value="<?php echo $row->match_date ?>">
                                                    <input type="hidden" name="score_a" class="form-control" value="<?php echo $row->score_a ?>">
                                                    <input type="hidden" name="score_b" class="form-control" value="<?php echo $row->score_b ?>">
                                                </td>
                                                <td>
                                                    <input type="submit" name="submit" value="Bid Now" class="btn btn-success">
                                                </td>
                                            </form>
                                        </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </section>
    </body>
</html>