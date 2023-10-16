<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller
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
        $this->load->model('schedule_model');
        $this->load->model('shift_model');

        $this->load->library('FCM');
        $this->load->library('auth');

    }
	
	function send_notification($registatoin_ids, $notification,$device_type) {
		$url = 'https://fcm.googleapis.com/fcm/send';
		//echo $registatoin_ids[0];
		if($device_type == "Android"){
			$fields = array(
				'to' => $registatoin_ids[0],
				'data' => $notification
			);
		} else {
			$fields = array(
				'to' => $registatoin_ids[0],
				'notification' => $notification
			);
		}
		// Firebase API Key
		$headers = array('Authorization:key=AAAApdHl590:APA91bFVCJKCAAKUko7ZFn3jeUTisGxu7UNDeVD3EiZ5KWq7gvaBVUzp_0PAx-mQid4FHQMVXRhSnU8rYfHBWsJJmuytTFYEr3S3-Yt2nUPigOGv7jhS0iE6ZkFfU_o_4j4IyTkwNIx3','Content-Type:application/json');
		//echo print_r($fields);
		//echo print_r($headers);
		// Open connection
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		//echo "result \n";
		//echo $result;
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
	}

    public function add()
    {
        if (can('add-schedule')) {
            if ($this->input->post('submit')) {
                $year = $this->input->post('year');
                $shift = $this->input->post('shift');
                $this->schedule_model->add_schdedule($year);
                $insert_id = $this->db->insert_id();
                $aa = $this->schedule_model->update_scheduleid_entry($insert_id);
                $this->session->set_flashdata('msg', "Schedule has been added successfully");
                $base_url = base_url();
                redirect("$base_url" . "schedule/allschedule");
            }
            $data['shift'] = $this->shift_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Schedule'; //Title
            $this->load->view('header', $data);
            $this->load->view('schedule', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function allschedule1()
    {
        $data['schedulelist'] = $this->schedule_model->get_entries();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Schedule'; //Title
        $this->load->view('header', $data);
        $this->load->view('schedulelist', $data);
        $this->load->view('user_footer');
    }

    function allschedule()
    {
        if (can('view-schedule')) {
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Schedule'; //Title
            $this->load->view('header', $data);
            $this->load->view('schedulecalendar', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function calendardetailview()
    {
        $date = $_GET['date'];
        $data = [];
        if (!empty($date)) {
            $data['date'] = $date;
            $data['schedulelist'] = $this->schedule_model->getScheduleView(date("Y-m-d", strtotime($date)));
            $this->load->view('schedule-calendar-view', $data);
        }

    }

    function volunteerlist()
    {
        $filter = $this->input->get('filter');
        if (!empty($filter)) {
            $data['volunteerlist'] = $this->schedule_model->get_volunteers_by_filter($filter);
            $this->load->view('volunteer-list-schedule', $data);
        }
    }

    function volunteerdetail()
    {
        $id = $this->input->get('id');
        if (!empty($id)) {
            $data['volunteerdetail'] = $this->schedule_model->get_volunteers_detail($id);
            $this->load->view('volunteer-detail', $data);
        }
    }

    function assignvolunteer()
    {
        if (can('assign-schedule')) {
            if ($this->input->post()) {
                $assign = $this->schedule_model->admin_shift_assign();
                if ($assign) {
                    $getSchedule = $this->schedule_model->getschedule_by_id();
                    $arrNotification = array();
                    //$arrNotification["body"] = date('d M Y', strtotime($getSchedule->date))." ". $getSchedule->shift_name."(".$getSchedule->shift_language.") assigned for you";
                     $arrNotification["body"] = "You’ve been assigned a new shift on: ".date('l, d M Y', strtotime($getSchedule->date)).", ".$getSchedule->shift_time." - ".$getSchedule->shift_language. " ".$getSchedule->shift_name;
                    $arrNotification["title"] = "New Shift Assigned!!";
                    $arrNotification["sound"] = "default";
                    $arrNotification["type"] = 1;
                    if(strtolower($getSchedule->device) == "android"){
                        $this->fcm->send_notification($getSchedule->vol_token_id, $arrNotification,'Android',false);
                    }
                    if(strtolower($getSchedule->device) == "ios"){
                        $this->fcm->send_notification($getSchedule->vol_token_id, $arrNotification,'iOS',false);
                    }
                    echo "success";
                    die();
                } else {
                    echo "failed";
                    die();
                }
            } else {
                $id = $_GET['id'];
                $data = [];
                if (!empty($id)) {
                    $schedule = $this->schedule_model->get_schedule_by_id($id);
                    $data['volunteer'] = $this->schedule_model->get_volunteers_by_language($schedule->shift_language);
                    $data['schedule'] = $schedule;
                    $this->load->view('assign-volunteer', $data);
                }
            }
        }
        else{
            echo "Permission denied";
        }
    }

    function allschedule2()
    {
        $result = $this->schedule_model->get_entries1($_GET);
        echo json_encode($result);
    }

    function view($id)
    {
        $data['schedulelist'] = $this->schedule_model->get_entries_by_date($id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Schedule'; //Title
        $this->load->view('header', $data);
        $this->load->view('schedulelistbydate', $data);
        $this->load->view('user_footer');
    }

    function report(){
        if (can('assign-schedule')) {
            if($this->input->post('dateRange')){
                list($startDate, $endDate) = explode(' - ', $_POST['dateRange']);
            }
            else{
                $startDate = date('Y-m-d', strtotime('-30 days'));
                $endDate = date('Y-m-d');
            }
            $data['startDate'] = date('m/d/Y', strtotime($startDate));
            $data['endDate'] = date('m/d/Y', strtotime($endDate));
            $data['report'] = $this->schedule_model->report(date('Y-m-d', strtotime($startDate)), date('Y-m-d', strtotime($endDate)));
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Schedule Report'; //Title

            $this->load->view('header', $data);
            $this->load->view('report', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }


    /*public function edit($id)
      {
                if($this->input->post('submit'))
                {



                    $date = $this->input->post('date');
                  $dt = date("Y-m-d", strtotime($date));

        $user=array('title_en' =>$this->input->post('title_en'),'content_en' =>$this->input->post('content_en'),'title_ar' =>$this->input->post('title_ar'),
        'content_ar' =>$this->input->post('content_ar'), 'date' =>$dt, 'event_pic' => $picture2, 'status' =>$this->input->post('status'));

                    $this->event_model->update_entry($user,$id);
                    $this->session->set_flashdata('msg',"Schedule has been updated successfully");
                    $base_url=base_url();
                    redirect("$base_url"."schedule/allschedule");
                   }
                $data['schedule']=$this->schedule_model->get($id);
                  $data['site_title'] = 'Admin Dashboard'; //Title
                  $this->load->view('header',$data);
                $this->load->view('editschedule',$data);
                $this->load->view('user_footer');
    }
public function delete($id)
    {

       $this->schedule_model->delete_entry($id);
     $this->session->set_flashdata('msg',"Schedule has been deleted successfully");
  $data['schedulelist']=$this->schedule_model->get_entries();
   $data['site_title'] = 'Admin Dashboard'; //Title
            $this->load->view('header',$data);
            $this->load->view('schedulelist',$data);
            $this->load->view('user_footer');
                      
} */

}
