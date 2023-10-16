<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survivor_tools extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('survivor_tools_model');
        $this->load->library('auth');
    }
    public function index(){
        if( can('view-volunteer') ) {
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Survivor tools'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('survivor_tools/index', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function add()
    {
        if( can('add-volunteer') ) {
            if ($this->input->post('insert')) {
                $data['name'] = $this->input->post('name');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                if (!is_dir('uploads/survivor_tools')) {
                    mkdir('./uploads/survivor_tools', 0777, TRUE);

                }
                $imgVal = true;
                $config['upload_path'] = 'uploads/survivor_tools';
                $config['allowed_types'] = 'pdf';
                // $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = 100000;
                // $config['max_size'] = 2000;
                $config['file_name'] = $_FILES['document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!empty($_FILES['document']['name'])) {

                    if ($this->upload->do_upload('document')) {
                        $uploadData = $this->upload->data();
                        $picture = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'document_error', $this->upload->display_errors() );
                        $imgVal = false;

                    }
                } else {
                    $this->session->set_flashdata( 'document_error', "Document Needed" );
                    $imgVal = false;
                }

                if (($this->form_validation->run() == true) && ($imgVal) ) {

                    $url = base_url();
                    $data['path'] = $url . 'uploads/survivor_tools/' . $picture;
                    if($this->survivor_tools_model->add($data)){
                        $this->session->set_flashdata('msg', "Added successfully");
                    }
                    else{
                        $this->session->set_flashdata('msg', "Something went wrong please try later");
                    }

                    $base_url = base_url();
                    redirect("$base_url" . "survivor_tools/add/");
                }
                else{
                    $data['error'] = validation_errors();
                    //print_r(validation_errors()); exit;
                }

            }
    //echo "Hi"; exit;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Survivor tool'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('survivor_tools/add');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission Denied!!";
        }

    }



    public function edit($id)
    {
        if( can('edit-volunteer') ) {
            $s_tool = $this->survivor_tools_model->get($id);
            if ($this->input->post('update')) {
                $url = base_url();
                $data['name'] = $this->input->post('name');


                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required');

                $imgVal = true;
                $config['upload_path'] = 'uploads/survivor_tools/';
                $config['allowed_types'] = 'pdf';
                // $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = 100000;
                // $config['max_size'] = 2000;
                $config['file_name'] = $_FILES['document']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!empty($_FILES['document']['name'])) {

                    if ($this->upload->do_upload('document')) {
                        $uploadData = $this->upload->data();
                        $picture = $url . 'uploads/survivor_tools/' .$uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'document_error', $this->upload->display_errors() );
                        $imgVal = false;
                    }
                } else {
                    $picture = $s_tool->path;
                }


                if (($this->form_validation->run() == true) && ($imgVal) ) {

                    $data['path'] =  $picture;

                    $update = $this->survivor_tools_model->update_entry($data,$id);
                    if($update){
                        $this->session->set_flashdata('msg', "Updated successfully");
                        $base_url = base_url();
                        redirect("$base_url" . "survivor_tools");
                    }
                }
                else{
                    $data['error'] = validation_errors();
                    //print_r(validation_errors()); exit;
                }

            }

            $data['s_tool'] = $s_tool;
            //print_r($s_tool); exit;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Survivor tools'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('survivor_tools/edit', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }



    public function delete($id)
    {
        if( can('delete-volunteer') ) {
            if($this->survivor_tools_model->delete($id)){
                $this->session->set_flashdata('msg', "Deleted successfully");
            }

            redirect(site_url() . "survivor_tools/");
        }
        else{
            echo "Permission denied";
        }
    }


    function getLists()
    {
        if( can('view-volunteer') ) {
            $data = $row = array();

            // Fetch member's records
            $survivorData = $this->survivor_tools_model->getRows($_POST);

            $i = $_POST['start'];
            foreach ($survivorData as $survivor) {
                $i++;
                $data[] = array($survivor->s_id, $survivor->name, $survivor->path);
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->survivor_tools_model->countAll(),
                "recordsFiltered" => $this->survivor_tools_model->countFiltered($_POST),
                "data" => $data,
            );

            // Output to JSON format
            echo json_encode($output);
        }
        else{
            echo "Permission denied";
        }

    }

    function  hello()
    {
        $mail = new PHPMailer(true);

        $auth = true;

        if ($auth) {
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "ssl://mail.shamsaha.org";
            $mail->Port = 465;
            $mail->Username = "info@shamsaha.org";
            $mail->Password = "office1234@PC";
        }

        $mail->AddAddress("velrke@gmail.com");
        $mail->SetFrom("info@thesocialwifi.com", "John Deo");
        $mail->isHTML(true);
        $mail->Subject = "Test Email";
        $mail->Body = "Hello World";

        try {
            $mail->Send();
            return true;
        } catch(Exception $e){
            echo $mail->ErrorInfo;
        }
    }

}
