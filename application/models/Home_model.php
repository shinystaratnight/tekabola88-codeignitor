<?php
class Home_model extends CI_Model{
   

    public function signup_model()
    {
    
    $addmember = array(
    "username"=>$this->input->post("username"),
    "tell_number"=>$this->input->post("phone"),
   
    "password"=>$this->input->post("password1")
    );

   return $this->db->insert("member",$addmember); 

    }

    public function user_login($phone,$password)
	{
	  
	  $sql="Select * from member where tell_number='$phone' and password='$password'  ";
	  $res=$this->db->query($sql);

	  return $res->row_array();
    }
    
    public function contact_model()
    {
    
    $addcontact = array(
    "name"=>$this->input->post("name"),
    "email"=>$this->input->post("email"),
    "phone"=>$this->input->post("phone"),
    "message"=>$this->input->post("msg"),
   
    "subject"=>$this->input->post("subject")
    );

   return $this->db->insert("contact_us",$addcontact); 

    }

}