<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Novel extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->model('novel_model');
        $this->load->model('notice_model');
        $this->load->model('img_model');
        $this->load->model('novellog_model');
        $this->load->helper('url');
        $this->load->helper('cookie');

    }

    function index(){
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
        $this->header();
        $this->load->view('novel/novel');
        $this->load->view('footer');
    }

    function newnovel(){
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }

        $useridx = $_SESSION['useridx'];
        $subject = $this->sanitize_input($_POST['subject']);
        $introduce = $_POST['introduce'];
        $category = $_POST['category'];
        $tag = $this->sanitize_input($_POST['tag']);
        $status = $_POST['status'];
        $date = date('Y-m-d H:i:s',time());


        


        $foridx = $this->novellist_model->newnovel($useridx,$subject,$introduce,$category,$tag,$status,$date);
        
        if($_FILES['img']['name']!=''){
            $file_path = 'C:\xampp\htdocs\static\upload/';

            

            $filename = time().'_'.$_FILES['img']['name'];
            $filename = base64_encode($filename);
            $imgname = str_replace('/', 'ㅁ', $filename);

            $file_path .= $imgname;


            $this->load->model('img_model');
            $this->img_model->add($foridx,$imgname,'0');
            move_uploaded_file($_FILES['img']['tmp_name'], $file_path);
            
        }
        redirect(base_url().'novel/novel?novelidx='.$foridx);
    }

    function novelwrite(){

        $novel = $this->novel_model->novelidxcount($_GET['index']);
        $array = array('cnt'=>$novel+1);
        $my = $this->novellist_model->selectidx($_GET['index']);
        if($my->creator != $_SESSION['useridx']){
            redirect(base_url().'other/wrongapproach');
        }

        $this->header();
        $this->load->view('novel/write',$array);
        $this->load->view('footer');
    }

    function novel(){                                                               //대표 페이지
        $idx = $_GET['novelidx'];

        $this->header();
        $novel = $this->novellist_model->profilenovel($idx);
        if(!isset($novel->idx)){
            redirect(base_url().'other/wrongapproach');
        }
        if($novel->img == ''){
            $novel->img = 'default.png';
        }
        if($novel->status != 0){
            $this->mystatus($idx,'');
        }

        $tagarray = explode('#', $novel->tag);
        unset($tagarray[0]);
        $novel->tag = $tagarray;
        $novel->option = 0;
        $novel->prefer = 'prefer.png';
        $novel->recommend = 'commend.png';
        if(isset($_SESSION['useridx'])){
            $me = $this->users_model->useridxselect($_SESSION['useridx']);
            $prefers = explode('#', $me->prefer);
            $recommends = explode('#', $me->recommends);
            if(in_array($idx, $recommends))$novel->recommend='recommend.png';
            if(in_array($idx, $prefers))$novel->prefer='prefers.png';
        }
        

        $this->load->view('novel/profile/profile',$novel);
        $this->load->view('footer');
        if(!isset($_SESSION['useridx'])){
            $this->load->view('user/requierlogin');
        }
    }



    function jslist($page){
        $this->load->view('novel/profile/tableheader');
        $idx = $_POST['idx'];
        $option = $_POST['option'];
        $notices = $this->notice_model->select('foridx', $idx); //공지 사항 리스트 출력
        switch ($option) {
            case 1:
                $novels = $this->novel_model->novelidxdesc('idx',$idx);
                break;
            
            default:
                $novels = $this->novel_model->novelidx('idx',$idx);
                break;
        }
        

        $toEnd = count($notices);
        $maxnoidx = isset($_POST['add'])? $_POST['add'] : $toEnd-3;
        $noidxarray = array('maxnoidx'=>$maxnoidx, 'page'=>$page, 'option'=>$option, 'idx'=>$idx);
        foreach($notices as $notice){
            $this->load->view('novel/profile/noticelist',$notice);
            
            if($maxnoidx == --$toEnd){
                if($maxnoidx != 0){

                    $this->load->view('novel/profile/addviewer',$noidxarray);
                }
                break;
            }
        }
        

        $date = array('s','i','h','d','m','y');
        $dates = array('초전','분전','시간전','일전','달전','년전');

        $maxcnt = 0;
        foreach($novels as $u){
            $maxcnt++;
        }
        $maxpagecnt = ceil($maxcnt/10);
        $startcnt = 0 + (10*$page);
        $lastcnt = 9 + (10*$page);
        $nowblock = 1+floor($page/5);
        $maxblockcnt = ceil($maxpagecnt/5);
        $startpage = 0+(5*($nowblock-1));
        $endpage = $startpage+4;
        if($endpage>=$maxpagecnt){
            $endpage = $maxpagecnt-1;
        }
        $pageskin = array('nowpage'=> $page, 'nowblock'=>$nowblock, 'maxblock'=>$maxblockcnt, 'startpage'=>$startpage, 'endpage'=>$endpage);

        $index = 0;
        $last = $maxcnt;
        foreach ($novels as $novel) {                            //소설 리스트 출력
            if($index>$lastcnt)break;
            if($index>=$startcnt){
                $start = new DateTime($novel->updated);
                $end = new DateTime(date('Y-m-d H:i:s'));
                $interval = date_diff($start,$end);
    
                switch ($option) {
                    case 1:
                        $novel->index = $last;
                        break;
                    
                    default:
                        $novel->index = $index+1;
                        break;
                }
    
                $datesi = 0;
                foreach($date as $data){
                    if($interval->{$data} != 0){
                        $novel->updated = $interval->{$data}.$dates[$datesi];
                    }
                    $datesi++;
                }    
                $novel->content = $this->sanitize_input($novel->content);
                $this->load->view('novel/list/jslist', $novel);
            }
            
            $index++;
            $last--;
        }
        if($maxcnt == 0){
            $this->load->view('novel/profile/spacelist');
        }
        $this->load->view('novel/profile/tablefooter');
        if($maxcnt != 0){
            $this->load->view('novel/profile/pagenation', $pageskin);
        }
    }

    private function header(){
        if(isset($_COOKIE['nickname']) && !isset($_SESSION['useridx'])){
            redirect('/users/login');
        }
        $row = '';
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
        }
        $this->load->view('header',$row);
    }

    function write(){                                                                   //연재
        $idx = $_POST['foridx'];
        $title = $this->sanitize_input($_POST['title']);

        $content = ($_POST['content']);
        $status = $_POST['nstatus'];

        if($status == '공지'){
            $this->load->model('notice_model');
            $this->notice_model->add($idx,$title,$content);
            redirect('/mypage');
        }
        $time = date('Y-m-d H:i:s',time());

        $this->novel_model->wnovel($idx, $title, $content, $status, $time);
        if($status==0){
            $this->novellist_model->updated($time,$idx);
        }
        
        redirect('/mypage');
    }

    function deletecheck($index){

        $this->mystatus($index,'idx');

        $skin = array('option' => 0 );

        if(isset($_POST['password'])){
            $ps = $_POST['password'];
            $pk = $_POST['passwordck'];
            if($ps == $pk){
                $user = $this->users_model->useridxselect($_SESSION['useridx']);
                if(password_verify($ps, $user->password)){
                    redirect(base_url().'novel/deletenovellist?index='.$index);
                } else {
                    echo '실패';
                    $skin['option'] = 2;
                }
            } else {
                $skin['option'] = 1;
            }

        }
        $skin['idx'] = $index;
        $this->header();
        $this->load->view('user/passwordck',$skin);
        $this->load->view('footer');
    }

    function deletenovellist($idx){
        if(!isset($idx)){
            redirect('home');
        }
        $this->load->model('recommend_model');
        $this->mystatus($idx,'idx');
        $this->load->model('continue_model');

        $this->novellist_model->deletenovel($idx);
        $this->novel_model->deletenovel($idx);
        $this->novellog_model->deletenovel($idx);
        $this->continue_model->deletenovel($idx);
        $this->recommend_model->deletenovel($idx);
        redirect('/mypage');
    }

    function viewer(){
        $this->load->model('continue_model');
        $max = $this->novel_model->maxnovelidx();
        if (!isset($_GET['index']) or $max->novelidx<$_GET['index'] or $_GET['index']<1) {
            redirect('other/wrongapproach');
        }

        $index = $_GET['index'];
        $novel = $this->novel_model->novelidx('novelidx',$index);
        $novels = $this->novel_model->novelidx('idx',$novel[0]->idx);
        $idx = 1;
        
        $novel[0]->prev = 0;
        foreach($novels as $thisview){

            if($thisview->novelidx == $index){
                break;
            }
            $novel[0]->prev = $thisview->novelidx;
            $idx++;
        }

        $novel[0]->view = $idx;
        if(isset($novels[$idx])){
            $novel[0]->next = $novels[$idx]->novelidx;
        } else {
            $novel[0]->next = 0;
        }
        if(!isset($_COOKIE['novelidx'.$index])){
            $this->input->set_cookie('novelidx'.$index, '1', 86400);
            $this->novel_model->hit($index);
            $creator = $this->novellist_model->selectidx($novel[0]->idx);

            $this->users_model->pointup($creator->creator);
            $log = $this->novellog_model->selectlog($novel[0]->idx,date('Y-m-d'),date('Y-m-d'));
            if(!isset($log[0])){
                $category = $this->novellist_model->selectidx($novel[0]->idx);
                $this->novellog_model->new($novel[0]->idx,$category->category);
            }
            $this->novellog_model->addhit($novel[0]->idx);


        
        }
        if(isset($_SESSION['useridx'])){
            $useridx = $_SESSION['useridx'];
            $this->continue_model->delete($useridx,$novel[0]->idx);
            $this->continue_model->add($useridx,$novel[0]->idx,$index);
        }


        $novel[0]->index = $_GET['index'];
        $this->load->view('novel/viewer/viewerheader', $novel[0]);
        $this->load->view('novel/viewer/viewer', $novel[0]);

        $test = $this->novellist_model->selectidx($novel[0]->idx);
        if($novel[0]->status != 0 or $test->status != 0){
            $this->mystatus($novel[0]->index,'novelidx');
        }
        $row = new stdClass();
        
        $defaultset = '16@30@#000000@#ccffcc';
        $row->setting = explode('@', $defaultset);
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
            $row->setting = explode('@', $row->setting);
        }
        

        $this->load->view('mypage/setting',$row);
        
        $this->load->view('novel/viewer/viewerfoot', $novel[0]);
        if(!isset($_SESSION['useridx'])){
            $this->load->view('user/requierlogin');
        }

    }


    function novellist(){

        
        $novelidx = $_GET['list'];
        $page = isset($_GET['page'])?$_GET['page']:1;
        $option = isset($_GET['option'])?$_GET['option']:0;

        $index = $_GET['list'];
        $viewer = $this->novel_model->novelidx('novelidx',$index);
        $viewers = $this->novel_model->novelidx('idx',$viewer[0]->idx);
        $idx = 1;
        
        $viewer[0]->prev = 0;
        foreach($viewers as $thisview){

            if($thisview->novelidx == $index){
                break;
            }
            $viewer[0]->prev = $thisview->novelidx;
            $idx++;
        }


        $viewer[0]->view = $idx;
        if(isset($viewers[$idx])){
            $viewer[0]->next = $viewers[$idx]->novelidx;
        } else {
            $viewer[0]->next = 0;
        }


        $viewer[0]->goback = '1';

        $this->load->view('novel/viewer/viewerheader',$viewer[0]);

        $this->load->view('novel/list/listheader');


        $idx = $_GET['novel'];


        $notices = $this->notice_model->select('foridx', $idx); //공지 사항 리스트 출력

        $toEnd = count($notices);
        $maxnoidx = isset($_GET['add'])? $_GET['add'] : $toEnd-3;
        $noidxarray = array('maxnoidx'=>$maxnoidx);

        foreach($notices as $notice){
            $this->load->view('notice/noticelist',$notice);
        }

        $novels = $this->novel_model->novelidxdesc('idx',$idx);

        $paging = new stdClass();                                   //페이징
        
        
        $last = 0;
        $index=0;

        foreach ($novels as $novel){  
            if($novel->novelidx == $novelidx){
                $paging->nowcnt = $last;
            }
            $last++;
        }
        $page = 1+floor($paging->nowcnt/30);
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $paging->page = $page;
        $paging->allcnt = $last;
        $paging->allpage = ceil($paging->allcnt/30);
        $paging->startcnt = 1+(($paging->page-1)*30);
        $paging->endcnt = 30+(($paging->page-1)*30);
        $paging->nowblock = floor($paging->startcnt/150);
        $paging->startblock = 1+(5*$paging->nowblock);
        $paging->endblock = 5+((5*$paging->nowblock));
        $paging->option = $option;
        if($paging->endblock>$paging->allpage){
            $paging->endblock=$paging->allpage;
        }
        $paging->nowpage = $page;


        $date = array('s','i','h','d','m','y');
        $dates = array('초전','분전','시간전','일전','달전','년전');
        foreach ($novels as $novel) {                            //소설 리스트 출력
            $novel->index = $last;

            $start = new DateTime($novel->updated);
            $end = new DateTime(date('Y-m-d H:i:s'));
            $interval = date_diff($start,$end);



            $datesi = 0;
            foreach($date as $data){
                if($interval->{$data} != 0){
                    $novel->updated = $interval->{$data}.$dates[$datesi];
                }
                $datesi++;
            }    
            

            

            if($paging->startcnt-1<=$index && $paging->endcnt>$index){
                if($novel->novelidx != $novelidx){
                    $this->load->view('novel/list/profilenovel',$novel);
                } else {
                    $this->load->view('novel/list/here',$novel);
                }
            }
            
            $index++;
            $last--;
        }

        $row = new stdClass();
        $defaultset = '16@30@#000000@#ccffcc';
        $row->setting = explode('@', $defaultset);
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
            $row->setting = explode('@', $row->setting);
        }
        

        $this->load->view('mypage/setting',$row);
        $this->load->view('novel/list/listfooter');
        $this->load->view('novel/list/paging',$paging);

        $viewer[0]->index = $_GET['list'];
        $this->load->view('novel/viewer/viewerfoot',$viewer[0]);
        if(!isset($_SESSION['useridx'])){
            $this->load->view('user/requierlogin');
        }
    }

    function delete(){
        $this->load->model('comment_model');
        $this->load->model('continue_model');
        $idx = $_GET['value'];
        $this->mystatus($idx,'novelidx');
        $idxs = $this->novel_model->novelidxs($idx);
        $save = '';
        foreach($idxs as $p){
            if($p->novelidx == $idx)break;
            $save = $p->novelidx;
        }
        if($save == null){
            $this->continue_model->denoveled($idx);
        }else {
            $this->continue_model->denovel($save,$idx);
        }  
        $this->novel_model->delete($idx);
        $this->comment_model->idxdelete($idx,0);
        redirect(base_url().'mypage');
    }

    public function recommendmynovel($idx){
        $this->statuslogin();
        $user = $this->users_model->useridxselect($_SESSION['useridx']);
        $novel = $this->novellist_model->selectidx($idx);
        if($novel->creator != $user->useridx){
            redirect(base_url().'other/wrongapproach');
        }
        $this->load->model('recommend_model');
        $flag = $_GET['flag'];

        $date = date('Y-m-d');
        $timestamp = strtotime($date);
        switch ($flag) {
            case 2:
                $day = 7;
                $cost = 63000;
                break;
            case 3:
                $day = 30;
                $cost = 255000;
                break;
            default:
                $day = 1;
                $cost = 10000;
                break;
        }
        if($user->mypoint-$cost<0){
            redirect(base_url().'other/wrongapproach');
        }
        $this->users_model->pointdown($user->useridx,$user->mypoint-$cost);
        $days=[];
        $nodays=[];
        $t = 0;
        for($i=1;1<2;$i++){
            $fordate = date('Y-m-d',strtotime($i.' day', $timestamp));
            $cnt = $this->recommend_model->dateselectcnt($fordate,$idx);
            if($cnt->cnt<20 and $cnt->col == 0){
                $days[$t]=$fordate;
                $t++;
            } else{
                array_push($nodays, $fordate);
            }
            if(isset($days[$day-1]))break;
            if($i==100)break;
        }

        foreach($days as $d){
            $this->recommend_model->add($idx, $user->useridx, $d);
        }

        redirect(base_url().'mypage');
    }

    public function checkrecommend($idx){
        $this->statuslogin();
        $user = $this->users_model->useridxselect($_SESSION['useridx']);
        $novel = $this->novellist_model->selectidx($idx);
        if($novel->creator != $user->useridx){
            redirect(base_url().'other/wrongapproach');
        }
        $this->load->model('recommend_model');
        $flag = $_POST['flag'];

        $date = date('Y-m-d');
        $timestamp = strtotime($date);
        switch ($flag) {
            case 2:
                $day = 7;
                $cost = 63000;
                break;
            case 3:
                $day = 30;
                $cost = 255000;
                break;
            default:
                $day = 1;
                $cost = 10000;
                break;
        }
        if($user->mypoint-$cost<0){
            $result = ['result'=>0];
            die(json_encode($result));
        }
        $days=[];
        $nodays=[];
        $t = 0;
        for($i=1;1<2;$i++){
            $fordate = date('Y-m-d',strtotime($i.' day', $timestamp));
            $cnt = $this->recommend_model->dateselectcnt($fordate,$idx);
            if($cnt->cnt<20 and $cnt->col == 0){
                $days[$t]=$fordate;
                $t++;
            } else{
                array_push($nodays, $fordate);
            }
            if(isset($days[$day-1]))break;
            if($i==100)break;
        }
        $result = ['result'=>$day, 'sday'=>$days[0], 'fday'=>$days[$day-1], 'nodays'=>$nodays];
        die(json_encode($result));
    }


    function edit(){


        $idx = $_GET['index'];
        $subject    = $this->sanitize_input($_POST['subject']);
        $category   = $_POST['category'];
        $status     = $_POST['status'];
        $tag        = $this->sanitize_input($_POST['tag']);
        $introduce  = $_POST['introduce'];
        $file_path = 'C:\xampp\htdocs\static\upload/';
        $this->load->model('img_model');

        if($_FILES['img']['name']!=''){

            $default = $this->img_model->selectimg($idx,0);
            


            $filename = time().'_'.$_FILES['img']['name'];
            $filename = base64_encode($filename);
            $imgname = str_replace('/', 'ㅁ', $filename);
            
            if(isset($default->imgname)){

                unlink($file_path.$default->imgname);
                $this->img_model->edit($imgname,$idx,0);
            } else{
                $this->img_model->add($idx,$imgname,0);
            }
            
          



            
            
            move_uploaded_file($_FILES['img']['tmp_name'], $file_path.$imgname);
            
        }

        

        
        $this->novellist_model->idxupdate($idx, $subject, $category, $status, $tag, $introduce);

        redirect('/mypage');
    }

    function noveledit(){

        $this->novel_model->edit($this->sanitize_input($_POST['title']),$_POST['content'],$_POST['nstatus'],$_POST['novelidx']);
        redirect('/mypage');
    }

    // function datainput(){
    //     $useridx = 1;
    //     $category = 0;
    //     for($i=1;$i<=100;$i++){
    //         $subject = '더미 데이터'.$i;
    //         $introduce = $i.'번째 더미 데이터 since = '.date('Y-m-d H:i:s');
    //         $tag = '#더미'.$i;
    //         $data = $this->novellist_model->newnovel($useridx,$subject,$introduce,$category,$tag,0,date('Y-m-d H:i:s'));
    //         $useridx++;
    //         if($useridx>4){$useridx=1;}
    //         $category++;
    //         if($category>6){$category=0;}

    //         for($j=1;$j<=100+$i;$j++){
    //             $this->novel_model->wnovel($data, date('Y-m-d H:i:s').$j, date('Y-m-d H:i:s'), 0, date('Y-m-d H:i:s'));
    //         }
    //     }        
    // }

    function imsi(){
        for($i=1;$i<=169;$i++){
            $imsi = $this->novellist_model->selectidx($i);
            if(!isset($imsi->idx)){
                $this->novellog_model->deletenovel($i);
            }
        }
    }
    
    function sanitize_input($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }




    public function mystatus($foridx,$table){
        $this->statuslogin();

        $me = $_SESSION['useridx'];
        if($table=='novelidx'){
            $row = $this->novel_model->mynovelidx($foridx);
            $foridx = $row->idx;
        }

        $row = $this->novellist_model->selectidx($foridx);
        $creator = $row->creator;

        if($me != $creator and $me != 1){
            redirect(base_url().'other/wrongapproach');
        }

    }

    public function statuslogin(){
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
    }
}
