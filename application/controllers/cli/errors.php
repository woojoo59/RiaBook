<?php
class Errors extends CI_Controller{
    public function notfound(){
        $this->load->view('head');
        echo '<script>';
        echo 'alert("존재하지않는 페이지입니다.")';
        echo '</script>';
        // echo '<script>window.location.href = "http://localhost/"</script>';
        $this->load->view('footer');
    }
}