<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Employee extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('employee_m', 'm');
	}

	function index(){
		$this->load->view('layout/header');
		$this->load->view('employee/index');
		$this->load->view('layout/footer');
	}

	public function showAllEmployee(){
		$result = $this->m->showAllEmployee();
		echo json_encode($result);
	}

	public function addEmployee(){
		// print_r($_FILES);exit;
			$this->load->library('upload');
			$logoDirectory = './images/';
         	$new_name = $_FILES["txtImage"]['name'];
			$config['file_name'] = time().$new_name;
	        $config['allowed_types'] = '*';
	        $config['remove_spaces'] = FALSE;
	        $config['upload_path'] = $logoDirectory;
	        $this->upload->initialize($config);
	        $this->load->library('upload', $config);
	        if ($this->upload->do_upload('txtImage')){
              	$logoDetails = $this->upload->data();
          	} else{
          		$data['imageError'] =  $this->upload->display_errors();
          	}
          	$result = $this->m->addEmployee($this->input->post(),$logoDetails['file_name']);
          	 	$msg['success'] = true;
			 	$msg['type'] = 'add';
			 	echo json_encode($msg);
	}

	public function editEmployee(){
		$result = $this->m->editEmployee();
		echo json_encode($result);

	}

	public function updateEmployee(){

		$this->load->library('upload');
			$logoDirectory = './images/';
         	$new_name = $_FILES["txtImage"]['name'];
			$config['file_name'] = time().$new_name;
	        $config['allowed_types'] = '*';
	        $config['remove_spaces'] = FALSE;
	        $config['upload_path'] = $logoDirectory;
	        $this->upload->initialize($config);
	        $this->load->library('upload', $config);
	        if ($this->upload->do_upload('txtImage')){
              	$logoDetails = $this->upload->data();
          	} else{
          		$data['imageError'] =  $this->upload->display_errors();
          	}
		$result = $this->m->updateEmployee($this->input->post(),$logoDetails['file_name']);
		//print_r($result); exit;

		$msg['success'] = true;
		$msg['type'] = 'update';

		// if($result){
		// 	$msg['success'] = true;
		// }
		echo json_encode($msg);
	}

	public function deleteEmployee(){
		$result = $this->m->deleteEmployee();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}