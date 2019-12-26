<?php
class Api_model extends CI_Model{
  
    function data_update($table,$set_array,$condition){
        $this->db->update($table,$set_array,$condition);
        return $this->db->affected_rows();
    }


    function get_gateway(){
        
        $q = $this->db->query("Select * from account_table");
            return $q->result();
      }

      function get_correct_score_rate_model(){
        
        $q = $this->db->query("Select * from team_goal_rate,team where team.team_id=team_goal_rate.team_id ");
            return $q->result();
      }
      
       function get_match_model(){
      $m_date= date('m/d/Y');
       
        $q = $this->db->query("Select * from match_table where match_date ='$m_date' ");
            return $q->result();
      }
      public function get_result_by_user_model($match_id)
    {
      $sql="Select * from match_results  where  match_id = '$match_id' ";
      $result=$this->db->query($sql);
      return $result->row_array();
    }
    
       public function get_balance_model($member_id)
    {
      $sql="Select * from member  where  id = '$member_id' ";
      $result=$this->db->query($sql);
      return $result->row_array();
    }
    
     public function update_balance_model($member_id,$total_amt)
{
 $data=array(
            'credit'=>$total_amt            
    );
 $this->db->where('id',$member_id);
    return $this->db->update('member', $data);
}

public function update_balance_model2($member_id,$total_amt)
{
 $data=array(
            'balance'=>$total_amt           
    );
 $this->db->where('id',$member_id);
    return $this->db->update('member', $data);
}

public function update_credit_model($member_id,$totalam)
{
 $data=array(
            'credit'=>$totalam           
    );
 $this->db->where('id',$member_id);
    return $this->db->update('member', $data);
}

}
?>