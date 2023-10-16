<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'fcm/FCM.php';
require FCPATH . '/wok/vendor/autoload.php';
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
class Services extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('apis/services_model');
        //$this->load->library('email');
        $this->load->helper('email');
    }
    public function index(){
        echo "Invalid";
    }
	
	private function getAddress($address){
		$ch = curl_init();
  
		$url = "https://geocode.search.hereapi.com/v1/geocode";
		$dataArray = [
			"q" => $address,
			"apiKey" => "BmuWnNnaNTsi8zKMGQZANDE2biXwohGDJFX3xp8OtP8"
		];

		$data = http_build_query($dataArray);

		$getUrl = $url."?".$data;

		curl_setopt($ch, CURLOPT_URL, $getUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		if(curl_error($ch)){
			//echo 'Request Error:' . curl_error($ch);
			curl_close($ch);
			return false;
		}else{
			//echo $response;
			curl_close($ch);
			return $response;
		}
    }
	
	public function bahrainlist(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$exact = json_decode($this->input->post('start', true));
			$place = json_decode($this->input->post('end', true));
			$data = array(
					"waypoints"=>[
						array(
							"exactLatLng"=>array(
								"lat"=>$exact->lat,
								"lng"=>$exact->lng
							),
							"placeLatLng"=>array(
								"lat"=>$place->lat,
								"lng"=>$place->lng
							)
						)
					],
					"extraOptions"=>[],
					"client"=>array(
						"clientId"=>"40c94038-f438-4ca3-aa65-2c1b5b527cf2",
						"name"=>"Shamsasa",
						"phone"=>$this->input->post('mobile', true),
						"imageUrl"=>"https://shamsaha.com/wp-content/uploads/2020/11/shas-100x100.jpeg"
					),
					"notes"=>"Test Shamsaha",
					"unitOfLength"=>"KILOMETER",
					"vehicleType"=>"CLASSIC",
					"tariffType"=>"PRECISE",
					"paymentMethods"=>["THIRD_PARTY"],
					"prepaid"=>false
			);

			$postdata = json_encode($data);

			$ch = curl_init("https://api.onde.app/dispatch/v1/order/"); 
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Authorization: 423d7814-6778-4fa0-b8fd-d4a213abf41d'
			));
			$result = curl_exec($ch);
			curl_close($ch);
			//print_r ($result);
			header('Content-Type: application/json');
    		echo json_encode( array(
				"status"=>true,
				"exact"=>$exact,
				"place"=>$place,
				"message"=>"Success"
			) );
		}else{
			header('Content-Type: application/json');
    		echo json_encode( array(
				"status"=>false,
				"message"=>"ERROR :Wrong Request"
			) );
			
		}
	}
	
	public function bahrainTaxi(){
		$id = $this->input->get('volunteer_id', true);
        $case_id = $this->input->get('case_id', true);
		//check get Parameters
		
		if(!isset($id)||!isset($case_id)){
			$this->session->set_flashdata('messageBool', true);
			$this->session->set_flashdata('message', 'Volunteer Id or Case Id missing!');
			$this->load->view('webviews/bahrain-taxi');
			return;
		}
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			$this->session->set_flashdata('messageBool', true);

            $data = array(
				'bstart'=> $this->input->post('bstart', true),
				'rstart'=> $this->input->post('rstart', true),
				'astart'=> $this->input->post('astart', true),
				'bend'=> $this->input->post('bend', true),
				'rend'=> $this->input->post('rend', true),
				'aend'=> $this->input->post('aend', true),
				'country'=> $this->input->post('country', true),
                'phone' => $this->input->post('phone', true),
                'volunteer_id' => $id,
                'case_id' => $case_id
            );
            $this->form_validation->set_data($data);
			$this->form_validation->set_rules('bstart', 'Building No', 'required');
			$this->form_validation->set_rules('rstart', 'Road No', 'required');
			$this->form_validation->set_rules('astart', 'Area/Block No', 'required');
			$this->form_validation->set_rules('bend', 'Building No', 'required');
			$this->form_validation->set_rules('rend', 'Road No', 'required');
			$this->form_validation->set_rules('aend', 'Area/Block No', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('volunteer_id', 'Volunteer_id', 'required');
            $this->form_validation->set_rules('case_id', 'Case_id', 'required');
			
			 if ($this->form_validation->run() == false){
                //print_r(validation_errors()); 
				//echo "<script>alert(".validation_errors().")</script>";
				 $this->session->set_flashdata('message', 'Invalid from data!');
                 $data['error'] = validation_errors();
            }else{
				 $responsesData=array(
				 	"startAddresses"=>array(),
				 	"endAddresses"=>array(),
					"mobile"=>$data["phone"]
				 );
				 
				 $a1 = $this->getAddress("Building ".$data["bstart"].", Road ".$data["rstart"].", ".$data["astart"].", ".$data["country"]."");
				 $a2 = $this->getAddress("Building ".$data["bend"].", Road ".$data["rend"].", ".$data["aend"].", ".$data["country"]."");
				 
				 if($a1 && $a2){
					 
					 $this->session->set_flashdata('message', 'Submitted successfully!');
					 
					 $a1decoded = json_decode($a1,true);
					 $a2decoded = json_decode($a2,true);
					 
					 $a1Results = count($a1decoded["items"]);
					 $a2Results = count($a2decoded["items"]);
					 
					 if( $a1Results==0){
						 $this->session->set_flashdata('message', 'Wrong data for start address!');
						 $this->load->view('webviews/bahrain-taxi');
						 return;
					 }
					 if($a2Results==0){
					 	$this->session->set_flashdata('message', 'Wrong data for end address!');
						 $this->load->view('webviews/bahrain-taxi');
						 return;
					 }
					 
					 $responsesData["startAddresses"]=$a1;
					 $responsesData["endAddresses"]=$a2;
					 //print_r($responsesData);
					 $this->session->set_flashdata('message', 'Choose correct address!');
					 $this->load->view('webviews/bahrain-list',$responsesData);
					 return;
				 }else{
					 if(!$a1 && !$a2){
						 $this->session->set_flashdata('message', 'Failed to retrieve addresses!');
					 }
					 if(!$a1){
						 $this->session->set_flashdata('message', 'Failed to retrieve start address!');
					 }else{
						 $this->session->set_flashdata('message', 'Failed to retrieve end address!');
					 }
				 }
			}
			$this->load->view('webviews/bahrain-taxi');
		}else{
			$this->session->set_flashdata('messageBool', false);
			$this->load->view('webviews/bahrain-taxi');
		}
	}
    
    public function ramada(){
        $id = $this->input->get('volunteer_id', true);
        $case_id = $this->input->get('case_id', true);
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $victim_name = $this->input->post('victim_name', true);
            $victim_mobile = $this->input->post('victim_mobile', true);
			$cpr_id = $this->input->post('CPR/ID', true);
			$victim_email = $this->input->post('victim_email', true);
			$smoking = $this->input->post('smoking', true);
			$breakfast = $this->input->post('breakfast', true);
            $booking_date = date("Y-m-d", strtotime($this->input->post('booking_date', true)));
            $no_of_rooms = $this->input->post('no_of_rooms', true);
            $volunteer_id = $id;

            $data = array(
                'victim_name' => $victim_name,
				'cpr_id' => $cpr_id ,
				'victim_email' => $victim_email,
				'smoking' => $smoking,
				'breakfast' => $breakfast,
                'victim_mobile' => $victim_mobile,
                'booking_date' => $booking_date,
                'no_of_rooms' => $no_of_rooms,
                'volunteer_id' => $volunteer_id,
                'case_id' => $case_id
            );
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('victim_name', 'Name', 'required');
            $this->form_validation->set_rules('booking_date', 'Date', 'required');
            $this->form_validation->set_rules('no_of_rooms', 'No of Rooms', 'required|numeric');
            $this->form_validation->set_rules('volunteer_id', 'Volunteer Id', 'required');
            $this->form_validation->set_rules('cpr_id', 'CPR/id', 'required');
			$this->form_validation->set_rules('victim_email', 'email', 'required');
			$this->form_validation->set_rules('smoking', 'Smoking', 'required');
			$this->form_validation->set_rules('breakfast', 'Breakfast', 'required');
            
            if ($this->form_validation->run() == false)
            {
                print_r(validation_errors()); 
				//echo "<script>alert(".validation_errors().")</script>";
                 $data['error'] = validation_errors();
            }
            else{
                 $result = $this->services_model->book_ramada($data);
                    if($result == "failure"){
                       echo "Something went wrong, Please try after sometimes!";
                    }
                    else{
                        //$booking_data['booking_date'] = $booking_date;
                        //$booking_data['no_of_rooms'] = $no_of_rooms;
                        $data['url'] = site_url()."apis/services/ramada_confirmation/".$result;
                        
                        $message = $this->load->view('webviews/ramada-email', $data, TRUE);
                        //echo $message; exit;
                        $sendemail = ci_send_email("hotel@shamsaha.org","reservations@ramadabahrain.com","Shamsaha Booking Request",$message);
						$sendemail = ci_send_email("hotel@shamsaha.org","sales2@ramadabahrain.com","Shamsaha Booking Request",$message);
						$sendemail = ci_send_email("hotel@shamsaha.org","GM@ramadabahrain.com","Shamsaha Booking Request",$message);
						$sendemail = ci_send_email("hotel@shamsaha.org","info@shamsaha.org","Shamsaha Booking Request",$message);
                        if($sendemail == "success"){
                             $this->session->set_flashdata('message', 'Submitted Successfully');
                             redirect(current_url());
                        }
                        else{
                            $this->session->set_flashdata('message', 'Mail not send');
                        }
                        
                        
                    }
            }
        }
        $this->load->view('webviews/services-ramada');
    }
    
//     function ramada_confirmation($id){
//         $data['id'] = $id;
//          $result = $this->services_model->update_ramada($data);
         		 
//          if($result){
//              $regId ="d_M_FJbLS--uBstsb4gv0X:APA91bFhV5RI7YiZVbMWcI8LUITe6_yVx-hgpcXGVAk98r1jJFtbwhwSG-EK2Oq8n4J5aMbDLH7UnZvEF0FX0wzXNPTR785ALirYMd628fp_xkkAMYI3XuI_dmHYUl60Ll6j0nzxj4z_";
 
 
 
// $notification = array();
// $arrNotification= array();			
// $arrData = array();											
// $arrNotification["body"] ="Events got added";
// $arrNotification["title"] = "Events are Out";
// $arrNotification["sound"] = "default";
// $arrNotification["type"] = 1;
 
// $fcm = new FCM();
// $result = $fcm->send_notification($regId, $arrNotification,"Android");
// print_r($result); exit;
//              $this->load->view('webviews/ramada-confirmation');
//          }
        
        
//     }

    function ramada_confirmation($id){
        $data['id'] = $id;
         $result = $this->services_model->update_ramada($data);
         if($result){
             $detail = $this->services_model->get_volunteer_detail($data);
             //print_r($detail); exit;
             /*$regId = $detail->vol_token_id;
             $notification = array();
             $arrNotification= array();
             $arrData = array();
             $arrNotification["body"] ="Events got added";
             $arrNotification["title"] = "Events are Out";
             $arrNotification["sound"] = "default";
             $arrNotification["type"] = 1;

             $fcm = new FCM();
             $result = $fcm->send_notification($regId, $arrNotification,$detail->device);*/
             $this->load->view('webviews/ramada-confirmation');
         }
         else{
            return show_404();
         }
    }
    
    // function sendEmail($to,$subject,$message){
    // 		$config = array();
    // 		$config['useragent'] = "Shamsaha";
    // 		$config['protocol'] = "smtp";
    // 		$config['smtp_host'] = "ssl://vserver198.3essentials.com";
    // 		$config['smtp_user'] = "test@shamsaha.org";
    // 		$config['smtp_pass'] = "_rrE!J~c5U2Q";
    // 		$config['smtp_port'] = "465";
    // 		$config['mailtype'] = 'html';
    // 		$config['charset'] = 'utf-8';
    // 		$config['newline'] = "\r\n";
    // 		$config['wordwrap'] = true;
    // 		$this->email->initialize($config);
    // 		$from = $this->config->item('smtp_user');
    //         $system_name = "Shamsaha";
    //       	$from = "test@shamsaha.org";
    //       	$this->email->from($from, $system_name);
    //         $this->email->to($to);
    // 	    $this->email->subject($subject);
    // 	    $this->email->message($message);
    // 	    if($this->email->send()){
    // 	        return "success";
    // 	    }
    // 	    else{
    // 	        return $this->email->print_debugger();
    // 	    }
    	     
    // }


    public function wokstation(){
        $url = "https://wokstationme.com";
        $ck = "ck_a641759dec8c2a209a8460079687005d538683e8";
        $cs = "cs_88365aa051549febed70633a1e0a00a6ce37c5f0";
        $options = array('version' => 'wc/v3','timeout' => 600,'query_string_auth' => true);
        $woocommerce = new Client($url, $ck, $cs, $options);
        $params = array('category' => 68);

        $data['volunteer_id'] = $this->input->get('volunteer_id', true);
        $data['case_id'] = $this->input->get('case_id', true);
        $data['products'] = $woocommerce->get('products', $params);
//        echo "<pre>";
//        print_r($data['products']); exit;
        $this->load->view('webviews/wok-station', $data);
    }

    public function order(){
        //return ;
        //set_time_limit(0);
       	$product =  $this->input->post('products', true);
      	//print_r($_POST); exit;
        $url = "https://wokstationme.com";
        $ck = "ck_a641759dec8c2a209a8460079687005d538683e8";
        $cs = "cs_88365aa051549febed70633a1e0a00a6ce37c5f0";
        $options = array('version' => 'wc/v3','timeout' => 600,'query_string_auth' => true);
        $woocommerce = new Client($url, $ck, $cs, $options);
        $data = [
            'customer_id' => '42',
            'payment_method' => 'bacs',
            'payment_method_title' => 'Direct Bank Transfer',
            'set_paid' => true,
            'billing' => [
                'first_name' => 'Shamsaha',
                'address_1' => 'Manama',
                'city' => 'Manama',
                'country' => 'BH',
                'email' => 'admin@shamsaha.com',
                'phone' => "78965896"
            ],
            'shipping' => [
                'first_name' => $this->input->post('first_name', true),
                'last_name' => $this->input->post('last_name', true),
                'address_1' => $this->input->post('address', true).", \nArea : ".$this->input->post('area', true).",\n Block : ".$this->input->post('block', true)." \nPhone : ".$this->input->post('phone', true),
                'country' => 'BH'
            ],
            'line_items' =>  $product
        ];
		//print_r(['line_items' =>  $product]);
        print_r($woocommerce->post('orders', $data));
        echo  json_encode($product); exit;
    }

}

