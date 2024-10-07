<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property input $input
 * @property Topic_model $topic_model
 * @property form_validation $form_validation
 * @property upload $upload
 * @property session $session
 * @property config $config
 * @property usertbl_model $usertbl_model
 */

class Auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    function login(){
        $this->_head();
        $this->load->view('login', array('returnURL'=>$this->input->get('returnURL')));
        $this->load->view('footer');
    }

    function _head(){
        $this->load->view('head');
    }
    function authentication(){
        $this->load->model('usertbl_model');
        $user = $this->usertbl_model->GetByEmail(array('email'=>$this->input->post('email')));
        if(
            $_POST['email'] == $user->email &&
            password_verify($_POST['password'],$user->password)
        ) {
            $this->session->set_userdata('is_login', true);
            $this->load->helper('url');
            $returnURL = $this->input->get('returnURL');
            if(empty($returnURL)){
                redirect('topic/');
            } else {
                redirect($returnURL);
            }
            
        } else {
            echo 'fail';
            $this->session->set_flashdata('message','로그인에 실패 했습니다.');
            $this->load->helper('url');
            redirect('/auth/login');
        }
    }
    function logout(){
        $this->session->sess_destroy();
        $this->load->helper('url');
        redirect('/topic');
    }
    function signin(){
        $this->_head();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', '이메일 주소', 'required|valid_email|is_unique[usertbl.email]');
        $this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[re_password]');
        $this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');
        
        if($this->form_validation->run() === false){
            $this->load->view('signin');
        } else {
            $this->load->model('usertbl_model');
            $this->usertbl_model->add(array(
                'email'=>$this->input->post('email'),
                'password'=>password_hash($this->input->post('password'),PASSWORD_BCRYPT),
                'nickname'=>$this->input->post('nickname')
            ));
            $this->session->set_flashdata('message', '회원가입에 성공했습니다.');
            $this->load->helper('url');
            redirect('/topic');
        }
        
        $this->load->view('footer');
    }
}