<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->helper('cookie');
    }
    public function signin(){
    	$date = date('Y-m-d',time());
    	$mail = $_POST['mail'].'@'.$_POST['mailurl'];

    	$pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $address = $_POST['h1'].'/'.$_POST['h2'].'/'.$_POST['h4'];
    	
    	$this->users_model->signin($_POST,$pwd,$mail,$date,$address);
        echo '<script>';
        echo 'alert("가입이 완료되었습니다..")';
        echo '</script>';
        echo '<script>';
        echo 'location.href = "'.base_url().'"';
        echo '</script>';
        
    }
    function login(){

    	if(isset($_COOKIE['nickname'])){
    		$row = $this->users_model->nicknameselect($_COOKIE['nickname']);
    		$_SESSION['useridx'] = $row->useridx;
    		$this->input->set_cookie('nickname', $row->useridx, 259200);

    		redirect(base_url());
    	}
    	$row = $this->users_model->identifierselect($_POST['id']);
        if(!isset($row->password)){
            echo '<script>';
            echo 'alert("등록되지 않은 아이디입니다.")';
            echo '</script>';
            echo '<script>';
            echo 'location.href = "'.base_url().'home/login"';
            echo '</script>';
            exit;
        }
    	if(password_verify($_POST['password'], $row->password)){
            if($row->status == 0){
                echo '<script>';
                echo 'alert("정지당한 아이디입니다.")';
                echo '</script>';
                echo '<script>';
                echo 'location.href = "'.base_url().'home/login"';
                echo '</script>';
                exit;
            }
    		$_SESSION['useridx']=$row->useridx;
    	} else{
            echo '<script>';
            echo 'alert("비밀번호가 틀렸습니다.")';
            echo '</script>';
            echo '<script>';
            echo 'location.href = "'.base_url().'home/login"';
            echo '</script>';
            exit;
        }
    	if(isset($_POST['autologin'])){
    		$this->input->set_cookie('nickname', $row->useridx, 259200);
            echo '오토로그인';
    	}

    	redirect(base_url());
    }
    public function logout(){
    	session_unset();
		session_destroy();
		if($_COOKIE['nickname']){
			$this->input->set_cookie('nickname', '', -259200);
		}
		redirect(base_url());
		
    }

    public function pwdhash(){
        if(password_verify($_POST['number'], $_POST['hash'])){
            $rs = array("result" => 'ok');
        } else {
             $rs = array("result" => 'no');
        }
        die(json_encode($rs));
    }

    function userinformation(){
        $this->statuslogin();


        if(!isset($_POST['data'])){
            redirect('/home/login');
        }
        $row = $this->users_model->useridxselect($_SESSION['useridx']);
        $row->email = explode('@', $row->email);
        $row->address = explode('/', $row->address);
        $row->abc=0;
        for($i=0;$i<3;$i++){
            if (!isset($row->address[$i])) {
                $row->address[$i]='';
            }
            
        }

        $this->load->view('header',$row);
        $this->load->view('user/information',$row);
        $this->load->view('footer');
    }

    public function userupdate(){
        $nickname = $_POST['nickname'];
        $phonenumber = $_POST['phonenumber'];
        $email = $_POST['mail'].'@'.$_POST['mailurl'];
        $address = $_POST['h1'].'/'.$_POST['h2'].'/'.$_POST['h4'];
        $useridx = $_POST['useridx'];
        if(!isset($_SESSION['useridx']) or $useridx != $_SESSION['useridx']){
            redirect(base_url().'other/wrongapproach');
        }
        $this->users_model->myupdate($nickname,$phonenumber,$email,$address,$useridx);
        redirect(base_url().'mypage');
    }


    public function duplicate(){
    	if(isset($_POST['identifier'])){
    		$option = 'identifier';
    		$name = $_POST['identifier'];
    	} else if(isset($_POST['nickname'])){
    		$option = 'nickname';
    		$name = $_POST['nickname'];
    	}
    	
    	$row = $this->users_model->duplicate($option, $name);
    	$rs = array("result" => $row ? "no" : "ok");
    	die(json_encode($rs));
    }


    public function findidentifier(){
        $row = $this->users_model->whereselect('phonenumber',$_POST['phonenumber']);
        if(isset($row->identifier)){
            die($row->identifier);
        }
        
    }

    public function password(){
        $pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $this->users_model->password($pwd,$_POST['phone']);
        if(isset($_SESSION['useridx'])){
            session_unset();
            session_destroy();
            if(isset($_COOKIE['nickname'])){
                $this->input->set_cookie('nickname', '', -259200);
            }
        }
        echo '<script>';
        echo 'alert("비밀번호가 변경되었습니다. 로그인 해주세요.")';
        echo '</script>';
        echo '<script>';
        echo 'location.href = "'.base_url().'home/login"';
        echo '</script>';
    }


    function setting(){

        $setting = $_POST['size'].'@'.$_POST['height'].'@'.$_POST['fcolor'].'@'.$_POST['bcolor'];
        $this->users_model->setting($_SESSION['useridx'],$setting);
        $url = str_replace('/index.php', '', $_POST['url']);
        redirect($url);
    }

    function recommend(){
        $this->statuslogin();
        $this->load->model('novellog_model');
        $useridx = $_SESSION['useridx'];
        $idx = $_POST['recommend'];

        $me = $this->users_model->useridxselect($useridx);

        $recommends = explode('#', $me->recommends);
        array_shift($recommends);
        $recommend = '';
        if(in_array($idx, $recommends)){
            unset($recommends[array_search($idx, $recommends)]);
            foreach($recommends as $a){
                $recommend .= '#'.$a;
            }
            $this->users_model->recommend($recommend,$useridx);
            $this->novellist_model->recommend($idx);
            $row = $this->novellog_model->checkminus($idx);
            if(isset($row->dayrecommend) and $row->dayrecommend>0){
                $this->novellog_model->minusrecommend($idx);
            }
        } else {
            foreach($recommends as $a){
                $recommend .= '#'.$a;
            }
            $recommend .= '#'.$idx;
            $this->users_model->recommend($recommend,$useridx);
            $this->novellist_model->recommendadd($idx);
            $this->novellog_model->addrecommend($idx);
        }
    }

    function prefer(){
        $this->statuslogin();
        $this->load->model('novellog_model');
        $useridx = $_SESSION['useridx'];
        $idx = $_POST['prefer'];

        $me = $this->users_model->useridxselect($useridx);
        $prefers = explode('#', $me->prefer);
        array_shift($prefers);
        $prefer = '';
        if(in_array($idx, $prefers)){
            unset($prefers[array_search($idx, $prefers)]);
            foreach($prefers as $a){
                $prefer .= '#'.$a;
            }
            $row = $this->novellog_model->checkminus($idx);

            $this->users_model->prefer($prefer,$useridx);
            $this->novellist_model->prefer($idx);
            
            if(isset($row->dayprefer) and $row->dayprefer>0){
                $this->novellog_model->minusprefer($idx);
            }
            
        } else {
            foreach($prefers as $a){
                $prefer .= '#'.$a;
            }
            $prefer .= '#'.$idx;
            $this->users_model->prefer($prefer,$useridx);
            $this->novellist_model->preferadd($idx);
            $this->novellog_model->addprefer($idx);
            
        }
    }

    public function statuslogin(){
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
    }


    public function nickname(){
        $nickname = $_POST['nickname'];
        $nickname = $this->users_model->nickname($nickname);
        die(json_encode($nickname));
    }






    //메일인증
    function mail(){
        $rand = rand(100000,999999);
        $mailaddress = $_POST['mailid'].'@'.$_POST['mailurl'];
        

        include './static/lib/PHPMailer.php';
        include './static/lib/SMTP.php';
        
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        
        $mail->Host = 'smtp.naver.com';
        
        $mail->Port = 465;
        
        $mail->SMTPSecure = 'ssl';
        
        $mail->SMTPAuth = true;
        
        $mail->Username = 'dldnwn59';
        
        $mail->Password = 'VJ1W9UJ6VJEG';
        
        $mail->CharSet = 'UTF-8';
        
        $mail->setFrom('dldnwn59@naver.com', 'RiaBook');
        
        $mail->addReplyTo('dldnwn59@naver.com', '이우주');
        
        $mail->addAddress($mailaddress, '회원');
        
        $mail->Subject = 'RiaBook 인증 메일 입니다.';
        
        $mail->msgHTML('<p>안녕하세요.</p><p>웹 소설 사이트 RiaBook의 인증 메일입니다.</p><p>인증 메일은 <b><u>'.$rand.'</u></b> 입니다.</p>');
        
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
        
            $rs = array("result" => password_hash($rand, PASSWORD_BCRYPT));
            die(json_encode($rs));
        }

    }




    //sms인증
    function sms(){
        $phone = $_POST['phonenumber'];
        
        if(!isset($_POST['option'])){
            $option = 'phonenumber';
            $row = $this->users_model->duplicate($option, $phone);
            $rs = array("result" => $row ? "no" : "ok");
            if($rs['result']=='no'){
                die(json_encode($rs));
        }}
        if(isset($_POST['option'])){
            if($_POST['option']=='3'){
                $row = $this->users_model->useridxselect($_SESSION['useridx']);
                $phonenumber = $phone;
                $dbphonenumber = $row->phonenumber;
                if($phonenumber != $dbphonenumber){
                    $rs = array("result" => 'no');
                    die(json_encode($rs));
                }
            }
        }




        $rand = rand(100000,999999);

        $sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
        $sms['user_id'] = "dldnwn59"; // SMS 아이디
        $sms['key'] = "13eeid5cbd6w3ejyq8dpbauyk58nj55s";//인증키
        
        $_POST['msg'] = 'RiaBook sms인증 번호는 '.$rand.' 입니다.'; 
        $_POST['receiver'] = $phone; // 수신번호
        $_POST['destination'] = '01099135452|이우주'; // 수신인 %고객명% 치환
        $_POST['sender'] ="01099135452"; // 발신번호
        $_POST['rdate'] = ''; // 예약일자 - 20161004 : 2016-10-04일기준
        $_POST['rtime'] = ''; // 예약시간 - 1930 : 오후 7시30분
        if($phone == '01099135452'){
            $_POST['testmode_yn'] = '';
        } else {
            $_POST['testmode_yn'] = 'Y';
        }

        // Y 인경우 실제문자 전송X , 자동취소(환불) 처리
        $_POST['subject'] = 'RiaBook 인증 문자 입니다.'; //  LMS, MMS 제목 (미입력시 본문중 44Byte 또는 엔터 구분자 첫라인)
        // $_POST['image'] = '/tmp/pic_57f358af08cf7_sms_.jpg'; // MMS 이미지 파일 위치 (저장된 경로)
        $_POST['msg_type'] = 'SMS'; //  SMS, LMS, MMS등 메세지 타입을 지정
        
        
        $sms['msg'] = stripslashes($_POST['msg']);
        $sms['receiver'] = $_POST['receiver'];
        $sms['destination'] = $_POST['destination'];
        $sms['sender'] = $_POST['sender'];
        $sms['rdate'] = $_POST['rdate'];
        $sms['rtime'] = $_POST['rtime'];
        $sms['testmode_yn'] = empty($_POST['testmode_yn']) ? '' : $_POST['testmode_yn'];
        $sms['title'] = $_POST['subject'];
        $sms['msg_type'] = $_POST['msg_type'];
        
        /*****/
        $host_info = explode("/", $sms_url);
        $port = $host_info[0] == 'https:' ? 443 : 80;
        
        $oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_PORT, $port);
        curl_setopt($oCurl, CURLOPT_URL, $sms_url);
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $ret = curl_exec($oCurl);
        curl_close($oCurl);
        $json = json_decode($ret);
        
        $sendsuccess = 0;
        if($json->result_code == 1){
            $sendsuccess = 1;
        }
            $rs = array("result" => password_hash($rand, PASSWORD_BCRYPT),"success"=>$sendsuccess);
            die(json_encode($rs));

    }


    function imsi(){
        for($i=1; $i<=63; $i++){
            $user = array("identifier"=>'더미데이터'.$i);
            $user['nickname'] = '더미 데이터'.$i;
            $user['phonenumber'] = '01000000000'.$i;
            $user['username'] = '더미 데이터'.$i;
            $time = '2024-09-01';
            $mail = '';
            $address = '';
            $pwd = '1';
    
    
            $this->users_model->signin($user,$pwd,$mail,$time,$address);
            echo $i;
            echo "<hr>";
        }

        
    }

}

