<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


	public function update_password()
	{
		$arrayName = array('password' => $this->input->post('password') );
		 $this->db->update("member",$arrayName,array("tell_number"=>$this->session->userdata('userid'))); 
	}

	public function get_profilepicture_model($userid){
		$q = $this->db->query("select * from member where tell_number ='".$userid."'");
		return $q->result();
	}
	public function get_statistics_model($id)
	{
		$this->db->where('member_id',$id);
		$this->db->select('match_table.*,betting_table.*');
		$this->db->from('match_table');
		$this->db->join('betting_table', 'betting_table.match_id=match_table.match_id');
		$query = $this->db->get();
		return $query->result();  
	}
	public function get_allteam_model()
	{
		
		$this->db->where('match_end',0);
		$query = $this->db->get('match_table');
		return $query->result(); 
	}
	public function get_teamscore_model($match_id)
	{
		$this->db->where('match_table.match_id',$match_id);
		$this->db->select('match_table.*,team_goal_rate_new.*');
		$this->db->from('match_table');
		$this->db->join('team_goal_rate_new', 'team_goal_rate_new.match_id=match_table.match_id');
		$query = $this->db->get();
		return $query->result(); 
	}

	public function get_bidnow_score_model($team_goal_rate_id)
	{
		$this->db->where('team_goal_rate_new.team_goal_rate_id',$team_goal_rate_id);
		$this->db->select('match_table.*,team_goal_rate_new.*');
		$this->db->from('match_table');
		$this->db->join('team_goal_rate_new', 'team_goal_rate_new.match_id=match_table.match_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_usercredit_model($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('member');
		return $query->result();
	}
	public function insert_betting_score_model($id,$amount,$win_amonut)
	{
	$data = array(
          'member_id' =>$id,
          'team1' =>$this->input->post('team_a'),
          
          'team1_score' =>$this->input->post('score_a'),
          'team2_score' =>$this->input->post('score_b'),
          'match_id' =>$this->input->post('match_id'),
          'match_date' =>$this->input->post('match_date'),
          'betting_credit' =>$win_amonut,
               'win_amount'=>$amount,
          'goal_per_rate'=> $this->input->post('rate_per_match')
           );
	// print_r($data);
		return $this->db->insert('betting_table',$data);
	}
	public function update_usercredit_model($id,$total_credit)
	{
		$data = array('credit' =>$total_credit );
		
		$this->db->where('id',$id);
		return $this->db->update('member',$data);
	}

	public function get_account_model()
	{
		$query = $this->db->get('account_table');
		return $query->result();
	}
	public function insert_deposite_request()
	{	
	

$data = array(
       	'member_id' =>$this->input->post('user_id'), 
       	'bank_ac_id' =>$this->input->post('pay_method'), 
       	'credit' =>$this->input->post('credit'), 
       	'time' =>$this->input->post('time'), 
       	'transition_id' =>$this->input->post('transition_id')
       );
				 if($_FILES["image"]["size"] > 0){
                    $config['upload_path']          = './uploads/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
    
                    if ( ! $this->upload->do_upload('image'))
                    {
                            $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                        $img_data = $this->upload->data();
                        $data["image"]=$img_data['file_name'];
                    }
                    
               }
               
       
       // print_r($data);
       return $this->db->insert('deposit_request',$data);
	}

	public function get_deposite_model($id)
	{

		$this->db->where('member_id',$id);
		$this->db->select('deposit_request.*,account_table.*');
		$this->db->from('deposit_request');
		$this->db->join('account_table', 'account_table.acc_id=deposit_request.bank_ac_id');
		$query = $this->db->get();
		return $query->result();

	}
	public function get_your_wallet_model($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('member');
		return $query->result();
	}
	public function get_result_model($betting_id)
	{
		$this->db->where('betting_id',$betting_id);
		$this->db->select('betting_table.*,match_results.*');
		$this->db->from('betting_table');
		$this->db->join('match_results', 'betting_table.match_id=match_results.match_id');
		$query = $this->db->get();
		return $query->result();

	}








public function get_limit()
	{
		  $q = $this->db->query("Select * from withdraw");
            return $q->result();
	}


	public function update1_usercredit_model($id,$total_credit)
	{
		$data = array('balance' =>$total_credit );
		
		$this->db->where('id',$id);
		return $this->db->update('member',$data);
	}


	public function get1_usercredit_model($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('member');
		return $query->result();
	}


	public function insert_withdrwal_request($id,$amount)
	{
		   $add = array(
					"user_id	"=>$id,
					"bank_ac_name	"=>$this->input->post('bank_name'),
					"bank_ac_details	"=>$this->input->post('ac_no'),
					"amount"=>$amount
			);
            
               $this->db->insert("withdrwal_request",$add); 

	}
	
	
	
	
public function allwithdrwal($id)
	{
		  $q = $this->db->query("Select * from withdrwal_request  where user_id='$id'");
            return $q->result();
	}
	
	
     public function get_balance_model($member_id)
    {
      $sql="Select * from member  where  tell_number = '$member_id' ";
      $result=$this->db->query($sql);
      return $result->row_array();
    }

     public function get_credit_model($betting_id)
    {
      $sql="Select * from betting_table  where  betting_id = '$betting_id' ";
      $result=$this->db->query($sql);
      return $result->row_array();
    }
    
public function update_credit_model($member_id,$totalam)
{
 $data=array(
            'credit'=>$totalam           
    );
 $this->db->where('tell_number',$member_id);
    return $this->db->update('member', $data);
}
    
public function update_balance_model($member_id, $totalam)
{
 $data=array(
            'balance'=>$totalam           
    );
 $this->db->where('tell_number',$member_id);
    return $this->db->update('member', $data);
}

public function allmatches()
	{
		  $q = $this->db->query("Select * from match_table  where match_end=0");
            return $q->result();
	}


}