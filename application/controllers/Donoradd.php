<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donoradd extends CI_Controller{
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('Donoradd_Model');
		
				
	}
	public function index(){
		if(!$this->session->userdata('US_Id')){
			header('location:'.base_url());
			
		}
		else{
			$US_Id = $this->session->userdata('US_Id');
			$data['userlist'] = $this->Donoradd_Model->getusers();
			$this->load->view('donoradd/donoradd');
			$this->load->view('common/footer');	
	    }
    } 
	
	public function insert (){
	if(!$this->session->userdata('US_Id')) {
	
		header('location:'.base_url());
	}
	else{
			$data['pageTitle']  = ' Admin | donoradd';
			$this->load->view('donoradd/insert');
			$this->load->view('common/footer');
		} 	
}
  
	public function save(){
		//echo('hi');exit();
	if(isset($_POST)){
		$this->form_validation->set_rules('Name', 'name', 'trim|required');
		$this->form_validation->set_rules('Donororgan', 'donororgan', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('userlocation', 'location', 'trim|required');
		
		

			$data['Donation_Info'] = $this->input->post("name");
			$data['Donating_Organ'] = $this->input->post("donororgan");
			$data['Location'] = $this->input->post("location");
			$data['Status'] = $this->input->post("status");
			$gal = $this->Donoradd_Model->insert($data);
			$data['class'] = "success";
			$data['msg'] = "User inserted successfully";
			redirect('http://localhost/organ/o_user/index.php/donoradd');
		
	}
	

	
} 
}
