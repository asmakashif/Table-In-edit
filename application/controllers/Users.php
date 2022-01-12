<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		
		parent::__construct();

		// load model
		$this->load->model('UsersModel');

		// load base_url
		$this->load->helper('url');

	}

	public function index(){

		// get data
		$data['userlist'] = $this->UsersModel->getUsers();	

		$this->load->view('user_view',$data);
	}

	public function updateuser(){
		// POST values
	    $id = $this->input->post('id');
	    $field = $this->input->post('field');
	    $value = $this->input->post('value');

	    // Update records
	    $this->UsersModel->updateUser($id,$field,$value);

	    echo 1;
	    exit;
	}

}
