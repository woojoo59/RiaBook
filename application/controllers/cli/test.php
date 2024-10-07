<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Test extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }
    function _head(){
        $this->load->view('head');
        $this->load->helper(array('url', 'HTML', 'korean')); //헬퍼 사용법
    }
    function index(){

        // setcookie('ck_name', '하리보', time()+10 ,'../');
        // setcookie('ck_name1', '콜롬보', time()+240 ,'../');

        $this->load->view('test');

    }
}