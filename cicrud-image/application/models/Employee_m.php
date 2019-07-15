<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_m extends CI_Model{
	public function showAllEmployee(){
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get('tbl_employees');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function addEmployee($postdata,$filename){
		// print_r($postdata);
		// print_r($filename);exit;
		$field = array(
			'employee_name'=>$postdata['txtEmployeeName'],
			'address'=>	 $postdata['txtAddress'],
			'email'=>$postdata['txtEmail'],
			'number'=>$postdata['txtNumber'],
			'file_name'=>$filename,
			'created_at'=>date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_employees', $field);
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function editEmployee(){
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_employees');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function updateEmployee($postdata,$filename){
		$id = $this->input->post('txtId');
		$field = array(
		// 'employee_name'=>$this->input->post('txtEmployeeName'),
		// 'address'=>$this->input->post('txtAddress'),
		//  'email'=>$this->input->post('txtEmail'),
		//  'number'=>$this->input->post('txtNumber'),
		//  'file_name'=>$this->input->post('txtImage'),
			'employee_name'=>$postdata['txtEmployeeName'],
			'address'=>	 $postdata['txtAddress'],
			'email'=>$postdata['txtEmail'],
			'number'=>$postdata['txtNumber'],
			'file_name'=>$filename,
		'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_employees', $field);
		//print_r($field); exit;
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function deleteEmployee(){
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$this->db->delete('tbl_employees');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}