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
  $userid= $this->session->userdata('userid');
  $data['pic']=$this->User_model->get_profilepicture_model($userid); 
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
      $userid= $this->session->userdata('userid');
      $data['pic']=$this->User_model->get_profilepicture_model($userid); 
      $data['teamscore']=$this->User_model->get_teamscore_model($match_id); 
        $this->load->view('user/team_score',$data);
    }

    public function bid_now($team_goal_rate_id)
    {
      $this->load->model('User_model');
      $userid= $this->session->userdata('userid');
       $id= $this->session->userdata('id');

       $amount=$this->input->post('amount');
      $data['pic']=$this->User_model->get_profilepicture_model($userid); 
      $data['bid']=$this->User_model->get_bidnow_score_model($team_goal_rate_id); 
      if (!$amount=='') {
      foreach ($data['bid'] as $row) {       
         $team_a=$row->team_a;
         $team_b=$row->team_b;
         $team_a_goal=$row->team_a_goal;
         $team_b_goal=$row->team_b_goal;
         $match_id=$row->match_id;
         $match_date=$row->match_date;
        //       
        $this->User_model->insert_betting_score_model($id,$team_a,$team_b,$team_a_goal,$team_b_goal,$match_id,$match_date,$amount);  
         $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
      <i class="fa fa-check"></i>
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Success!</strong> Your Bid Place Successfully....
  </div>');       
        $this->load->view('user/bid_now',$data);
        
      }
    }
        // $this->load->view('bid_now',$data);
      else{
         $data['pic']=$this->User_model->get_profilepicture_model($userid); 
      $data['bid']=$this->User_model->get_bidnow_score_model($team_goal_rate_id); 
        $this->load->view('user/bid_now',$data);
      }
            
    }
     
}
