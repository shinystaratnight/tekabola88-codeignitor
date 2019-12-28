<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
	}

	public function index()
	{
		$this->load->view('home_page');
	}

	public function signin()
	{
		$this->load->view('signin_page');
	}


	public function signup()
	{


		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|is_unique[member.tell_number]');
		$this->form_validation->set_rules('password1', 'password', 'trim|required|min_length[6]|alpha_numeric');
		$this->form_validation->set_rules('password2', 'Retype password', 'trim|required|matches[password1]');

		if ($this->form_validation->run() == FALSE) {
			if ($this->form_validation->error_string() != "") {
				$data["error"] = '<div class="alert alert-danger alert-dismissable" role="alert">
                  	<i class="fa fa-warning"></i>
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Warning!</strong> ' . $this->form_validation->error_string() . '
					</div>';
				$this->load->view('signup_page', $data);
				return;
			}
		} else {
			//$this->load->model("Home_model");
			$this->Home_model->signup_model();
			$this->session->set_flashdata("success_req", '<div class="alert alert-success alert-dismissible" role="alert">
                    <i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Success!</strong> Your  Signup successfully...
					</div>');
			redirect('Home/signup');
		}

		$this->load->view('signup_page');
	}


	public function contact()
	{

		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required');
		$this->form_validation->set_rules('msg', 'Message', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if ($this->form_validation->error_string() != "") {
				$data["error"] = '<div class="alert alert-danger alert-dismissable" role="alert">
                  	<i class="fa fa-warning"></i>
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Warning!</strong> ' . $this->form_validation->error_string() . '
					</div>';
				$this->load->view('contact_page', $data);
				return;
			}
		} else {
			//$this->load->model("Home_model");
			$this->Home_model->contact_model();
			$this->session->set_flashdata("success_req", '<div class="alert alert-success alert-dismissible" role="alert">
				<i class="fa fa-check"></i>
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong>Success!</strong> Your  Message Send successfully...
				</div>');
			redirect('Home/contact');
		}

		$this->load->view('contact_page');
	}


	public function login()
	{

		$phone = $this->input->post('phone');
		$password = $this->input->post('password');

		$this->load->model('Home_model');
		$userdata = $this->Home_model->user_login($phone, $password);
		// print_r($userdata);
		$id = $userdata['id'];
		if ($userdata) {
			//declaring session
			$this->session->set_userdata(array('userid' => $phone));
			$this->session->set_userdata(array('id' => $id));

			redirect('user');
			//$this->load->view('admin/dashboard');
		} else {
			$data['error'] = '<p style="color:red">Phone or Password is Invalid </p>';
			$this->load->view('signin_page', $data);
		}

		$this->session->userdata('userid');
	}
	function signout()
	{
		$this->session->sess_destroy();
		redirect("home/signin");
	}
}
