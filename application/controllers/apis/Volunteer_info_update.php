<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_info_update extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/volunteer_login_model');
    }

    public function index_post() {
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Mobile number required !!"; $msg3 = "Whatsapp number required !!"; $msg4 = "Image required !!"; $msg5 = "Profile updated successfully !!"; $msg6 = "Volunteer Id is not correct !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "رقم الهاتف مطلوب !!"; $msg3 = "رقم الواتس اب مطلوب !!"; $msg4 = "الصورة مطلوبة !!"; $msg5 = "تم تحديث الملف الشخصي بنجاح !!"; $msg6 = "هوية المتطوع غير صحيحة !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }

            else {
                $checkVolExist = $this->volunteer_login_model->user_single_detail($this->post('volunteer_id'));

                if($checkVolExist){

                    if (empty($this->post('mobile'))) {
                        $data = array(
                            "success" => "false",
                            "message" => $msg2,
                        );
                    }

                    else if (empty($this->post('whatsapp'))) {
                        $data = array(
                            "success" => "false",
                            "message" => $msg3,
                        );
                    }

                    else{
                        
                        $mobile = $this->input->post('mobile');
                        $whatsapp = $this->input->post('whatsapp');
                        if(!empty($_FILES['image']['name'])){
                            $img_name=time().$_FILES['image']['name'];
                            $img_tmp=$_FILES['image']['tmp_name'];
                            move_uploaded_file($img_tmp, "uploads/".$img_name);
                            $picture2 = $img_name;
                        }else{
                            $picture2 = $this->volunteer_login_model->getPreImage();
                        }

                        $update = array(
                            'vmobile' => $mobile,
                            'whatsapp' => $whatsapp,
                            'profile_pic' => $picture2,
                        );

                        // print_r($update);die;

                        $this->volunteer_login_model->update_user_info($update);
                        $data = array(
                            "success" => "true",
                            "message" => $msg5,
                        );
                    }
                }
                else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg6,
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
