<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends CI_Controller
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
        $this->load->model('cases_model');
        $this->load->library('auth');
        $this->load->helper('csv');
        $this->load->helper('email');
    }
    
    function validate_email($str)
    {
        $field_value = $str; //this is redundant, but it's to show you how

        if($this->volunteer_model->email_validation($field_value) == '0')
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function add()
    {
        if( can('add-volunteer') ) {
            if ($this->input->post('insert')) {
                $data['vname'] = $this->input->post('name');
                $data['vemail'] = $this->input->post('email');
                $data['vmobile'] = $this->input->post('mobile');
                $data['whatsapp'] = $this->input->post('whatsapp');
                $data['address'] = $this->input->post('address');
                $data['residence'] = $this->input->post('residence');
                $data['nationality'] = $this->input->post('nationality');
                $data['date_of_birth'] = ($this->input->post('dob')) ? date("Y-m-d", strtotime($this->input->post('dob'))) : "";
                $data['date_of_joining'] = ($this->input->post('dob')) ? date("Y-m-d", strtotime($this->input->post('doj'))) : "";
                $data['passport_r_cpr'] = $this->input->post('passport_r_cpr');
                $data['shift_language'] = $this->input->post('slanguage');
                $data['language_known'] = $this->input->post('language');
                $data['profile_pic'] = $this->input->post('profile_pic');
                $data['status'] = $this->input->post('status');
                $data['emergency_contact'] = $this->input->post('emergency_contact');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('vname', 'Name', 'trim|required');
                $this->form_validation->set_rules('vemail', 'Email', 'trim|required|valid_email|callback_validate_email',array('validate_email' => 'The %s is already taken'));
                $this->form_validation->set_rules('vmobile', 'Mobile', 'trim|required');
                $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('residence', 'Residence', 'trim|required');
                $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
                $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required');
                $this->form_validation->set_rules('date_of_joining', 'Date of joining', 'trim|required');
                $this->form_validation->set_rules('passport_r_cpr', 'Passport / CPR', 'trim|required');
                $this->form_validation->set_rules('shift_language', 'Shift Language', 'trim|required');
                $this->form_validation->set_rules('language_known', 'Language Known', 'trim|required');

                $imgVal = true;
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                $config['file_name'] = $_FILES['profile_pic']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!empty($_FILES['profile_pic']['name'])) {

                    if ($this->upload->do_upload('profile_pic')) {
                        $uploadData = $this->upload->data();
                        $picture = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'profile_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                        //return false;
                    }
                } else {
                    $picture = 'no-image.png';
                }

                if (!empty($_FILES['cpr_pic']['name'])) {

                    if ($this->upload->do_upload('cpr_pic')) {
                        $uploadData = $this->upload->data();
                        $picture1 = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'cpr_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                    }
                } else {
                    $picture1 = 'no-image.png';
                }

                if (!empty($_FILES['cpr_back_pic']['name'])) {

                    if ($this->upload->do_upload('cpr_back_pic')) {
                        $uploadData = $this->upload->data();
                        $picture4 = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'cpr_back_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                    }
                } else {
                    $picture4 = 'no-image.png';
                }
                if (!empty($_FILES['passport_pic']['name'])) {

                    if ($this->upload->do_upload('passport_pic')) {
                        $uploadData = $this->upload->data();
                        $ppicture = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'passport_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                    }
                } else {
                    $ppicture = 'no-image.png';
                }
                if (($this->form_validation->run() == true) && ($imgVal) ) {
                    $url = base_url();
                    $data['profile_pic'] = $picture;
                    $data['cpr_pic'] = $picture1;
                    $data['cpr_back_pic'] = $picture4;
                    $data['passport_pic'] = $ppicture;
                    $length = 8;
                    $password = substr(str_shuffle("1234567890QWERTYUIOP$@#!=_)(*123456789012345602345ABCDEFGHIJK$@#!=_)(*LM0987654321NOPQRSTUVWXYZ"), 0, $length);
                    $data['vpassword'] = $password;
                    $data['password_login_first'] = "Yes";
                    $this->volunteer_model->add_user($data);
                    $insert_id = $this->db->insert_id();
                    $aa = $this->volunteer_model->update_userid_entry($insert_id);
                    $from = "priyanka@sayg.bh";
                    $to = $data['vemail'];

                    $subject = 'Welcome to Shamsaha Application';
                    $message = "<html><body><h2>User Login Credentails</h2>
      <p>Email: $to</p>
      <p>Password: $password</p>
  </body></html>";

                    $from_name = "Shamsaha";

                    //$this->load->library('SendEmail');
                    //$emailsend = $this->sendemail->send($from,$to,$subject,$message,$from_name);
                    $emailsend = ci_send_email("info@shamsaha.org",$to,$subject,$message);
                    if($emailsend == "success"){
                        $this->session->set_flashdata('msg', "Volunteer has been added successfully");
                    }
                    else{

                    }

                    $base_url = base_url();
                    redirect("$base_url" . "volunteer/add/");
                }
                else{
                    $data['error'] = validation_errors();
                    //print_r(validation_errors()); exit;
                }

            }
            $lname = [];
            $languageList = $this->volunteer_model->get_language();
            foreach ($languageList as $key) {
                $lname[] = $key->lname;
            }
            $data['language'] = $lname;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Volunteer'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('volunteer');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission Denied!!";
        }

    }

    public function check_customer($email)
    {
        $query = $this->db->where('vemail', $email)->get("wc_voulnteer");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_customer', 'The ' . $email . ' belongs to an existing account');
            return FALSE;
        } else
            return TRUE;
    }

    function alluser()
    {
        if( can('view-volunteer') ) {
            $data['caselist'] = $this->cases_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Cases'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('caselist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function cpassword($id)
    {
        if( can('change-password-volunteer') ) {
            if ($this->input->post('update')) {
                $user = array('vpassword' => $this->input->post('new_pass'));
                $this->volunteer_model->update_entry_password($user, $id);
                $this->session->set_flashdata('msg', "volunteer Password has been updated");
                $base_url = base_url();
                redirect("$base_url" . "volunteer/alluser");
            }
            $data['user'] = $this->volunteer_model->get($id);
            //print_r($data['user']);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Volunteers'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('edit-volunteer-password', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function edit($id)
    {
        if( can('edit-volunteer') ) {
            $user = $this->volunteer_model->get_row($id);
            if ($this->input->post('update')) {
                $url = base_url();
                $data['vname'] = $this->input->post('name');
                $data['vemail'] = $this->input->post('email');
                $data['vmobile'] = $this->input->post('mobile');
                $data['whatsapp'] = $this->input->post('whatsapp');
                $data['address'] = $this->input->post('address');
                $data['residence'] = $this->input->post('residence');
                $data['nationality'] = $this->input->post('nationality');
                $data['date_of_birth'] = ($this->input->post('dob')) ? date("Y-m-d", strtotime($this->input->post('dob'))) : "";
                $data['date_of_joining'] = ($this->input->post('dob')) ? date("Y-m-d", strtotime($this->input->post('doj'))) : "";
                $data['passport_r_cpr'] = $this->input->post('passport_r_cpr');
                $data['shift_language'] = $this->input->post('slanguage');
                $data['language_known'] = $this->input->post('language');
                $data['profile_pic'] = $this->input->post('profile_pic');
                $data['status'] = $this->input->post('status');
                $data['total_rewards'] = $this->input->post('total_rewards');
                $data['wc_vid'] = $id;
                $data['emergency_contact'] = $this->input->post('emergency_contact');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('vname', 'Name', 'trim|required');
                $this->form_validation->set_rules('vemail','Email','required|valid_email|edit_unique[wc_voulnteer.vemail.wc_vid.'.$id.']', array('edit_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('vmobile', 'Mobile', 'trim|required');
                $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('residence', 'Residence', 'trim|required');
                $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
                $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required');
                $this->form_validation->set_rules('date_of_joining', 'Date of joining', 'trim|required');
                $this->form_validation->set_rules('passport_r_cpr', 'Passport / CPR', 'trim|required');
                $this->form_validation->set_rules('shift_language', 'Shift Language', 'trim|required');
                $this->form_validation->set_rules('language_known', 'Language Known', 'trim|required');

                $imgVal = true;
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                $config['file_name'] = $_FILES['profile_pic']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!empty($_FILES['profile_pic']['name'])) {

                    if ($this->upload->do_upload('profile_pic')) {
                        $uploadData = $this->upload->data();
                        $picture = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'profile_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                        //return false;
                    }
                } else {
                    $picture = $user->profile_pic;
                }

                if (!empty($_FILES['cpr_pic']['name'])) {

                    if ($this->upload->do_upload('cpr_pic')) {
                        $uploadData = $this->upload->data();
                        $picture1 = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'cpr_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                    }
                } else {
                    $picture1 = $user->cpr_pic;
                }

                if (!empty($_FILES['cpr_back_pic']['name'])) {

                    if ($this->upload->do_upload('cpr_back_pic')) {
                        $uploadData = $this->upload->data();
                        $picture4 = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'cpr_back_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                    }
                } else {
                    $picture4 = $user->cpr_back_pic;
                }
                if (!empty($_FILES['passport_pic']['name'])) {

                    if ($this->upload->do_upload('passport_pic')) {
                        $uploadData = $this->upload->data();
                        $ppicture = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'passport_pic_error', $this->upload->display_errors() );
                        $imgVal = false;
                    }
                } else {
                    $ppicture = $user->passport_pic;
                }
                if (($this->form_validation->run() == true) && ($imgVal) ) {

                    $data['profile_pic'] =  $picture;
                    $data['cpr_pic'] = $picture1;
                    $data['cpr_back_pic'] =  $picture4;
                    $data['passport_pic'] = $ppicture;

                    $update = $this->volunteer_model->update_entry($data,$id);
                    if($update){
                        $this->session->set_flashdata('msg', "Volunteer has been added successfully");
                        $base_url = base_url();
                        redirect("$base_url" . "volunteer/view/".$id);
                    }
                }
                else{
                    $data['error'] = validation_errors();
                    //print_r(validation_errors()); exit;
                }

            }
            $lname = [];
            $languageList = $this->volunteer_model->get_language();
            foreach ($languageList as $key) {
                $lname[] = $key->lname;
            }
            $data['user'] = $user;
            $data['language'] = $lname;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Volunteers'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('editvolunteer', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function view($id){
        if( can('view-volunteer') ) {
            $data['casedetail'] = $this->cases_model->get_row($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Cases'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('viewcase', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function delete($id)
    {
        if( can('delete-volunteer') ) {
            if($this->volunteer_model->delete_entry($id)){
                $this->session->set_flashdata('msg', "volunteer has been deleted successfully");
            }

            redirect(site_url() . "volunteer/alluser");
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
            $volunteerData = $this->volunteer_model->getRows($_POST);

            $i = $_POST['start'];
            foreach ($volunteerData as $volunteer) {
                $i++;
                $data[] = array("", $volunteer->vounter_id, $volunteer->vname, $volunteer->shift_language, $volunteer->vemail, $volunteer->vmobile, $volunteer->whatsapp, $volunteer->total_rewards, $volunteer->status, $volunteer->wc_vid);
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->volunteer_model->countAll(),
                "recordsFiltered" => $this->volunteer_model->countFiltered($_POST),
                "data" => $data,
            );

            // Output to JSON format
            echo json_encode($output);
        }
        else{
            echo "Permission denied";
        }

    }
    
    public function downloadVolunteer(){
        $data = $this->volunteer_model->get_entries();
        $list[] = array('Volunteer Id', 'Name', 'Email', 'Mobile', 'WhatsApp', 'Emergency Contact', 'Address','Passport/CPR','Date of Birth', 'Date of Joining', 'Shift Language', 'Languages Known', 'Total Rewards', 'Created On');
        if(!empty($data)){
            foreach ($data as $volunteer){
                $list[] = array(
                    $volunteer->vounter_id,
                    $volunteer->vname,
                    $volunteer->vemail,
                    $volunteer->vmobile,
                    $volunteer->whatsapp,
                    $volunteer->emergency_contact,
                    $volunteer->address,
                    $volunteer->passport_r_cpr,
                    $volunteer->date_of_birth,
                    $volunteer->date_of_joining,
                    $volunteer->shift_language,
                    $volunteer->language_known,
                    $volunteer->total_rewards,
                    $volunteer->created_at,
                );
            }
        }
        csv_download($list);
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