<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        // Load member model
        $this->load->model('member');
        
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load file helper
        $this->load->helper('file');
    }
    
    public function index(){
        $data = array();
        
        // Get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        
        // Get rows
        $data['resourcelist'] = $this->member->getRows();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Resource';

        // Load the list page view
        $this->load->view('header', $data);
        $this->load->view('resourcelist', $data);
        $this->load->view('user_footer');
    }

    function importt(){
        $file = $_FILES['country_data']['tmp_name'];
        $file_name = $_FILES['country_data']['name'];
        $exp = explode('.', $file_name);
        $end = end($exp);

        if($end!="csv")
        {
            return back()->withErrors(['Please choose CSV File Only']);
        }
        $handle = fopen($file, "r");
        $c = 0;//
        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
            if($c<>0)
            { 
                
                $insertData = array(
                                    'en_country_name'=>strtolower(trim($filesop[0])),
                                    'zh_country_name'=>strtolower(trim($filesop[1])),
                                    'country_code'=>$filesop[2],
                                    'currency_name'=>$filesop[3],
                                    'currency_code'=>$filesop[4],
                                    'currency_symbol'=>trim($filesop[5]),
                                    'lang'=>$filesop[6],
                                    'country_flag'=>strtolower(trim($filesop[7]))
                        
                                );
                $query =  DB::table('tbl_country_database')->where(['en_country_name'=> trim($filesop[0])]);
                if($query->count()<1)
                {
                    // dd($insertData);

                    DB::table('tbl_country_database')->insert($insertData);
                }
            }

            $c = $c + 1;
        }
    }
    
    public function import(){
        $data = array();
        $memData = array();

        // If import request is submitted
        if($this->input->post('importSubmit')){
            // Form field validation rules
            // $data['excelFile'] = $_FILES['file']['name'];
            // if (empty($_FILES['file']['name'])){
                $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            // }
            // $this->form_validation->set_data($data);

            // print_r($_FILES['file']['name']);die;
            
            // Validate submitted form data
            
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            // echo"<pre>";print_r($row);die;
                            if($row['Category'] != ""){
                                $locId = $this->member->getLocId($row['Location']);
                                $catId = $this->member->getCatId($row['Category'],$locId);
                                // Prepare data for DB insertion
                                $memData = array(
                                    'res_loc_id' => $locId,
                                    'res_res_cat_id' => $catId,
                                    'name' => $row['Name'],
                                    'address_info' => $row['Address'],
                                    'contact_info1' => $row['Contact number 1'],
                                    'contact_info2' => $row['Contact number 2'],
                                    'contact_info3' => $row['Contact number 3'],
                                    'contact_info4' => $row['Contact number 4'],
                                    'timings' => $row['Timings'],
                                    'email_info1' => $row['Email Address 1'],
                                    'email_info2' => $row['Email Address 2'],
                                    'email_info3' => $row['Email Address 3'],
                                    'web_info1' => $row['Web Info 1'],
                                    'web_info2' => $row['Web Info 2'],
                                    'content' => $row['Services'],
                                    'status' => 'Active',
                                );
                            
                            // Check whether name with location already exists in the database
                                $con = array(
                                    'where' => array(
                                        'res_loc_id' => $catId,
                                        'res_res_cat_id' => $locId,
                                        'name' => $row['Name'],
                                        'address_info' => $row['Address'],
                                    ),
                                    'returnType' => 'count'
                                );
                                $prevCount = $this->member->getRows($con);
                            
                            
                                if($prevCount > 0){ 
                                    // Update member data
                                    $condition = array( 'res_loc_id' => $catId, 'res_res_cat_id' => $locId, 'name' => $row['Name'], 'address_info' => $row['Address']);
                                    $update = $this->member->update($memData, $condition);
                                    if($update){
                                        $updateCount++;
                                    }
                                }else{
                                    // Insert member data
                                    $insert = $this->member->insert($memData);
                                    
                                    if($insert){
                                        $insertCount++;
                                    }
                                }
                            }
                        }
                        
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        // $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $successMsg = 'Resource Data imported successfully. | Added ('.$insertCount.') | Updated ('.$updateCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('resource/allresource');
    }
    
    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
}