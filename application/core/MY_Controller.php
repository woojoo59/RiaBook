<?php
/**
 * @property input $input
 * @property Topic_model $topic_model
 * @property form_validation $form_validation
 * @property upload $upload
 * @property session $session
 * @property config $config
 * @property usertbl_model $usertbl_model
 */

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        if(!$this->input->is_cli_request())
            $this->load->library('session');
    }

    function _head(){
        $this->load->config('opentutorials');
        $this->load->view('head');
    }

    function _footer(){
        $this->load->view('footer');
    }

}