<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('apis/payment_model');
        $this->load->model('apis/sponser_model');
    }

    public function index()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $type = $this->input->post('type', true);
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $phone = $this->input->post('phone', true);
            $address = $this->input->post('address', true);
            $amount = $this->input->post('amount', true);
            $payType = $this->input->post('payType', true);
            $cattype = $this->input->post('cattype', true);
            $company = $this->input->post('company', true);
            $memo = $this->input->post('memo', true);
            $qty = $this->input->post('quantity', true);

            $data = array(
                'type' => $type,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'amount' => $amount,
                'payType' => $payType,
                'cattype' => $cattype,
                'company' => $company,
                'memo' => $memo,
            );
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
            $this->form_validation->set_rules('payType', 'Payment Type', 'required');
            if ($cattype == "corp")
            {
                $this->form_validation->set_rules('company', 'Company', 'required');
            }
            if ($cattype == "ind_gen")
            {
                $this->form_validation->set_rules('memo', 'Memo', 'required');
            }

            if ($this->form_validation->run() == false)
            {
                echo validation_errors();
            }
            else
            {
                if ($payType == "credit")
                {
                    $paymentchannel = "BHOGAUBCC"; /* kwknetonedc for knet */
                }
                if ($payType == "debit")
                {
                    $paymentchannel = "BHBENEFITDC"; /* kwknetonedc for knet */
                }

                $isysid = rand(1, 9).time() . rand(10, 99); /* Must be a unique number (atleast 12) for each request*/
                //$amount = "0.010";
                $description = 'Test';
                $description2 = "more details you need to include";
                $tunnel = "isys";
                $currency = "BHD";
                $language = "EN";
                $country = "BH";
                $merchant_name = "Shamsaha";
                $akey = "dizhQwEBgVhzcDg6";
                $timestamp = time();
                $rnd = "";
                $original = "vT9UGwC08nBaSoEjmEGpBmiQx3M84MLW7hPr3K5iiPA=";
                $msisdn = $phone;

                $dataToComputeHash = $paymentchannel . "paymentchannel" . $isysid . "isysid" . $amount . "amount" . $timestamp . "timestamp" . $description . "description" . $rnd . "rnd" . $original . "original" . $msisdn . "msisdn" . $currency . "currency" . $tunnel . "tunnel";

                $decryptedOriginal = "XuCESt3ThDt6JQiG";

                $hash = strtoupper(hash_hmac("sha256", $dataToComputeHash, $decryptedOriginal));
                //print($hash."\n");
                /* the redirect url to receive payment notification */
                $merchantResponseUrl = site_url()."apis/payment/return";

                /* payit checkout payment host */
                $host = "https://pay-it.mobi/globalpayit/pciglobal/WebForms/payitcheckoutservice2.aspx";

                /* Construct the url with parameters */
                $data['url'] = $host . "?country=" . $country . "&paymentchannel=" . $paymentchannel . "&isysid=" . $isysid . "&amount=" . $amount . "&tunnel=" . $tunnel . "&description=" . urlencode($description) . "&description2=" . urlencode($description2) . "&currency=" . $currency . "&Responseurl=" . $merchantResponseUrl . "&merchant_name=" . $merchant_name . "&akey=" . $akey . "&hash=" . $hash . "&original=" . $original . "&timestamp=" . $timestamp . "&msisdn=" . $msisdn . "&rnd=" . $rnd;

            
                    $data['payType'] = $payType;
                    $data['paymentchannel'] = $paymentchannel;
                    $data['isysid'] = $isysid;
                    $data['description'] = $description;
                    $data['description2'] = $description2;
                    $data['tunnel'] = $tunnel;
                    $data['currency'] = $currency;
                    $data['language'] = $language;
                    $data['country'] = $country;
                    $data['merchant_name'] = $merchant_name;
                    $data['akey'] = $akey;
                    $data['timestamp'] = $timestamp;
                    $data['rnd'] = $rnd;
                    $data['original'] = $original;
                    $data['msisdn'] = $msisdn;
                    $data['dataToComputeHash'] = $dataToComputeHash;
                    $data['decryptedOriginal'] = $decryptedOriginal;
                    $data['hash'] = $hash;
                    
                    $result = $this->payment_model->add_payment($data);
                    if($result == "success"){
                        $user=array(
                            'name' => $name,
                            'email' => $email,
                            'mobile' => $phone,
                            'address' => $address,
                            'quantity' => $qty,
                            'stype' => $cattype,
                            'category' => $type,
                            'company_name' => $company,
                            'price'  => $amount,
                            'payment_type' => $payType,
                            'status' => 'Active',
                            'transaction_id' => $isysid,
                            'memo' => $memo,
                        );
                        $register_user = $this->sponser_model->coorporate_sponser($user);
                        $insert_id = $this->db->insert_id();
                        $aa = $this->sponser_model->update_sponserid_entry($insert_id);
                        $this->load->view('webviews/payment', $data);
                    }
                    else{
                        echo "Something went wrong, Please try after sometimes!!";
                    }
            }
            
            
        }
        else{
           echo "Something went wrong, Please try after sometimes!!";
        }

    }
    
     public function return()
     {
         if ($this->input->server('REQUEST_METHOD') == 'GET'){
            $data = [];
            if(!empty($_GET)){
                $data = $this->input->get();
                $result = $this->payment_model->update_payment($data);
                
                if($result == "success"){
                    $this->load->view('webviews/return', $data);
                }
                else{
                   echo "Something went wrong, Please try after sometimes!!";
                }
                
            }
           
         }
         
     }

}

