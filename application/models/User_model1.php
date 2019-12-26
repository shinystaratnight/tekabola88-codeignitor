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
		 $currentdate=date('d/m/Y');
		 $this->db->where('match_date',$currentdate);
		$query = $this->db->get('match_table');
		return $query->result(); 
	}
	public function get_teamscore_model($match_id)
	{
		$this->db->where('match_table.match_id',$match_id);
		$this->db->select('match_table.*,team_goal_rate.*');
		$this->db->from('match_table');
		$this->db->join('team_goal_rate', 'team_goal_rate.match_id=match_table.match_id');
		$query = $this->db->get();
		return $query->result(); 
	}

	public function get_bidnow_score_model($team_goal_rate_id)
	{
		$this->db->where('team_goal_rate.team_goal_rate_id',$team_goal_rate_id);
		$this->db->select('match_table.*,team_goal_rate.*');
		$this->db->from('match_table');
		$this->db->join('team_goal_rate', 'team_goal_rate.match_id=match_table.match_id');
		$query = $this->db->get();
		return $query->result();
	}
	public function insert_betting_score_model($id,$team_a,$team_b,$team_a_goal,$team_b_goal,$match_id,$match_date,$amount)
	{
		        $data = array(
          'member_id' =>$id,
          'team1' =>$team_a,
          'team2' =>$team_b,
          'team1_score' =>$team_a_goal,
          'team2_score' =>$team_b_goal,
          'match_id' =>$match_id,
          'match_date' =>$match_date,
          'betting_credit' =>$amount
           );
		return $this->db->insert('betting_table',$data);
	}
}