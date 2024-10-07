<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property input $input
 * @property Topic_model $topic_model
 * @property form_validation $form_validation
 * @property upload $upload
 * @property session $session
 * @property usertbl_model $usertbl_model
 * @property email $email
 */

class Topic extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('topic_model');
        log_message('debug', 'topic 초기화');
    }

	public function index()
	{
        $this->_head();
        $this->load->view('main');
        $this->load->view('footer');
	}

    public function get($id){
        log_message('debug', 'get 호출');
        $this->_head();

        $topic = $this->topic_model->get($id);
        //log_message('info', var_export($topic,1));
        if(empty($topic)){
            log_message('error', 'topic의 값이 없습니다.');
            show_error('topic의 값이 없습니다.');
        }
        log_message('debug', 'get view 로딩');

        $this->load->view('get', array('topic'=>$topic));
        log_message('debug', 'footer 로딩');
        $this->load->view('footer');
    }
    
    public function add(){
        if(! $this->session->userdata('is_login')){
            $this->load->helper('url');
            redirect('/auth/login?returnURL='.rawurlencode(site_url('/topic/add')));
        }

        $this->_head();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', '제목', 'required');
        $this->form_validation->set_rules('description', '본문', 'required');
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('add');
        } else {
            $topic_id = $this->topic_model->add($this->input->post('title'), $this->input->post('description'));
            
            $this->load->library('email');
            $this->email->initialize(array('mailtype'=>'html'));
            
            // $this->load->model('usertbl_model');
            // $users = $this->usertbl_model->gets();
            // foreach($users as $user){
            //     $this->email->from('woojoo@naver.com', 'woojoo');
            //     $this->email->to($user->email);
            //     $this->email->subject('새로운 글이 등록 되었습니다.');
            //     $this->email->message("<a href='".site_url('/topic/get/'.$topic_id)."'>".$this->input->post('title')."</a>");
            //     $this->email->send();
            // }

            $this->load->helper('url');
            redirect('/topic/'.$topic_id);
        }
        

        
        $this->load->view('footer');
    }
    function _head(){
        $this->load->view('head');
        $topics = $this->topic_model->gets();
        $this->load->view('topic_list', array('topics'=>$topics));
        $this->load->helper(array('url', 'HTML', 'korean')); //헬퍼 사용법
    }
    function upload_form(){
        $this->_head();
        $this->load->view('upload_form');
        $this->load->view('footer');
    }
    function upload_receive(){
        $config['upload_path'] = './static/user';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        if(! $this->upload->do_upload("user_upload_file")){
            echo $this->upload->display_errors();
        } else {
            $data =array('upload_data' => $this->upload->data());
            echo "성공";
            var_dump($data);
        }
    }

}
