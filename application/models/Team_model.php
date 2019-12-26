<?php
class Team_model extends CI_Model{

     public function get_allteam()
    {
        $q = $this->db->query("SELECT * from `team`" );
        return $q->result();
    }
    
    public function get_allmatch()
    {
        $q = $this->db->query("SELECT * from `match_table` where match_end=0" );
        return $q->result();
    }

    public function add_team()
    {
    
    $addteam = array(
    "team_name"=>$this->input->post("team"),
    "team_short_name"=>$this->input->post("team_short_name")
    );

        if($_FILES["team_image"]["size"] > 0)
        {
            $config['upload_path']          = './uploads/team/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('team_image'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();
                $addteam["team_image"]=$img_data['file_name'];
            }

        }

    $this->db->insert("team",$addteam); 

    } 

     public function edit_team()
    {
      
        $editcat = array(
            "team_name"=>$this->input->post("team"),
            "team_short_name"=>$this->input->post("team_short_name")
            );
        if($_FILES["team_image"]["size"] >= 0){
                        $config['upload_path']          = './uploads/team/';
                        $config['allowed_types']        = 'gif|jpg|png|jpeg';
                        $this->load->library('upload', $config);
        
                        if ( ! $this->upload->do_upload('team_image'))
                        {
                                $error = array('error' => $this->upload->display_errors());
                        }
                        else
                        {
                            $img_data = $this->upload->data();
                            $editcat["team_image"]=$img_data['file_name'];
                        }
                            
                $this->db->update("team",$editcat,array("team_id"=>$this->input->post("team_id"))); 
    }
    }

    public function get_team_by_id($id){
        $q = $this->db->query("select * from `team`  where team_id ='".$id."' limit 0,1");
        return $q->row();
    }  
     
    public function get_team_by_id1($id1,$id2){
        $q = $this->db->query("select * from `team`  where team_id ='".$id1."' or team_id = '".$id2."'");

        return $q->result();
    }  

    public function add_match($team1_name,$team1_image,$team2_name,$team2_image,$team1_short_name,$team2_short_name)
    {
    
    $addcat = array(
    "team_a_id"=>$this->input->post("team1"),
    "team_b_id"=>$this->input->post("team2"),
    "match_date"=>$this->input->post("match_date"),
    "match_start_time"=>$this->input->post("match_start_time"),
    "match_stop_time"=>$this->input->post("match_stop_time"),
    "team_a"=>$team1_name,
    "team_a_shortname"=>$team1_short_name,
    "team_a_img"=>$team1_image,
    "team_b"=>$team2_name,
    "team_b_shortname"=>$team2_short_name,
    "team_b_img"=>$team2_image

    );

        // if($_FILES["teamimg"]["size"] > 0)
        // {
        //     $config['upload_path']          = './uploads/team/';
        //     $config['allowed_types']        = 'gif|jpg|png|jpeg';
        //     $this->load->library('upload', $config);

        //     if ( ! $this->upload->do_upload('teamimg'))
        //     {
        //         $error = array('error' => $this->upload->display_errors());
        //     }
        //     else
        //     {
        //         $img_data = $this->upload->data();
        //         $addcat["teamimg"]=$img_data['file_name'];
        //     }

        // }

    $this->db->insert("match_table",$addcat); 

    }



    
    public function edit_match($team1_name,$team2_name)
    {
      
        $addcat = array(
            "match_id"=>$this->input->post("match_id"),
            "team_a_id"=>$this->input->post("team1"),
            "team_b_id"=>$this->input->post("team2"),
            "match_date"=>$this->input->post("match_date"),
            "match_start_time"=>$this->input->post("match_start_time"),
            "match_stop_time"=>$this->input->post("match_stop_time"),
            "match_status"=>0,
            "team_a"=>$team1_name,
            "team_b"=>$team2_name,
            );
        
                $this->db->update("match_table",$addcat,array("match_id"=>$this->input->post("match_id"))); 
    }



         
    public function get_match_by_id($id){
        $q = $this->db->query("select * from `match_table` where match_id ='".$id."' limit 0,1");
        return $q->row();
    }


      
    public function get_allteam_withrate()
    {
        $q = $this->db->query("SELECT team_goal_rate.*,match_table.* FROM team_goal_rate JOIN match_table ON `team_goal_rate`.match_id = `match_table`.match_id" );
        return $q->result();
    }

    public function add_team_score_rate($rate_score,$team_name)
    {
    
    $rate = array(
    "match_id"=>$this->input->post("match_id"),
    "team_id"=>$this->input->post("team_id"),
    "team_code"=>$this->input->post("team_code"),
    "score_a"=>$this->input->post("team_a_goal"),
    "score_b"=>$this->input->post("team_b_goal"),
    "rate_per_goal"=>$this->input->post("matechrate"),
    "team_name"=>$team_name,
    "rate_score"=>$rate_score,
    // "team_image"=>$team_image,
    );

       
    $this->db->insert("team_goal_rate_new",$rate); 

    }


    
         
    public function team_goal_rate_by_id($id){
        $q = $this->db->query("select * from team_goal_rate  where team_goal_rate_id ='".$id."' limit 0,1");
        return $q->row();
    }

    public function betting_member_details_model()
    {
        $sql = "select betting_table.*, member.tell_number from betting_table join member on member.id=betting_table.member_id";
        // $sql="SELECT `betting_table`.*, `member`.`username`, `team_goal_rate`.*
        //         FROM betting_table
        //         JOIN `member` ON `betting_table`.`member_id`=`member`.`id`
        //         JOIN `team_goal_rate` ON `betting_table`.`team1_score`=`team_goal_rate`.`team_a_goal` && `betting_table`.`team2_score`=`team_goal_rate`.`team_b_goal`";
        $res=$this->db->query($sql);

        return $res->result_array();
    }

    public function add_result_score($team_a,$team_b,$match_date)
    {
    
    $results = array(
    "match_id"=>$this->input->post("match_id"),
    "team_a"=>$team_a,
    "team_b"=>$team_b,
    "match_date"=>$match_date,
    "team_a_winning_score"=>$this->input->post("team_a_score"),
    "team_b_winning_score"=>$this->input->post("team_b_score")
    );

       
    $this->db->insert("match_results",$results); 

    }
     public function get_allmatch_withresults()
    {
        $q = $this->db->query("SELECT match_results.*,match_table.* FROM match_results JOIN match_table ON `match_results`.match_id = `match_table`.match_id"  );
        return $q->result();
    }
    public function result_match_id($id){
        $q = $this->db->query("select * from match_results where match_id ='".$id."' limit 0,1");
        return $q->row();
    }
    public function update_member_status($id,$team_a_score,$team_b_score)
    {

        $data=array('status'=>1);
        $condition =array('match_id'=>$id ,'team1_score'=>$team_a_score,'team2_score'=>$team_b_score);
        $this->db->set('status','status',false);
        $this->db->where($condition);
        $this->db->update('betting_table',$data);
        return;
    }
    
     public function update_member_status2($id)
    {

        $data=array('status'=>2);
        $condition =array('match_id'=>$id ,'status' => 0);
        $this->db->set('status','status',false);
        $this->db->where($condition);
        $this->db->update('betting_table',$data);
        return;
    }
    
    
    
     public function get_match_team($id){
        $q = $this->db->query("select * from `match_table` where match_id ='".$id."' limit 0,1");
        return $q->result();
    }
        
    public function get_matchteam_a_withrate($match_id)
    {
        $q = $this->db->query("SELECT * FROM team_goal_rate_new where team_code = 'A' and match_id = '$match_id'" );
        return $q->result();
    }
    public function get_matchteam_b_withrate($match_id)
    {
        $q = $this->db->query("SELECT * FROM team_goal_rate_new where team_code = 'B' and match_id = '$match_id'" );
        return $q->result();
    }
    public function get_matchteam_d_withrate($match_id)
    {
        $q = $this->db->query("SELECT * FROM team_goal_rate_new where team_code = 'D' and match_id = '$match_id'" );
        return $q->result();
    }
     public function add_account()
    {
      
        $editcat = array(
            "payment_method"=>$this->input->post("payment_method"),
            "account_details"=>$this->input->post("account_details")
            );
           
                $this->db->insert("account_table",$editcat);  
    
    }
	public function update_result_status($id)
    {

        $data=array('match_winners'=>1);
        $condition =array('match_id'=>$id);
        $this->db->set('match_winners','match_winners',false);
        $this->db->where($condition);
        $this->db->update('match_results',$data);
        return;
    }
    public function select_member_status($match_id,$team_a_score,$team_b_score)
    {
           $q = $this->db->query("SELECT * FROM betting_table where match_id = '$match_id' and team1_score = '$team_a_score' and team2_score = '$team_b_score' and status = 1 " );
        return $q->result();
    }
    
    
    
    

         
    public function get_account_by_id($id){
        $q = $this->db->query("select * from `account_table` where acc_id ='".$id."' limit 0,1");
        return $q->row();
    }




 public function edit_account()
    {
      
        $editcat = array(
            "payment_method"=>$this->input->post("payment_method"),
            "account_details"=>$this->input->post("account_details")
            );
           
                $this->db->update("account_table",$editcat,array("acc_id"=>$this->input->post("acc_id"))); 
    
    }






   public function get_match_id($team_goal_rate_id)
    {
      
      $sql="Select * from team_goal_rate_new where team_goal_rate_id='$team_goal_rate_id'";
      $res=$this->db->query($sql);

      return $res->row_array();
    }
    
    
    
          public function select_member_balance($match_id)
    {
        $sql="Select * from betting_table where match_id = '$match_id'  and status = 1";
        $res=$this->db->query($sql);

        return $res->result_array();
        
    }
    
    
       public function select_memberold_balance($member_id)
    {
        $sql="Select balance from member where id = '$member_id'";
        $res=$this->db->query($sql);

        return $res->row_array();
        
    }

     public function add_member_balance($member_id,$balance_new)
    {
         $data = array('balance'  =>$balance_new);
        $this->db->set('balance','balance',false);
        $this->db->where('id',$member_id);
        $this->db->update('member',$data);

        return;
    }


}
