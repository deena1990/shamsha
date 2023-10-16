<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multiple_delete extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('multiple_delete_model');
  $this->load->model('volunteer_model');
  $this->load->library('auth');
 }

 function index()
 {
     $data['volunteer_data'] = $this->multiple_delete_model->fetch_data();
     $data['site_title'] = 'Admin Dashboard'; //Title
     $this->load->view('header',$data);
     $this->load->view('volunteerlist',$data);
     $this->load->view('user_footer');

 }

 function delete_all()
 {
  if( can('delete-volunteer') ) {
   if($this->input->post('checkbox_value'))
   {
    $id = $this->input->post('checkbox_value');
    for($count = 0; $count < count($id); $count++)
    {
     $this->multiple_delete_model->delete($id[$count]);
    }
   }
  }
  else{
   echo "Permission Denied!!";
  }

 }
  
}
?>
