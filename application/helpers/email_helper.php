<?php

if(! function_exists("ci_send_email")) {
    function ci_send_email($from,$to,$subject,$message) {
        $CI =& get_instance();
        $CI->load->library('email');
        $config = array();
        $config['useragent'] = "Shamsaha";
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "shamsaha.org";
        $config['smtp_user'] = "email@shamsaha.org";
        $config['smtp_pass'] = "Miup693?";
		//$config['smtp_host'] = "ssl://vserver198.3essentials.com";
		//$config['smtp_user'] = "test@shamsaha.org";
		//$config['smtp_pass'] = "_rrE!J~c5U2Q";
        $config['smtp_port'] = "465";
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = true;
        $CI->email->initialize($config);
        $system_name = "Shamsaha";
        //$from = "test@shamsaha.org";
        $CI->email->from($from, $system_name);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        if($CI->email->send()){
            return "success";
        }
        else{
            return $CI->email->print_debugger();
        }
    }
}
