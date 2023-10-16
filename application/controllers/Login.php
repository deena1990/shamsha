<?php
/**
 * Author: Firoz Ahmad Likhon <likh.deshi@gmail.com>
 * Website: https://github.com/firoz-ahmad-likhon
 *
 * Copyright (c) 2018 Firoz Ahmad Likhon
 * Released under the MIT license
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a library
    | to conveniently provide its functionality to your applications.
    |
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['auth', 'form_validation']);
    }

    /**
     * handle the login.
     */
    public function index()
    {
        if($this->auth->loginStatus()){
            return redirect('dashboard');
        }
        $data = array();

        if($_POST) {
            $data = $this->auth->login($_POST);
        }

        return $this->auth->showLoginForm($data);
    }

    /**
     * Logout.
     */
    public function logout()
    {
        if($this->auth->logout())
            return redirect('login');

        return false;
    }
}
