<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
                header('Content-type: text/json');
                date_default_timezone_set('Asia/Karachi');
                $this->load->database();
                $this->load->helper(array('form', 'url'));
                $this->db->query("SET time_zone='+05:30'");
        }

        public function index()
        {
            echo json_encode(array("api"=>"welcome"));
        }

                       
public function signup(){
    $data = array(); 
         $_POST = $_REQUEST;      
             $this->load->library('form_validation');
             /* add registers table validation */
             
                $this->form_validation->set_rules('username', 'user name', 'trim|required|is_unique[member.username]');
               
                $this->form_validation->set_rules('user_mobile', 'Mobile Number', 'trim|required|is_unique[member.tell_number]');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('repassword', 'rePassword', 'trim|required|matches[password]');
             
               
             if ($this->form_validation->run() == FALSE) 
             {
                 $data["responce"] = "false";  
                 $data["error"] = strip_tags($this->form_validation->error_string());
                 
                 
             }else
             {
                  
$this->db->insert("member", array("tell_number"=>$this->input->post("user_mobile"),"username"=>$this->input->post("username"),"password"=>$this->input->post("password")));
                 $user_id =  $this->db->insert_id();  
                 $data["responce"] = "true"; 
                 $data["message"] = "User Register Sucessfully..";
                 
               }                  
        
                  echo json_encode($data);
} 


public function change_password(){
    $data = array(); 
        $this->load->library('form_validation');
        /* add users table validation */
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) 
        {
            $data["responce"] = "false";  
            $data["error"] = strip_tags($this->form_validation->error_string());
            
        }else
        {
           
            $q = $this->db->query("select * from member where id = '".$this->input->post("user_id")."' and  password = '".$this->input->post("current_password")."' limit 1");
            $user = $q->row();
            
            if(!empty($user)){


                $this->load->model("Api_model");
                $this->Api_model->data_update("member", array(
                                    "password"=>$this->input->post("new_password")
                                    ),array("id"=>$this->input->post("user_id")));
          
            $data["responce"] = "true";
            }else{
            $data["responce"] = "false";  
            $data["error"] = 'Current password do not match';
            }
          }                  
   
             echo json_encode($data);
}      

public function login(){
    $data = array(); 
    $_POST = $_REQUEST;      
        $this->load->library('form_validation');
         $this->form_validation->set_rules('user_mobile', 'user mobile',  'trim|required');
         $this->form_validation->set_rules('password', 'Password', 'trim|required');
       
        if ($this->form_validation->run() == FALSE) 
        {
            $data["responce"] = "false";  
            $data["error"] =  strip_tags($this->form_validation->error_string());
            
        }else
        {
           //users.user_email='".$this->input->post('user_email')."' or
            $q = $this->db->query("Select * from `member` where(tell_number='".$this->input->post('user_mobile')."' ) and password='".$this->input->post('password')."' Limit 1");
            
            
            if ($q->num_rows() > 0)
            {
                $row = $q->row(); 
                      $data["responce"] = "true";  
                         $data["data"] = array("user_id"=>$row->id,"tell_number"=>$row->tell_number,"username"=>$row->username,"credit"=>$row->credit,"balance"=>$row->balance,"user_level"=>$row->user_level,"profile_pic"=>$row->profile_pic) ;
                          
            }
            else
            {
                      $data["responce"] = "false";  
                    $data["error"] = 'Invalide Username or Passwords';
            }
           
            
        }
   echo json_encode($data);
    
}



function get_payment_gateway(){
                
    
        $q = $this->db->query("Select * from account_table");
        $data["responce"] = "true";
        $data["data"] = $q->result();

        echo json_encode($data);
}
 
function deposit_request(){
    $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'user id',  'trim|required');
         $this->form_validation->set_rules('credit', 'credit', 'trim|required');
        $this->form_validation->set_rules('transition_id', 'transition_id',  'trim|required|is_unique[deposit_request.transition_id]');
        $this->form_validation->set_rules('bank_ac_id', 'payment method',  'trim|required');
        if ($this->form_validation->run() == FALSE) 
        {
            $data["responce"] = "false";  
            $data["error"] = strip_tags($this->form_validation->error_string());
            
        }else
        {
            $member_id = $this->input->post("user_id");
             $credit = $this->input->post("credit");
            $bank_ac_id = $this->input->post("bank_ac_id");
            $transition_id = $this->input->post("transition_id");
            $time = $this->input->post("time");

            $insert_array = array(
                "member_id" => $member_id,
                "credit" => $credit,
                "bank_ac_id" => $bank_ac_id,
                "time" => $time,
                "transition_id" => $transition_id
               
                );

            if(isset($_FILES["image"]) && $_FILES["image"]["size"] > 0){
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
               
                if ( ! $this->upload->do_upload('image'))
                {
                $data["responce"] = "false";  
                $data["error"] = 'Error! : '.$this->upload->display_errors();
                       
                }
                else
                {
                     $img_data = $this->upload->data();
                     $image_name = $img_data['file_name'];
                     $insert_array["image"]=$image_name;
                }
                
                   } 
                
          
            
            $this->db->insert("deposit_request",$insert_array);
            $insert_id = $this->db->insert_id();
            $data["responce"] = "true";
          
            
        }
        echo json_encode($data);
}




function get_correct_score_rate(){
                
    $this->load->model("Api_model");
    $data  = $this->Api_model->get_correct_score_rate_model();

echo json_encode($data);
}


function withdrawal_request(){
    $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'user id',  'trim|required');
         $this->form_validation->set_rules('credit', 'credit', 'trim|required');
        $this->form_validation->set_rules('bank_name', 'Bank Name',  'trim|required');
        $this->form_validation->set_rules('bank_ac_details', 'Bank Details',  'trim|required');
        if ($this->form_validation->run() == FALSE) 
        {
            $data["responce"] = "false";  
            $data["error"] = strip_tags($this->form_validation->error_string());
            
        }else
        {
            $member_id = $this->input->post("user_id");
             $credit = $this->input->post("credit");
            $bank_name = $this->input->post("bank_name");
            $bank_ac_details = $this->input->post("bank_ac_details");
            
                    
     $this->load->model("Api_model");
      $data1 = $this->Api_model->get_balance_model($member_id);
     
    $uamt= $data1['balance'];

    $total_amt = $uamt -  $credit ; 
     $this->Api_model->update_balance_model2($member_id,$total_amt);

           
            $insert_array = array(
                "user_id" => $member_id,
                "amount" => $credit,
                "bank_ac_name" => $bank_name,
                "bank_ac_details" => $bank_ac_details
             
                );

            $this->db->insert("withdrwal_request",$insert_array);
            $insert_id = $this->db->insert_id();
            $data["responce"] = "true";
          
            
        }
        echo json_encode($data);
}


function get_match(){
                
    
  
       
    $q = $this->db->query("Select * from match_table where match_end=0 ");
        $data["responce"] = "true";
        $data["data"] = $q->result();
 echo json_encode($data);
}


function get_team_rate(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('match_id', 'Match Id',  'trim|required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
        $match_id = $this->input->post("match_id");
        
        $q = $this->db->query("Select * from team_goal_rate_new where match_id = '".$match_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}



function insert_bets(){
    
    $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'user id',  'trim|required');
         $this->form_validation->set_rules('Scorea', 'Scorea', 'trim|required');
          $this->form_validation->set_rules('Scoreb', 'Scoreb', 'trim|required');
        $this->form_validation->set_rules('match_id', 'match id',  'trim|required');
        $this->form_validation->set_rules('team_name', 'team name',  'trim|required');
     
      
        $this->form_validation->set_rules('total_rate', 'total rate',  'trim|required');
       
       
       
        if ($this->form_validation->run() == FALSE) 
        {
            $data["responce"] = "false";  
            $data["error"] = strip_tags($this->form_validation->error_string());
            
        }else
        {
            $member_id = $this->input->post("user_id");
             $Scorea = $this->input->post("Scorea");
            $Scoreb = $this->input->post("Scoreb");
            $match_id = $this->input->post("match_id");
            $team_a = $this->input->post("team_name");
          
            $total_rate = $this->input->post("total_rate");
             $total_amt1 = $this->input->post("total_amt");
             $this->load->model("Api_model");
      $data1 = $this->Api_model->get_balance_model($member_id);
     
     $uamt= $data1['credit'];

  $total_amt = $uamt -  $total_amt1; 
  $total_amt2 = $total_amt1 * $total_rate; 
   $this->Api_model->update_balance_model($member_id,$total_amt);
            
            
             $b_date= date('m/d/Y');
            $insert_array = array(
                "member_id" => $member_id,
                "team1_score" => $Scorea,
                "team2_score" => $Scoreb,
                "match_id" => $match_id,
                "team1" => $team_a,
               "win_amount" => $total_amt1,
                "goal_per_rate" => $total_rate,
               
                "betting_credit" => $total_amt2,
                "match_date" => $b_date
             
                );

            $this->db->insert("betting_table",$insert_array);
            $insert_id = $this->db->insert_id();
            $data["responce"] = "true";
          
            
        }
        echo json_encode($data);
}



function get_result_by_user(){

    $this->load->library('form_validation');
     $this->form_validation->set_rules('goala', 'goal a',  'trim|required');
    $this->form_validation->set_rules('goalb', 'goal b',  'trim|required');
    $this->form_validation->set_rules('match_id', 'Match Id',  'trim|required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
        $match_id = $this->input->post("match_id");
        $goala = $this->input->post("goala");
        $goalb = $this->input->post("goalb");
       $user_id = $this->input->post("user_id");
 
           $this->load->model("Api_model");
    $score  = $this->Api_model->get_result_by_user_model($match_id);
           
    $scorea=$score['team_a_winning_score'];
    $scoreb=$score['team_b_winning_score'];

    if( $scorea == $goala && $scoreb == $goalb){

     
        $q = $this->db->query("Select * from betting_table  where  member_id = '".$user_id."' and match_id='$match_id'  and status='1'");
        $data["responce"] = "Win";
        $data["data"] = $q->result();

    }else{


   $data["responce"] = "Loss";
    }

    }
    echo json_encode($data);
}


  function get_bet_details(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('user_id', 'user Id',  'trim|required');
   
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
    
        $user_id = $this->input->post("user_id");
        
        $q = $this->db->query("Select * from betting_table  where member_id = '".$user_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}

function get_balance(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('user_id', 'user Id',  'trim|required');
    
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
      
        $user_id = $this->input->post("user_id");
        
        $q = $this->db->query("Select * from  member  where id = '".$user_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}

function get_withdraw_request_limit(){

 
  
    $q = $this->db->query("Select * from withdraw ");
        $data["responce"] = "true";
        $data["data"] = $q->result();
 echo json_encode($data);
}

function get_withdraw_request_status(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('user_id', 'user Id',  'trim|required');
    
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
      
        $user_id = $this->input->post("user_id");
        
        $q = $this->db->query("Select * from  withdrwal_request  where user_id = '".$user_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}

function get_teama_rate(){
   $this->load->library('form_validation');
    $this->form_validation->set_rules('match_id', 'Match Id',  'trim|required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
        $match_id = $this->input->post("match_id");
        
        $q = $this->db->query("Select * from team_goal_rate_new where team_code='A' and match_id = '".$match_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}

function get_teamb_rate(){
   $this->load->library('form_validation');
    $this->form_validation->set_rules('match_id', 'Match Id',  'trim|required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
        $match_id = $this->input->post("match_id");
        
        $q = $this->db->query("Select * from team_goal_rate_new where team_code='B' and match_id = '".$match_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}

function get_teamd_rate(){
   $this->load->library('form_validation');
    $this->form_validation->set_rules('match_id', 'Match Id',  'trim|required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
        $match_id = $this->input->post("match_id");
        
        $q = $this->db->query("Select * from team_goal_rate_new where team_code='D' and match_id = '".$match_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}

function get_team_by_match(){
   $this->load->library('form_validation');
    $this->form_validation->set_rules('match_id', 'Match Id',  'trim|required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
        $match_id = $this->input->post("match_id");
        
        $q = $this->db->query("Select * from match_table where  match_id = '".$match_id."'");
        $data["responce"] = "true";
        $data["data"] = $q->result();
    }
    echo json_encode($data);
}


function del_bid_by_match(){
   $this->load->library('form_validation');
    $this->form_validation->set_rules('bid_id', 'Bid Id',  'trim|required');
      $this->form_validation->set_rules('user_id', 'user Id',  'trim|required');
    $this->form_validation->set_rules('win_amt', 'amount',  'trim|required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $data["responce"] = false;  
        $data["error"] = strip_tags($this->form_validation->error_string());
        
    }else
    {
        $bid_id = $this->input->post("bid_id");
        $member_id = $this->input->post("user_id");
        $win_amt = $this->input->post("win_amt");
        
           $this->load->model("Api_model");
    $data1 = $this->Api_model->get_balance_model($member_id);
     
     $uamt= $data1['credit'];
   $totalam=  $uamt +   $win_amt;
    $this->Api_model->update_credit_model($member_id,$totalam);

        $q = $this->db->query("Delete from betting_table where  betting_id = '".$bid_id."'");
        $data["responce"] = "true";
    
    }
    echo json_encode($data);
}

public function privacy()
        {
             $this->load->view('app_privacy');
        }

}