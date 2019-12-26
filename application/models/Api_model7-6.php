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
    
}
?>