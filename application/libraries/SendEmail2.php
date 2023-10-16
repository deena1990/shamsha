<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendEmail
{
    public $config;
    private $CI;
    function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->library('email');
        $this->config = array(
            'useragent' => 'Shamsaha',
            'protocol' => 'smtp',
            //'smtp_host' => "ssl://mail.shamsaha.org",
            'smtp_host' => "mail.shamsaha.org",
            'smtp_port' => 465,
            'smtp_user' => "info@shamsaha.org",
            'smtp_pass' => "office1234@PC",
            'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            'mailtype' => 'html',
            'smtp_timeout' => '4', //in seconds
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'wordwrap' => true,
        );
        $this->CI->email->initialize($this->config);
    }

    function send($from,$to,$subject,$message,$from_name){

//        echo '<pre>';
//        echo $from."</br>".$to."<br>".$subject."<br>".$message."</br>".$from_name;
//
//        exit;

        $from_name = "Shamsaha";
        $from = "info@thesocialwifi.com";
        $this->CI->email->from($from);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        if (!$this->CI->email->send()) {
            return $this->CI->email->print_debugger();
        } else {   //echo 'Email has been sent successfully';
            return true;
        }
    }
}