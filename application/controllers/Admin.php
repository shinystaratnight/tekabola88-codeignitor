<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function __construct()
    {
            parent::__construct();
            $this->load->model('Admin_model');
            $this->load->model("Team_model");
        $this->load->model('User_model');


            
    }

	public function index()
	{
		$this->load->view('admin/login_page');
	}

	public function login()
        {

        $username = $this->input->post('uname');
        $password = $this->input->post('upassword');

        $this->load->model('Admin_model');
        $admindata=$this->Admin_model->admin_login($username,$password); 

        if ($admindata) 
        {
        //declaring session
        $this->session->set_userdata(array('admin_username'=>$username));

        redirect('admin/dashboard');
        //$this->load->view('admin/dashboard');
        }
        else{
        $data['error'] = '<p style="color:red">Username or Password is Invalid </p>';
        $this->load->view('admin/login_page', $data);
        }

      $this->session->userdata('admin_username');

        }
function signout(){
        $this->session->sess_destroy();
        redirect("admin");
    }

    public function dashboard()
	{

		if ($this->session->userdata('admin_username')) {
		$this->load->view('admin/dashboard_page');

		 }
		 
       // $this->load->view('admin/login_page'); 
            
	}


    public function member()
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        

        $data = $this->Admin_model->member_model(); 
        $arrayName = array('data' => $data);
        $this->load->view('admin/member',$arrayName);
    
    }

    public function make_vip($value,$member_level)
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        if ($member_level==0) {
            $this->Admin_model->make_vip_model($value,$member_level); 
           redirect('admin/member');
        }
        else{
            $this->Admin_model->make_free_model($value,$member_level); 
           redirect('admin/member');

        }
        
    }
    public function deposit_request()
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        

        $data = $this->Admin_model->deposit_request_model(); 
        $arrayName = array('data' => $data);
        $this->load->view('admin/deposit_request',$arrayName);

       

    }
    public function deposit_approved($value,$withdraw_action)
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        

            if ($withdraw_action==0 || $withdraw_action==2) {
                $this->Admin_model->deposit_approved_model($value,$withdraw_action); 
               redirect('admin/deposit_request');
            }
          

      
    }
    public function deposit_disapproved($value,$withdraw_action)
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        

           
            if ($withdraw_action==0 || $withdraw_action==1) {
                
                $this->Admin_model->deposit_disapproved_model($value,$withdraw_action); 
               redirect('admin/deposit_request');

            }

        
    }
    public function add_credit($id)
    {
        $arrayName = array('id' => $id );
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        
            $this->load->view('admin/add_credit_view',$arrayName);
        
        
    }
    public function add_credit_ctrl()
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        

        $id = $this->input->post('id');
        $credit_new = $this->input->post('credit');
        print_r($credit_new);
        $data = $this->Admin_model->member_credit_model($id); 
        $credit_old =  $data['credit'];
        print_r($credit_old);
        $credit = $credit_old + $credit_new;
        print_r($credit);
        $this->Admin_model->add_credit_model($id,$credit); 
        redirect('admin/deposit_request');


        
    }

  
  
     public function withdraw_limit()
    {
         if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }

        $this->load->library('form_validation');
                    // $this->load->model("Team_model");

        $this->form_validation->set_rules('limit', 'Change limit', 'trim|required');
        // $this->form_validation->set_rules('team2', 'Team B name', 'trim|required');
            // $data["allteam"] = $this->Team_model->get_allteam();
        $data['data'] =$this->Admin_model->withdraw_limit_model(); 
        // $arrayName = array('data' => $data);

       
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
            $limit=$this->input->post('limit');
                    
            $this->Admin_model->withdraw_limit_change_model($limit);

                    $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                        <i class="fa fa-check"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Success!</strong> Your request added successfully...
                                    </div>');
            redirect('admin/withdraw_limit');


                }



         $this->load->view('admin/withdraw_request',$data);
                
        }

        public function deletewithdraw_limit($id)
        {
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
               $data = array();
                // $this->load->model("Team_model");
                $slider  = $this->Admin_model->withdraw_limit_by_id($id);
                if($slider){
         $this->db->query("Delete from withdraw where id = '".$slider->id."'");
   $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Your item deleted successfully...
                </div>');

                redirect("admin/withdraw_limit");
               }
        }



    public function addteam()
    {
         if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }

        $this->load->library('form_validation');
                    $this->load->model("Team_model");

        $this->form_validation->set_rules('team', 'Team name', 'trim|required');
        $this->form_validation->set_rules('team_short_name', 'Team Short Name', 'trim|required');
            $data["allteam"] = $this->Team_model->get_allteam();

       
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
                    $this->load->model("Team_model");
                    $this->Team_model->add_team(); 
                    $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                        <i class="fa fa-check"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Success!</strong> Your request added successfully...
                                    </div>');
                    redirect('admin/addteam');
                }

          $this->load->view('admin/add_team_view',$data);
                
        }
     public function editteam($id)
        {
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
           
                $q = $this->db->query("select * from `team` WHERE team_id=".$id);
                $data["getcat"] = $q->row();
                
                $data["error"] = "";
               
        $this->load->library('form_validation');
        $this->load->model("Team_model");

$this->form_validation->set_rules('team', 'Team name', 'trim|required');
$this->form_validation->set_rules('team_short_name', 'Team Short Name', 'trim|required');

// $this->form_validation->set_rules('team_image', 'Team Image', 'trim|required');
                  
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
                        $this->load->model("Team_model");
                        $this->Team_model->edit_team(); 
                        $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your Team update successfully...
                                        </div>');
                        redirect('admin/addteam');
                    }

              $this->load->view('admin/editteam',$data);
                    
    
        }
 public function deleteteam($id)
        {  
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
             $data = array();
                $this->load->model("Team_model");
                $slider  = $this->Team_model->get_team_by_id($id);
                if($slider){
               echo $this->db->query("Delete from `team` where team_id = '".$slider->team_id."'");
               
              
           
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Your item deleted successfully...
                </div>');

                redirect("admin/addteam");
               }
        }


    public function addmatch()
    {
         if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }

        $this->load->library('form_validation');
                    $this->load->model("Team_model");

        $this->form_validation->set_rules('team1', 'Team A name', 'trim|required');
        $this->form_validation->set_rules('team2', 'Team B name', 'trim|required');
        $this->form_validation->set_rules('match_date', 'Match Date', 'trim|required');
        $this->form_validation->set_rules('match_start_time', 'Match Start Time', 'trim|required');
        $this->form_validation->set_rules('match_stop_time', 'Match Stop Time', 'trim|required');
            $data["allmatch"] = $this->Team_model->get_allmatch();
            $data["allteam"] = $this->Team_model->get_allteam();
       
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
                    $this->load->model("Team_model");
                    if ($team_id1= $this->input->post("team1")) {
                       $team1=  $this->Team_model->get_team_by_id($team_id1); 
                    $team1_name=$team1->team_name;
                    $team1_image=$team1->team_image;
                    $team1_short_name=$team1->team_short_name;
                    }
                    if ($team_id2= $this->input->post("team2")) {
                       $team2=  $this->Team_model->get_team_by_id($team_id2); 
                    $team2_name=$team2->team_name;
                    $team2_image=$team2->team_image;
                    $team2_short_name=$team2->team_short_name;



                    }
                    // $team_id1= $this->input->post("team1");
                    // $team_id2= $this->input->post("team2");


                    $this->Team_model->add_match($team1_name,$team1_image,$team2_name,$team2_image,$team1_short_name,$team2_short_name); 

                    $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                        <i class="fa fa-check"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Success!</strong> Your request added successfully...
                                    </div>');
                    redirect('admin/addmatch');
                }

          $this->load->view('admin/add_match_view',$data);
                
        }

       
        public function editmatch($id)
        {
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
            $data["allteam"] = $this->Team_model->get_allteam();
           
                $q = $this->db->query("select * from `match_table` WHERE match_id=".$id);
                $data["getcat"] = $q->row();
                
                $data["error"] = "";
               
        $this->load->library('form_validation');
        $this->load->model("Team_model");

$this->form_validation->set_rules('team1', 'Team A name', 'trim|required');
$this->form_validation->set_rules('team2', 'Team B name', 'trim|required');
                  
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
                        $this->load->model("Team_model");
                        if ($team_id1= $this->input->post("team1")) {
                       $team1=  $this->Team_model->get_team_by_id($team_id1); 
                    $team1_name=$team1->team_name;
                    }
                    if ($team_id2= $this->input->post("team2")) {
                       $team2=  $this->Team_model->get_team_by_id($team_id2); 
                    $team2_name=$team2->team_name;
                    }
                        $this->Team_model->edit_match($team1_name,$team2_name); 
                        $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your match Updated successfully...
                                        </div>');
                        redirect('admin/addmatch');
                    }

              $this->load->view('admin/editmatch',$data);
                    
    
        }


        public function deletematch($id)
        {  
             if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
             $data = array();
                $this->load->model("Team_model");
                $slider  = $this->Team_model->get_match_by_id($id);
                if($slider){
               echo $this->db->query("Delete from `match_table` where match_id = '".$slider->match_id."'");
               
              
           
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Your item deleted successfully...
                </div>');

                redirect("admin/addmatch");
               }
        }


        public function add_rate($match_id)
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
    
            $this->load->library('form_validation');
            $this->load->model("Team_model");
    
            $this->form_validation->set_rules('team_id', 'Select team', 'trim|required');
            // $this->form_validation->set_rules('team_code', 'Select Match', 'trim|required');
            // $this->form_validation->set_rules('team_a_goal', 'Team A Goal', 'trim|required');
            // $this->form_validation->set_rules('team_b_goal', 'Team B Goal', 'trim|required');
            // $this->form_validation->set_rules('matechrate', 'Rate', 'trim|required');
                   

            $data["allteam"] = $this->Team_model->get_match_team($match_id);
            $data["allteamrateA"] = $this->Team_model->get_matchteam_a_withrate($match_id);
            $data["allteamrateB"] = $this->Team_model->get_matchteam_b_withrate($match_id);
            $data["allteamrateD"] = $this->Team_model->get_matchteam_d_withrate($match_id);
    
            
            if ($this->form_validation->run() == FALSE)
            {
                if($this->form_validation->error_string()!=""){
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>';
                }
                $this->load->view('admin/add_match_rate',$data);
            } else {

                $match_id= $this->input->post("match_id");
                $this->load->model("Team_model");
                $team_id= $this->input->post("team_id");
  

                $team_a_goal60=$this->input->post("team_a_goal60");
                $team_b_goal60=$this->input->post("team_b_goal60");
                $matechrate60=$this->input->post("matechrate60");
                if($team_a_goal60==6 && $team_b_goal60==0 && $matechrate60 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal60.' - '.$team_b_goal60;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal60,"score_b"=>$team_b_goal60,"rate_per_goal"=>$matechrate60,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);             
                }

                $team_a_goal10=$this->input->post("team_a_goal10");
                $team_b_goal10=$this->input->post("team_b_goal10");
                $matechrate10=$this->input->post("matechrate10");
                if($team_a_goal10==1 && $team_b_goal10==0 && $matechrate10 != "") {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal10.' - '.$team_b_goal10;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal10,"score_b"=>$team_b_goal10,"rate_per_goal"=>$matechrate10,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                       
                }

                $team_a_goal20=$this->input->post("team_a_goal20");
                $team_b_goal20=$this->input->post("team_b_goal20");
                $matechrate20=$this->input->post("matechrate20");
                if($team_a_goal20==2 && $team_b_goal20==0 && $matechrate20 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal20.' - '.$team_b_goal20;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal20,"score_b"=>$team_b_goal20,"rate_per_goal"=>$matechrate20,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate); 
                }

                $team_a_goal21=$this->input->post("team_a_goal21");
                $team_b_goal21=$this->input->post("team_b_goal21");
                $matechrate21=$this->input->post("matechrate21");
                if($team_a_goal21==2 && $team_b_goal21==1 && $matechrate21 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal21.' - '.$team_b_goal21;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal21,"score_b"=>$team_b_goal21,"rate_per_goal"=>$matechrate21,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                      
                }

                $team_a_goal30=$this->input->post("team_a_goal30");
                $team_b_goal30=$this->input->post("team_b_goal30");
                $matechrate30=$this->input->post("matechrate30");
                if($team_a_goal30==3 && $team_b_goal30==0 && $matechrate30 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal30.' - '.$team_b_goal30;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal30,"score_b"=>$team_b_goal30,"rate_per_goal"=>$matechrate30,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                     
                }

                $team_a_goal31=$this->input->post("team_a_goal31");
                $team_b_goal31=$this->input->post("team_b_goal31");
                $matechrate31=$this->input->post("matechrate31");
                if($team_a_goal31==3 && $team_b_goal31==1 && $matechrate31 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal31.' - '.$team_b_goal31;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal31,"score_b"=>$team_b_goal31,"rate_per_goal"=>$matechrate31,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                      
                }

                $team_a_goal32=$this->input->post("team_a_goal32");
                $team_b_goal32=$this->input->post("team_b_goal32");
                $matechrate32=$this->input->post("matechrate32");
                if($team_a_goal32==3 && $team_b_goal32==2 && $matechrate32 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal32.' - '.$team_b_goal32;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal32,"score_b"=>$team_b_goal32,"rate_per_goal"=>$matechrate32,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                     
                }

                $team_a_goal40=$this->input->post("team_a_goal40");
                $team_b_goal40=$this->input->post("team_b_goal40");
                $matechrate40=$this->input->post("matechrate40");
                if($team_a_goal40==4 && $team_b_goal40==0 && $matechrate40 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal40.' - '.$team_b_goal40;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal40,"score_b"=>$team_b_goal40,"rate_per_goal"=>$matechrate40,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                     
                }



                $team_a_goal41=$this->input->post("team_a_goal41");
                $team_b_goal41=$this->input->post("team_b_goal41");
                $matechrate41=$this->input->post("matechrate41");
                if($team_a_goal41==4 && $team_b_goal41==1 && $matechrate41 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal41.' - '.$team_b_goal41;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal41,"score_b"=>$team_b_goal41,"rate_per_goal"=>$matechrate41,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                      
                }  

                $team_a_goal42=$this->input->post("team_a_goal42");
                $team_b_goal42=$this->input->post("team_b_goal42");
                $matechrate42=$this->input->post("matechrate42");
                if($team_a_goal42==4 && $team_b_goal42==2 && $matechrate42 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal42.' - '.$team_b_goal42;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal42,"score_b"=>$team_b_goal42,"rate_per_goal"=>$matechrate42,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                        
                }

                $team_a_goal43=$this->input->post("team_a_goal43");
                $team_b_goal43=$this->input->post("team_b_goal43");
                $matechrate43=$this->input->post("matechrate43");
                if($team_a_goal43==4 && $team_b_goal43==3 && $matechrate43 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal43.' - '.$team_b_goal43;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal43,"score_b"=>$team_b_goal43,"rate_per_goal"=>$matechrate43,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                       
                }    


                $team_a_goal50=$this->input->post("team_a_goal50");
                $team_b_goal50=$this->input->post("team_b_goal50");
                $matechrate50=$this->input->post("matechrate50");
                if($team_a_goal50==5 && $team_b_goal50==0 && $matechrate50 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal50.' - '.$team_b_goal50;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'A';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal50,"score_b"=>$team_b_goal50,"rate_per_goal"=>$matechrate50,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                       
                }

                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your request added successfully...
                                        </div>');
                redirect('admin/add_rate/'.$match_id);
                $this->load->view('admin/add_match_rate',$data); 
            }
        }     


        public function add_rate_team_d($match_id)
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
    
            $this->load->library('form_validation');
            $this->load->model("Team_model");
    
            $this->form_validation->set_rules('team_id', 'Select team', 'trim|required');
            // $this->form_validation->set_rules('team_code', 'Select Match', 'trim|required');
            // $this->form_validation->set_rules('team_a_goal', 'Team A Goal', 'trim|required');
            // $this->form_validation->set_rules('team_b_goal', 'Team B Goal', 'trim|required');
            // $this->form_validation->set_rules('matechrate', 'Rate', 'trim|required');
                   

            $data["allteam"] = $this->Team_model->get_match_team($match_id);
            $data["allteamrateA"] = $this->Team_model->get_matchteam_a_withrate($match_id);
            $data["allteamrateB"] = $this->Team_model->get_matchteam_b_withrate($match_id);
            $data["allteamrateD"] = $this->Team_model->get_matchteam_d_withrate($match_id);
    
            
            if ($this->form_validation->run() == FALSE)
            {
                if($this->form_validation->error_string()!=""){
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                    <i class="fa fa-warning"></i>
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                }
                $this->load->view('admin/add_match_rate',$data);
            } else {
                $match_id= $this->input->post("match_id");
                $this->load->model("Team_model");
                $team_id= $this->input->post("team_id");
                
                $team_a_goal00=$this->input->post("team_a_goal00");
                $team_b_goal00=$this->input->post("team_b_goal00");
                $matechrate00=$this->input->post("matechrate00");
                if($team_a_goal00==0 && $team_b_goal00==0 && $matechrate00 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal00.' - '.$team_b_goal00;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'D';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal00,"score_b"=>$team_b_goal00,"rate_per_goal"=>$matechrate00,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                       
                }

                $team_a_goal11=$this->input->post("team_a_goal11");
                $team_b_goal11=$this->input->post("team_b_goal11");
                $matechrate11=$this->input->post("matechrate11");
                if($team_a_goal11==1 && $team_b_goal11==1 && $matechrate11 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal11.' - '.$team_b_goal11;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'D';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal11,"score_b"=>$team_b_goal11,"rate_per_goal"=>$matechrate11,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                    
                } 

                $team_a_goal22=$this->input->post("team_a_goal22");
                $team_b_goal22=$this->input->post("team_b_goal22");
                $matechrate22=$this->input->post("matechrate22");
                if($team_a_goal22==2 && $team_b_goal22==2 && $matechrate22 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal22.' - '.$team_b_goal22;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'D';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal22,"score_b"=>$team_b_goal22,"rate_per_goal"=>$matechrate22,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                      
                }

                $team_a_goal33=$this->input->post("team_a_goal33");
                $team_b_goal33=$this->input->post("team_b_goal33");
                $matechrate33=$this->input->post("matechrate33");
                if($team_a_goal33==3 && $team_b_goal33==3 && $matechrate33 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal33.' - '.$team_b_goal33;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'D';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal33,"score_b"=>$team_b_goal33,"rate_per_goal"=>$matechrate33,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);
                } 

                $team_a_goal44=$this->input->post("team_a_goal44");
                $team_b_goal44=$this->input->post("team_b_goal44");
                $matechrate44=$this->input->post("matechrate44");
                if($team_a_goal44==4 && $team_b_goal44==4 && $matechrate44 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal44.' - '.$team_b_goal44;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'D';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal44,"score_b"=>$team_b_goal44,"rate_per_goal"=>$matechrate44,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                     
                }    
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                    <i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Success!</strong> Your request added successfully...
                                </div>');
                redirect('admin/add_rate/'.$match_id);
                $this->load->view('admin/add_match_rate',$data); 
            }
        }
    
     

        public function add_rate_team_b($match_id)
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
    
            $this->load->library('form_validation');
            $this->load->model("Team_model");
    
            $this->form_validation->set_rules('team_id', 'Select team', 'trim|required');
            // $this->form_validation->set_rules('team_code', 'Select Match', 'trim|required');
            // $this->form_validation->set_rules('team_a_goal', 'Team A Goal', 'trim|required');
            // $this->form_validation->set_rules('team_b_goal', 'Team B Goal', 'trim|required');
            // $this->form_validation->set_rules('matechrate', 'Rate', 'trim|required');
                   

            $data["allteam"] = $this->Team_model->get_match_team($match_id);
            $data["allteamrateA"] = $this->Team_model->get_matchteam_a_withrate($match_id);
            $data["allteamrateB"] = $this->Team_model->get_matchteam_b_withrate($match_id);
            $data["allteamrateD"] = $this->Team_model->get_matchteam_d_withrate($match_id);
    
            
            if ($this->form_validation->run() == FALSE)
            {
                if($this->form_validation->error_string()!=""){
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>';
                }
                $this->load->view('admin/add_match_rate',$data);
            } else {
                $match_id= $this->input->post("match_id");
                $this->load->model("Team_model");
                $team_id= $this->input->post("team_id");

                $team_a_goal06=$this->input->post("team_a_goal06");
                $team_b_goal06=$this->input->post("team_b_goal06");
                $matechrate06=$this->input->post("matechrate06");
                if($team_a_goal06==0 && $team_b_goal06==6 && $matechrate06 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal06.' - '.$team_b_goal06;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal06,"score_b"=>$team_b_goal06,"rate_per_goal"=>$matechrate06,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                     
                }

                $team_a_goal01=$this->input->post("team_a_goal01");
                $team_b_goal01=$this->input->post("team_b_goal01");
                $matechrate01=$this->input->post("matechrate01");
                if($team_a_goal01==0 && $team_b_goal01==1 && $matechrate01 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal01.' - '.$team_b_goal01;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal01,"score_b"=>$team_b_goal01,"rate_per_goal"=>$matechrate01,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                     
                }   

                $team_a_goal02=$this->input->post("team_a_goal02");
                $team_b_goal02=$this->input->post("team_b_goal02");
                $matechrate02=$this->input->post("matechrate02");
                if($team_a_goal02==0 && $team_b_goal02==2 && $matechrate02 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal02.' - '.$team_b_goal02;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal02,"score_b"=>$team_b_goal02,"rate_per_goal"=>$matechrate02,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate); 
                }    



                $team_a_goal12=$this->input->post("team_a_goal12");
                $team_b_goal12=$this->input->post("team_b_goal12");
                $matechrate12=$this->input->post("matechrate12");
                if($team_a_goal12==1 && $team_b_goal12==2 && $matechrate12 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal12.' - '.$team_b_goal12;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal12,"score_b"=>$team_b_goal12,"rate_per_goal"=>$matechrate12,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate); 
                }  



                $team_a_goal03=$this->input->post("team_a_goal03");
                $team_b_goal03=$this->input->post("team_b_goal03");
                $matechrate03=$this->input->post("matechrate03");
                if($team_a_goal03==0 && $team_b_goal03==3 && $matechrate03 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal03.' - '.$team_b_goal03;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal03,"score_b"=>$team_b_goal03,"rate_per_goal"=>$matechrate03,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);                    
                }

                $team_a_goal13=$this->input->post("team_a_goal13");
                $team_b_goal13=$this->input->post("team_b_goal13");
                $matechrate13=$this->input->post("matechrate13");
                if($team_a_goal13==1 && $team_b_goal13==3 && $matechrate13 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal13.' - '.$team_b_goal13;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal13,"score_b"=>$team_b_goal13,"rate_per_goal"=>$matechrate13,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate); 
                }


                $team_a_goal23=$this->input->post("team_a_goal23");
                $team_b_goal23=$this->input->post("team_b_goal23");
                $matechrate23=$this->input->post("matechrate23");
                if($team_a_goal23==2 && $team_b_goal23==3 && $matechrate23 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal23.' - '.$team_b_goal23;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal23,"score_b"=>$team_b_goal23,"rate_per_goal"=>$matechrate23,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate); 
                }

                $team_a_goal04=$this->input->post("team_a_goal04");
                $team_b_goal04=$this->input->post("team_b_goal04");
                $matechrate04=$this->input->post("matechrate04");
                if($team_a_goal04==0 && $team_b_goal04==4 && $matechrate04 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal04.' - '.$team_b_goal04;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal04,"score_b"=>$team_b_goal04,"rate_per_goal"=>$matechrate04,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new", $rate);
                }                

                $team_a_goal14=$this->input->post("team_a_goal14");
                $team_b_goal14=$this->input->post("team_b_goal14");
                $matechrate14=$this->input->post("matechrate14");
                if($team_a_goal14==1 && $team_b_goal14==4 && $matechrate14 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal14.' - '.$team_b_goal14;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal14,"score_b"=>$team_b_goal14,"rate_per_goal"=>$matechrate14,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate); 
                }    



                $team_a_goal24=$this->input->post("team_a_goal24");
                $team_b_goal24=$this->input->post("team_b_goal24");
                $matechrate24=$this->input->post("matechrate24");
                if($team_a_goal24==2 && $team_b_goal24==4 && $matechrate24 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal24.' - '.$team_b_goal24;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal24,"score_b"=>$team_b_goal24,"rate_per_goal"=>$matechrate24,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);
                }

                $team_a_goal34=$this->input->post("team_a_goal34");
                $team_b_goal34=$this->input->post("team_b_goal34");
                $matechrate34=$this->input->post("matechrate34");
                if($team_a_goal34==3 && $team_b_goal34==4 && $matechrate34 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal34.' - '.$team_b_goal34;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal34,"score_b"=>$team_b_goal34,"rate_per_goal"=>$matechrate34,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate);
                }  

                $team_a_goal51=$this->input->post("team_a_goal51");
                $team_b_goal51=$this->input->post("team_b_goal51");
                $matechrate51=$this->input->post("matechrate51");
                if($team_a_goal51==5 && $team_b_goal51==1 && $matechrate51 != "")
                {
                    $this->load->model("Team_model");
                    $rate_score = $team_a_goal51.' - '.$team_b_goal51;
                    $team1=  $this->Team_model->get_match_by_id($match_id); 
                    $team=  $this->Team_model->get_team_by_id($team_id); 
                    $team_name1= $team1->team_a_id.$team1->team_b_id;
                    $team_code= 'B';
                    $team_name=$team->team_name;
                    $rate = array("match_id"=>$match_id,"team_id"=>$team_id,"team_code"=>$team_code,"score_a"=>$team_a_goal51,"score_b"=>$team_b_goal51,"rate_per_goal"=>$matechrate51,"team_name"=>$team_name, "rate_score"=>$rate_score,);
                    $this->db->insert("team_goal_rate_new",$rate); 
                }    
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                    <i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Success!</strong> Your request added successfully...
                                </div>');
                redirect('admin/add_rate/'.$match_id);
                $this->load->view('admin/add_match_rate',$data); 
            }
        }
        
        public function deleteteam_rate($id)
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
            $data = array();
            $this->load->model("Team_model");
            $slider  = $this->Team_model->team_goal_rate_by_id($id);
            if($slider){
                $this->db->query("Delete from team_goal_rate where team_goal_rate_id = '".$slider->team_goal_rate_id."'");
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong>Success!</strong> Your item deleted successfully...
                    </div>');
                redirect("admin/add_rate");
            }
        }

        public function betting_member_details()
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
            $data =  $this->Team_model->betting_member_details_model();            
            $arrayName = array('data' => $data);
            $this->load->view('admin/betting_list',$arrayName);
        }

        public function betting_results()
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
    
            $this->load->library('form_validation');
            $this->load->model("Team_model");
    
            $this->form_validation->set_rules('match_id', 'Select Team', 'trim|required');
            $this->form_validation->set_rules('team_a_score', 'Team A Score', 'trim|required');
            $this->form_validation->set_rules('team_b_score', 'Team B Score', 'trim|required');
            // $this->form_validation->set_rules('matechrate', 'Rate', 'trim|required');            

            $data["allteam"] = $this->Team_model->get_allmatch();
            $data["allteamrate"] = $this->Team_model->get_allmatch_withresults();
    
            if ($this->form_validation->run() == FALSE)
            {
                if($this->form_validation->error_string()!=""){
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                    <i class="fa fa-warning"></i>
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                }
            } else {
                $this->load->model("Team_model");
                $team_id= $this->input->post("match_id");                   
                $team=  $this->Team_model->get_match_by_id($team_id); 
                $team_a=$team->team_a;
                $team_b=$team->team_b;
                $match_date=$team->match_date;
                // $team_name= $team->team_a.' VS '.$team->team_b;                    
                $this->Team_model->add_result_score($team_a,$team_b,$match_date); 
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                    <i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Success!</strong> Your request added successfully...
                                </div>');
                redirect('admin/betting_results');
            }
            $this->load->view('admin/betting_results',$data);
        }
        
        public function deletematch_result($id)
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
            $data = array();
            $this->load->model("Team_model");
            $slider  = $this->Team_model->result_match_id($id);
            if($slider){
                 $this->db->query("Delete from match_results where match_id = '".$slider->match_id."'");
                 $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Success!</strong> Your item deleted successfully...
                        </div>');

                redirect("admin/betting_results");
            }
        }     
                   
        public function announce_winning_result($id,$team_a_score,$team_b_score)
        {                  
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }

            if ($team_a_score>=5) { 
                $team_a_score1=5;
                $team_b_score1=0;
                $data=array('status'=>1);
                $condition =array('match_id'=>$id ,'team1_score'=>$team_a_score1,'team2_score'=>$team_b_score1);
                $this->db->where($condition);
                $this->db->update('betting_table',$data);
            }

            if ($team_b_score>=5) {
                $team_a_score2=5;
                $team_b_score2=1;
                $data=array('status'=>1);
                $condition =array('match_id'=>$id ,'team1_score'=>$team_a_score2,'team2_score'=>$team_b_score2);
                $this->db->where($condition);
                $this->db->update('betting_table',$data);
            }

            if ($team_a_score>$team_b_score) {
                $team_a_score3=6;
                $team_b_score3=0;
                $data=array('status'=>1);
                $condition =array('match_id'=>$id ,'team1_score'=>$team_a_score3,'team2_score'=>$team_b_score3);
                $this->db->where($condition);
                $this->db->update('betting_table',$data);
            }

            if ($team_b_score>$team_a_score) {
                $team_a_score4=0;
                $team_b_score4=6;
                $data=array('status'=>1);
                $condition =array('match_id'=>$id ,'team1_score'=>$team_a_score4,'team2_score'=>$team_b_score4);
                $this->db->where($condition);
                $this->db->update('betting_table',$data);
            }

            if ($team_a_score < 5) {
                $this->Team_model->update_member_status($id,$team_a_score,$team_b_score);
            }

            if ($team_b_score < 5) {
                $this->Team_model->update_member_status($id,$team_a_score,$team_b_score);
            }
     
            $data=array('win_score_a'=>$team_a_score,'win_score_b'=>$team_b_score);
            $condition =array('match_id'=>$id);
            $this->db->where($condition);
            $this->db->update('match_table',$data);
            $this->db->query("UPDATE  match_table SET match_end=1 where match_id = '".$id."'");
            $this->Team_model->update_result_status($id);
            $this->Team_model->update_member_status2($id);

            $data =  $this->Team_model->select_member_balance($id);
            // print_r($data);
            foreach ($data as $members) {
                $member_id = $members['member_id'];
                $betting_credit =  $members['betting_credit'];
                $data1 =  $this->Team_model->select_memberold_balance($member_id);
                $balance = $data1['balance'];
                // echo "<pre>";
                $balance_new = $betting_credit + $balance;
                // echo "<pre>";
                $this->Team_model->add_member_balance($member_id,$balance_new);
            }
            redirect('admin/betting_results');
        }  

        public function withdraw_request_by_user()
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }
        
            $this->load->model("Admin_model");
            $data['request'] = $this->Admin_model->withdraw_request_by_user_model(); 
       
            $this->load->view('admin/withdraw_request_by_user_view',$data);
        }

    public function update_status()
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
         $user_id= $this->input->post("user_id");
         
           $withdrwal_id= $this->input->post("withdrwal_id");
 $this->load->model("Admin_model");
      $this->Admin_model->update_status_model($user_id,$withdrwal_id); 
       
    redirect('admin/withdraw_request_by_user');

       

    }
   
     public function add_account()
        {
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
           
                $q = $this->db->query("select * from `account_table`");
                $data["getcat"] = $q->row();
                
                $data["error"] = "";
               
        $this->load->library('form_validation');
        $this->load->model("Team_model");

$this->form_validation->set_rules('payment_method', 'Payment_Method', 'trim|required');
$this->form_validation->set_rules('account_details', 'Account Details', 'trim|required');

// $this->form_validation->set_rules('team_image', 'Team Image', 'trim|required');
            $data['account']=$this->User_model->get_account_model();

                  
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
                        $this->load->model("Team_model");
                        $this->Team_model->add_account(); 
                        $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong>  Your Account Added successfully...
                                        </div>');
                        redirect('admin/add_account');
                    }

              $this->load->view('admin/add_admin_account',$data);
                    
    
        }
        
        
        public function end_bid_match($match_id)
        {
            if (!$this->session->userdata('admin_username') ) {
                redirect('admin/index');
            }        
            $this->load->model("Admin_model");
            $this->Admin_model->update_bid_match_model($match_id);         
            redirect('admin/addmatch');
        }
     
         public function show_winner($id,$team_a_score,$team_b_score)
                {                  
                    if (!$this->session->userdata('admin_username') ) {
                        redirect('admin/index');
                    }
                        $data['winner'] = $this->Team_model->select_member_status($id,$team_a_score,$team_b_score);
                        
                        $q = $this->db->query("select * from `match_table` WHERE match_id=".$id);
                $data["match"] = $q->result();
            $this->load->view('admin/show_winners',$data);
                        // redirect('admin/show_winner');


                    
                }
    public function add_credit1($id)
    {
        $arrayName = array('id' => $id );
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        
            $this->load->view('admin/add_credit_view1',$arrayName);
        
        
    }
    public function add_credit_ctrl1()
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        

        $id = $this->input->post('id');
        $credit_new = $this->input->post('credit');
        print_r($credit_new);
        $data = $this->Admin_model->member_credit_model($id); 
        $credit_old =  $data['credit'];
        $neg_credit_old = -1 * $credit_old;
        print_r($credit_old);
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('credit', 'Credit', "required|greater_than_equal_to[$neg_credit_old]");
        
        if ($this->form_validation->run() === FALSE )
        {   
            if($this->form_validation->error_string()!="") {
                $this->session->set_flashdata("error",'<div class="alert alert-warning alert-dismissible" role="alert"><i class="fa fa-warning"></i><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Warning!</strong> '.$this->form_validation->error_string().'
                </div>');
                redirect("admin/add_credit1/$id");
            }
        }

        $credit = $credit_old + $credit_new;
        print_r($credit);
        $this->Admin_model->add_credit_model($id,$credit); 
        redirect('admin/member');        
    }
    
    
    public function start_bid_match($match_id)
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
       
 $this->load->model("Admin_model");
      $this->Admin_model->update_start_bid_match_model($match_id); 
       
    redirect('admin/addmatch');

       

    }
    
    
      public function delete_account($id)
        {  
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
             $data = array();
                $this->load->model("Team_model");
                $slider  = $this->Team_model->get_account_by_id($id);
                if($slider){
               echo $this->db->query("Delete from `account_table` where acc_id = '".$slider->acc_id."'");
               
              
           
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Your Account deleted successfully...
                </div>');

                redirect("admin/add_account");
               }
        }


 public function add_balance_by_user()
    {
        if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
        $this->load->model("Admin_model");
         $user_id= $this->input->post("user_id");
           $team1_score= $this->input->post("team1_score");
           $betting_id= $this->input->post("betting_id");
           $team2_score= $this->input->post("team2_score");
           $match_id= $this->input->post("match_id");
             $bet_amt= $this->input->post("bet_amt");
     $data1 = $this->Admin_model->get_balance_model($user_id);
     
    $uamt= $data1['balance'];

$total_amt= $uamt + $bet_amt;
 
      $this->Admin_model->add_balance_by_user_model($user_id,$total_amt); 
      $this->Admin_model->add_balance_by_betting_id_model($betting_id); 
       
    redirect('admin/show_winner/'.$match_id.'/'.$team1_score.'/'.$team2_score);

    }
    
    
    
      
        public function editaccount($id)
        {
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
          
                $q = $this->db->query("select * from `account_table` where acc_id='$id' ");
                $data["getaccount"] = $q->row();
                
                $data["error"] = "";
               
        $this->load->library('form_validation');
        $this->load->model("Team_model");

$this->form_validation->set_rules('payment_method', 'Payment_Method', 'trim|required');
$this->form_validation->set_rules('account_details', 'Account Details', 'trim|required');

// $this->form_validation->set_rules('team_image', 'Team Image', 'trim|required');
            $data['account']=$this->User_model->get_account_model();

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
                        $this->load->model("Team_model");
                        $this->Team_model->edit_account(); 
                        $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your Account Update successfully...
                                        </div>');
                        redirect('admin/add_account');
                    }
              $this->load->view('admin/update_admin_account',$data);
                    
    
        }





 public function deleterate($team_goal_rate_id)
        {
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
               $data = array();
                $this->load->model("Team_model");
                $match  = $this->Team_model->get_match_id($team_goal_rate_id);
              
              $match_id=$match['match_id'];

         $this->db->query("Delete from team_goal_rate_new where team_goal_rate_id = '".$team_goal_rate_id."'");
   $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Your item deleted successfully...
                </div>');

                redirect("admin/add_rate/".$match_id);
           
        }
        
        
        
           public function delete_teammatch($match_id)
        {  
             if (!$this->session->userdata('admin_username') ) {
            redirect('admin/index');
        }
             $data = array();
              
                $this->db->query("UPDATE  match_table SET match_end=1 where match_id = '".$match_id."'");
               
              
           
                $this->session->set_flashdata("success_req",'<div class="alert alert-success alert-dismissible" role="alert">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Your item deleted successfully...
                </div>');

                redirect("admin/addmatch");
               }
    

}
