<?php
class Feedback extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('feedback_model');
        $this->load->library('auth');
    }

    public function index(){
        if( can('view-volunteer') ) {
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Feedback'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('feedback/index', $data);
            $this->load->view('user_footer');
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
            $feedbackData = $this->feedback_model->getRows($_POST);

            $i = $_POST['start'];
            foreach ($feedbackData as $feedback) {
                $i++;
                $data[] = array("", $feedback->case_id, $feedback->volunteer_id, date('d M Y H:i:s', strtotime($feedback->created_at)), $feedback->id);
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->feedback_model->countAll(),
                "recordsFiltered" => $this->feedback_model->countFiltered($_POST),
                "data" => $data,
            );

            // Output to JSON format
            echo json_encode($output);
        }
        else{
            echo "Permission denied";
        }

    }

    public function view($id){
        if( can('view-volunteer') ) {
            $data['feedback'] = $this->feedback_model->get($id);
            if(!empty($data['feedback'])){
                $data['site_title'] = 'Admin Dashboard'; //Title
                $data['page_title'] = 'Feedback'; //Page Title
                $data['controller'] = $this;
                $this->load->view('header', $data);
                $this->load->view('feedback/view', $data);
                $this->load->view('user_footer');
            }
            else{
                show_404();
            }
        }
        else{
            echo "Permission denied";
        }
    }

    function starRating($stars)
    {
        $count = 1;
        $result = "";

        for ($i = 1; $i <= 5; $i++) {
            if ($stars >= $count) {
                $result .= "<span style='font-size: 30px;color: #e34587'>&#x2605</span>";
            } else {
                $result .= "<span  style='font-size: 30px;'>&#x2606</span>";
            }
            $count++;

        }
        return $result;
    }

}
