<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function admin_login($username,$password)
	{
	  
	  $sql="Select * from admin_login where username='$username' and password='$password'  ";
	  $res=$this->db->query($sql);

	  return $res->row_array();
	}
	public function member_model()
	{
		$sql="Select * from member ";
        $res=$this->db->query($sql);

        return $res->result_array();
	}
	public function make_vip_model($member_id)
	{
		$data=array('user_level'=>1);
		$this->db->set('user_level','user_level',false);
		$this->db->where('id',$member_id);
		$this->db->update('member',$data);
		return;
	}
	public function make_free_model($member_id)
	{
		$data=array('user_level'=>0);
		$this->db->set('user_level','user_level',false);
		$this->db->where('id',$member_id);
		$this->db->update('member',$data);
		return;
	}



	public function deposit_request_model()
	{
		 $this->db->select('deposit_request.*,account_table.*,member.tell_number');
  
  
 		$this->db->from('deposit_request');
         $this->db->join('account_table', 'account_table.acc_id = deposit_request.bank_ac_id');  
         $this->db->join('member', 'member.id = deposit_request.member_id');  

 		// $this->db->where('plan_investmest_td.user_id',$userid);
 
      $query = $this->db->get();
       // return $query->result();  
		// $sql="Select * from deposit_request ";
        // $res=$this->db->query($sql);

        return $query->result_array();
	}
	public function deposit_approved_model($withdraw_id)
	{
		$data=array('requested_action'=>1);
		$this->db->set('requested_action','requested_action',false);
		$this->db->where('id',$withdraw_id);
		$this->db->update('deposit_request',$data);
		return;
	}
	public function deposit_disapproved_model($withdraw_id)
	{
		$data=array('requested_action'=>2);
		$this->db->set('requested_action','requested_action',false);
		$this->db->where('id',$withdraw_id);
		$this->db->update('deposit_request',$data);
		return;
	}
	
	public function withdraw_limit_model()
	{
		$sql="Select * from withdraw";
        $res=$this->db->query($sql);

        return $res->result();
	}
	public function withdraw_limit_change_model($value)
	{
		 $data = array('withdraw_limit' =>$value);
    	return $this->db->insert('withdraw',$data);

	}
	public function add_credit_model($id,$credit)
	{
		 $data = array('id' =>$id,'credit'  =>$credit);
    	$this->db->set('credit','credit',false);
		$this->db->where('id',$id);
		$this->db->update('member',$data);

		
	}
	public function member_credit_model($id)
	{
		$sql="Select credit from member where id = $id";
        $res=$this->db->query($sql);

        return $res->row_array();
	}

    public function withdraw_limit_by_id($id){
        $q = $this->db->query("select * from withdraw  where id ='".$id."' limit 0,1");
        return $q->row();
    }
    
    
    
    public function withdraw_request_by_user_model()
	{



 $this->db->select('withdrwal_request.*,member.*');
  
  
 $this->db->from('withdrwal_request');
         $this->db->join('member', 'member.id = withdrwal_request.user_id');  
     
 
      $query = $this->db->get();
       return $query->result();  

		
		
	}


	

	public function update_status_model($user_id,$withdrwal_id)
{
  $data=array(
                              
            'w_status '=>1          
                      
                    
    );
  $this->db->where('withdrwal_request_id',$withdrwal_id);  
 
    return $this->db->update('withdrwal_request', $data);
}

public function update_bid_match_model($match_id)
{
  	$data=array(                              
        'match_status'=>0                    
    );
  	$this->db->where('match_id', $match_id);
    return $this->db->update('match_table', $data);
}

public function update_start_bid_match_model($match_id)
{
  $data=array(
                              
            'match_status'=>1                    
    );
  $this->db->where('match_id',$match_id);  
 
    return $this->db->update('match_table', $data);
}

public function get_balance_model($user_id)
    {
      $sql="Select * from member  where  id = '$user_id' ";
      $result=$this->db->query($sql);
      return $result->row_array();
    }

    public function add_balance_by_user_model($user_id,$total_amt)
{
 $data=array(
            'balance'=>$total_amt            
    );
 $this->db->where('id',$user_id);
    return $this->db->update('member', $data);
}

 public function add_balance_by_betting_id_model($betting_id)
{
 $data=array(
            'pay_status'=>1            
    );
 $this->db->where('betting_id',$betting_id);
    return $this->db->update('betting_table', $data);
}


}