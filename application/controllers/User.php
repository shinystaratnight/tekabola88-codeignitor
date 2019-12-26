<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  public function __construct()
  {
          parent::__construct();
          $this->load->model('User_model');     
        

  }
	public function index()
	{
    if (!$this->session->userdata('userid') ) {
        redirect('home/signin');
    }
    redirect('user/all_team');
    $userid= $this->session->userdata('userid');
    $data['pic']=$this->User_model->get_profilepicture_model($userid); 
    $data['match']=$this->User_model->allmatches(); 

		$this->load->view('user/user_dashboard_view',$data);
	}

	public function update()
	{
    if (!$this->session->userdata('userid') ) {
      redirect('home/signin');
  }
	             
                $this->load->library('form_validation');
                $this->form_validation->set_rules('password', 'password', 'trim|required');
                $this->form_validation->set_rules('repassword', 'Re-password', 'trim|required|matches[password]');
             $data["error"] = "";
                if ($this->form_validation->run() == FALSE)
        		{
        		   if($this->form_validation->error_string()!=""){
        			  $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>';
                   }
        		}
        		else
        		{
                    $this->load->model("user_model");
                    $this->user_model->update_password(); 
                    $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                        <i class="fa fa-check"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Success!</strong> Password Change Successfully....
                                    </div>');
                    redirect('user/update');
               	}
                 $userid= $this->session->userdata('userid');
                 $data['pic']=$this->User_model->get_profilepicture_model($userid); 
		$this->load->view('user/update_profile',$data);
	   	  
       
	}
	
	public function profilepicture()
	{
    
    if (!$this->session->userdata('userid') ) {
      redirect('home/signin');
  }
  $this->form_validation->set_rules('id', 'pasidsword', 'trim|required');

  if ($this->form_validation->run() == false)
  { 
$userid= $this->session->userdata('userid');
$this->load->model('User_model');  
    $data['pic']=$this->User_model->get_profilepicture_model($userid); 
		$this->load->view('user/profilepicture_view',$data);

  }else{
  if($_FILES["bgimg"]["size"] > 0)
			{

				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('bgimg'))
				{
         
          $error = array('error' => $this->upload->display_errors());
          
				}
				else
				{
          
					$img_data = $this->upload->data();
					$addpic["profile_pic"]=$img_data['file_name'];
				}
        $this->db->update("member",$addpic,array("tell_number"=>$this->session->userdata('userid'))); 
      }
      $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
      <i class="fa fa-check"></i>
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Success!</strong> Profile Image Change Successfully....
  </div>');
redirect('user/profilepicture');
    }
     

	
	}

  public function profile()
	{
    if (!$this->session->userdata('userid') ) {
      redirect('home/signin');
  }
  $userid= $this->session->userdata('userid');
  $data['pic']=$this->User_model->get_profilepicture_model($userid); 
		$this->load->view('user/profile_view',$data);
	}

  public function trade_game_view()
  {
    $this->load->model('User_model');
      $userid= $this->session->userdata('userid');
      $data['pic']=$this->User_model->get_profilepicture_model($userid); 
      $this->load->view('user/trade_game',$data);
  }
  public function trade_statistics()
  {
      $this->load->model('User_model');
      $userid= $this->session->userdata('userid');
      $id= $this->session->userdata('id');
      $data['pic']=$this->User_model->get_profilepicture_model($userid); 
      $data['statistics']=$this->User_model->get_statistics_model($id);
      $this->load->view('user/trade_statistics',$data);
  }
   public function all_team()
    {
      $this->load->model('User_model');
      $userid= $this->session->userdata('userid');
      $data['pic']=$this->User_model->get_profilepicture_model($userid); 
      $data['team']=$this->User_model->get_allteam_model(); 
        $this->load->view('user/team',$data);
    }
    public function team_score($match_id)
    {
      $this->load->model('User_model');
      $this->load->model('Team_model');
      $userid= $this->session->userdata('userid');
      $data['pic']=$this->User_model->get_profilepicture_model($userid); 
      $data['teamscore']=$this->User_model->get_teamscore_model($match_id); 
      $data["allteamrateA"] = $this->Team_model->get_matchteam_a_withrate($match_id);
      $data["allteamrateB"] = $this->Team_model->get_matchteam_b_withrate($match_id);
      $data["allteamrateD"] = $this->Team_model->get_matchteam_d_withrate($match_id);
      $this->load->view('user/team_score',$data);
    }

    public function bid_now($team_goal_rate_id)
    {
      $this->load->model('User_model');
      $userid= $this->session->userdata('userid');
      $id= $this->session->userdata('id');
      $data['usercredit']=$this->User_model->get_usercredit_model($id);
      $credit = 0;
      foreach ($data['usercredit'] as $balance) {
        $credit = $balance->credit;                   
      } 
      // echo $credit; die;
      $this->load->library('form_validation');

      $this->form_validation->set_rules('amount', 'Amount', "required|less_than_equal_to[$credit]");
        
      if ($this->form_validation->run() === FALSE )
      {   
        $data['pic']=$this->User_model->get_profilepicture_model($userid); 
        $data['bid']=$this->User_model->get_bidnow_score_model($team_goal_rate_id); 

        if($this->form_validation->error_string()!="") {
          $this->session->set_flashdata("error",'<div class="alert alert-warning alert-dismissible" role="alert"><i class="fa fa-warning"></i><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>Warning!</strong> '.$this->form_validation->error_string().'
          </div>');
          redirect("user/bid_now/$team_goal_rate_id");
        }
        $data["error"] = '';
        $this->load->view('user/bid_now', $data);
      } else {     
              $amount= $this->input->post('amount');

              $rate_per_match= $this->input->post('rate_per_match');

              $win_amonut=$amount*$rate_per_match;
             $data['pic']=$this->User_model->get_profilepicture_model($userid); 
              $data['bid']=$this->User_model->get_bidnow_score_model($team_goal_rate_id);  
              $data['usercredit']=$this->User_model->get_usercredit_model($id); 
              foreach ($data['usercredit'] as $balance) {
                  $credit=$balance->credit;
                  $total_credit=$credit-$amount;
                  $this->User_model->update_usercredit_model($id,$total_credit);
               } 

            $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
            <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Success!</strong>  Your Bid Place Successfully....
            </div>');
            $this->User_model->insert_betting_score_model($id,$amount,$win_amonut);  
            $this->load->view('user/bid_now', $data);
        }
    }

    public function deposite_request()
    {
        $this->load->model('User_model');
        $userid= $this->session->userdata('userid');
          $id= $this->session->userdata('id');   
        $this->load->library('form_validation');

$this->form_validation->set_rules('pay_method', 'Payment method', 'required');
$this->form_validation->set_rules('credit', 'Credit', 'required');        
$this->form_validation->set_rules('time', 'Time', 'required');
$this->form_validation->set_rules('transition_id', 'Transition id', 'required|is_unique[deposit_request.transition_id]');

      

   $data['pic']=$this->User_model->get_profilepicture_model($userid);
  $data['account']=$this->User_model->get_account_model();
  $data['deposite']=$this->User_model->get_deposite_model($id); 
   $data['error']="";
        if ($this->form_validation->run() === FALSE)
        {   



            if($this->form_validation->error_string()!=""){
            $this->session->set_flashdata("success_req",'<div class="alert alert-warning alert-dismissible" role="alert"><i class="fa fa-warning"></i><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Warning!</strong> '.$this->form_validation->error_string().'
            </div>');


        
            }            
           
          
        }
        else
        {   

            $data['pic']=$this->User_model->get_profilepicture_model($userid);
            $data['account']=$this->User_model->get_account_model();  
            $data['deposite']=$this->User_model->get_deposite_model($id);  

            $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
            <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Success!</strong> Your Deposite Request submit successfully...
            </div>');
            
            $this->User_model->insert_deposite_request();  
            redirect('user/deposite_request');
           // $this->load->view('user/deposite_request',$data);
        }
          $this->load->view('user/deposite_request',$data);

    }
     
     
     public function your_wallet()
     {
        $this->load->model('User_model');
        $userid= $this->session->userdata('userid');
          $id= $this->session->userdata('id'); 
           $data['pic']=$this->User_model->get_profilepicture_model($userid);
           $data['wallet']=$this->User_model->get_your_wallet_model($id);
       $this->load->view('user/wallet',$data);
     }

     public function view_result($betting_id)
     {
      $this->load->model('User_model');
        $userid= $this->session->userdata('userid');
          $id= $this->session->userdata('id'); 
           $data['pic']=$this->User_model->get_profilepicture_model($userid);
           $data['result']=$this->User_model->get_result_model($betting_id);
       $this->load->view('user/result',$data);
     }

















public function w_request()
{
  # code...
 $this->load->model("user_model");
        $userid= $this->session->userdata('userid');
          $id= $this->session->userdata('id'); 
           $data['pic']=$this->User_model->get_profilepicture_model($userid);
        $data['limit']  =$this->user_model->get_limit(); 
                $data['Withdrwal']  =$this->user_model->allwithdrwal($id); 

    
     $q = $this->db->query("select * from `member` WHERE id=".$id);
        $data["userwallet"] = $q->row();
   $data["error"]="";


$this->form_validation->set_rules('withdrwa_amount', 'withdrwa_amount', 'trim|required');
$this->form_validation->set_rules('bank_name', 'bank name', 'trim|required');
$this->form_validation->set_rules('ac_no', 'acccount no', 'trim|required');
                if ($this->form_validation->run() == FALSE)
            {
              
               if($this->form_validation->error_string()!=""){
                $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>';
                   }
            }
            else
            {

$amount=$this->input->post('withdrwa_amount');
     
    $data['usercredit']=$this->user_model->get1_usercredit_model($id); 
    foreach ($data['usercredit'] as $balance) {
    $credit=$balance->balance;
    $total_credit=$credit-$amount;
    $this->user_model->update1_usercredit_model($id,$total_credit);                   
    $this->user_model->insert_withdrwal_request($id,$amount);    

    }

 $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                        <i class="fa fa-check"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Success!</strong> Request Successfully....
                                    </div>');
                    redirect('user/w_request');

    } 

         $this->load->view('user/withdrwal_amount',$data);



}


  function del_bid($betting_id){
    if (!$this->session->userdata('userid') ) {
        redirect('home/signin');
    }

    $member_id= $this->session->userdata('userid');       
    $this->load->model("User_model");
    $data1 = $this->User_model->get_balance_model($member_id);
    $data2 = $this->User_model->get_credit_model($betting_id);     
    $uamt = $data1['credit'];   
    $win_amt = $data2['win_amount'];
    $totalam =  $uamt + $win_amt;
    $totalam;
    
    $this->User_model->update_credit_model($member_id,$totalam);
    $q = $this->db->query("Delete from betting_table where betting_id = '".$betting_id."'");      
    redirect('User/trade_statistics'); 
  
  }

  public function transfer() {
    $amount = $this->input->post('amount');
    $member_id= $this->session->userdata('userid');       
    $this->load->model("User_model");
    $data = $this->User_model->get_balance_model($member_id);
         
    $credit = $data['credit'];   
    $balance = $data['balance'];

    $new_credit = $credit + $amount;
    $new_balance = $balance - $amount;
    $this->User_model->update_credit_model($member_id, $new_credit);
    $this->User_model->update_balance_model($member_id, $new_balance);
    $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
            <i class="fa fa-check"></i>
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>Success!</strong> Transfered Successfully....
        </div>');
    redirect('user/your_wallet');
  }
}
