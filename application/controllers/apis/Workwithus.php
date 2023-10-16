<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Workwithus extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/workwithus_model');
        $this->load->library('form_validation');
    }

    public function index_post() {
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                'success' => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                'success' => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            $result = $this->workwithus_model->get_data();
            if ($result) {
                if ($language == "en"){ $title = $result->title_en; $content = strip_tags($result->content_en); }
                if ($language == "ar"){ $title = $result->title_ar; $content = strip_tags($result->content_ar); }
                $data = array(
                    'success' => 'true',
                    'message' => '',
                    'Data' => array( 'title' => $title, 'content' => $content )
                );
            } else {
                if ($language == "en"){ $msg = "Data not found"; }
                if ($language == "ar"){ $msg = "لم يتم العثور على بيانات"; }
                $data = array(
                    'success' => 'false',
                    'message' => $msg,
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function save_form_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                'success' => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                'success' => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Form submitted successfully !!"; $msg2 = "Something went wrong, please try again !!"; }
            if ($language == "ar"){ $msg1 = "في محطة للحافلات !!"; $msg2 = "حدث خطأ ما. أعد المحاولة من فضلك !!"; }
            $data['name'] = $this->input->post('name');
            $data['mobile'] = $this->input->post('mobile');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['interests'] = $this->input->post('interests');

            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
            $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('interests', 'Interests', 'trim|required');
            // if (empty($_FILES['image']['name']))
            // {
            //     $this->form_validation->set_rules('image', 'Image', 'required');
            // }
            if (empty($_FILES['resume']['name']))
            {
                $this->form_validation->set_rules('resume', 'CV', 'required');
            }
            $this->form_validation->set_data($data);
            if (($this->form_validation->run() == true)) {
                if (!empty($_FILES['image']['name']))
                {
                    //     $config['upload_path'] = 'uploads/';
                    //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    //     // $config['max_size'] = 2000;
                    //     // $config['max_width'] = 1500;
                    //     // $config['max_height'] = 1500;
                    //     $config['file_name'] = $_FILES['image']['name'];

                    //     //Load upload library and initialize configuration
                    //     $this->load->library('upload', $config);
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('image')) {
                    //         $uploadData = $this->upload->data();
                    //         $picture = $uploadData['file_name'];
                    //         $data['user_image'] = $picture;
                    //     }
                    
                    // else{
                    //     $data['user_image'] = "";
                    // }


                    $image=$_FILES['image']['name']; 
                    $expimage=explode('.',$image);
                    $imageexptype=$expimage[1];
                    // date_default_timezone_set('Australia/Melbourne');
                    $date = date('m/d/Yh:i:sa', time());
                    $rand=rand(10000,99999);
                    $encname=$date.$rand;
                    $imagename=md5($encname).'.'.$imageexptype;
                    $imagepath="uploads/".$imagename;
                    move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
                    $data['user_image'] = $imagename;

                }else{
                    $data['user_image'] = "";
                }

                


                if (!empty($_FILES['resume']['name']))
                {

                    $resume=$_FILES['resume']['name']; 
                    $expresume=explode('.',$resume);
                    $resumeexptype=$expresume[1];
                    // date_default_timezone_set('Australia/Melbourne');
                    $date = date('m/d/Yh:i:sa', time());
                    $rand=rand(10000,99999);
                    $encname=$date.$rand;
                    $resumename=md5($encname).'.'.$resumeexptype;
                    $resumepath="uploads/".$resumename;
                    move_uploaded_file($_FILES["resume"]["tmp_name"],$resumepath);
                    $data['user_cv'] = $resumename;


                    //     $config['upload_path'] = 'uploads/';
                    //     // $config['allowed_types'] = 'pdf|doc|docx';
                    //     // $config['max_size'] = 5000;
                    //     // $config['max_width'] = 1500;
                    //     // $config['max_height'] = 1500;
                    //     $config['file_name'] = $_FILES['resume']['name'];

                    //     //Load upload library and initialize configuration
                    //     $this->load->library('upload', $config);
                    //     $this->upload->initialize($config);

                    //     if ($this->upload->do_upload('resume')) {
                    //         $uploadData = $this->upload->data();
                    //         $picture = $uploadData['file_name'];
                    //         $data['user_cv'] = $picture;
                    //     }
                }

                $save_form = [
                    'name' => $data['name'],
                    'mobile' => $data['mobile'],
                    'email' => $data['email'],
                    'address' => $data['address'],
                    'interests' => $data['interests'],
                    'user_image' => $data['user_image'],
                    'user_cv' => $data['user_cv'],
                ];
                $result = $this->workwithus_model->save_form_data($save_form);
                if($result){
                    $data = array(
                        'success' => 'true',
                        'message' => $msg1,
                    );
                }else {
                    $data = array(
                        'success' => 'false',
                        'message' => $msg2,
                    );
                }
            }else{
                $errors = $this->form_validation->error_array();
                $fields = array_keys($errors);
                $err_msg = $errors[$fields[0]];
                $data = array(
                    'success' => 'false',
                    'message' => $err_msg
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
