<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RiaBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <link rel="icon" href="/static/img/favicon.png"/>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        #nav{
            width: 99vw;
            height: 4vw;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        #logo-div{
            margin-left: 3vw;
            width: 8vw;
        }
        #logo{
            margin-top:0.2vw;
            height: 4vw;
        }
        #nav_login{
            display: flex;
            flex-direction: column;
            margin-right: 3vw;
            width: 6vw;
        }
        #nav_login>button{
            height: 1.5vw;
        }
        .btn-group>.btn-outline-primary:hover{
            background-color: #95E7F8;
        }
        .btn-group-lg{
            height: 6vw;
            width: 40vw;
        }
        .btn-group>button{
            width: 6vw;
        }
        .main{
            height: 60vw;
            display: flex;
            justify-content: center;
        }
        .footer{
            background-color: #404040;
            height: 6vw;
            display: flex;
            color: white;
            justify-content: space-between;
        }
        .footer_right{
            display: flex;
            align-items: center;
        }
       /* a:hover{
            color: 99ccff;
        }*/
        .nav_icon{
            width: 2.5vw;
        }
        .main{
            margin-top: 2vw;
            margin-bottom: 2vw;
            margin-left: 10vw;
            width: 80vw;
            height: auto;
            min-height: 35vw;

        }
        hr{
            margin-top: 3px;
            margin-left: 2vw;
            margin-right: 2vw;
        }
        #nav_left{
            display: flex;
        }
        .btn-group>.btn{
            border: none;
        }
        #status_login{
            text-align: center;
        }
        #loginstatus{
            text-align: center;
        }
        a{
            text-decoration: none;
        }
        .headerbtns{
            font-size: 1vw;
            font-weight: 600;
            height:4.3vw;
        }
            p{
        margin-bottom: 0 !important;
    }
    .mb1em{
        margin-bottom: 1em !important;
    }
    .selectheaderbtn{
        background-color:skyblue;
        color:white;
    }
    </style>
</head>
<body>
    <div id="nav">
        <div id="nav_left">
            <div id="logo-div" >
                <a href="<?=base_url()?>"><img src="<?=base_url()?>static/img/Ria.png" id="logo"></a>
            </div>
            <div class="btn-group" role="group" aria-label="Large button group">
                <button type="button nowheader" id="notice" class="btn btn-outline-primary headerbtns <?php if(isset($data) and $data==1){echo 'selectheaderbtn';} ?>">공지사항</button>
                <button type="button" id="free" class="btn btn-outline-primary headerbtns <?php if(isset($data) and $data==2){echo 'selectheaderbtn';} ?>">연재</button>
                <button type="button" id="rank" class="btn btn-outline-primary headerbtns <?php if(isset($data) and $data==3){echo 'selectheaderbtn';} ?>">
                    <img class="nav_icon" src="<?=base_url()?>static/img/icons8-왕관-48.png" alt="">랭킹
                </button>
                <button type="button" id="help" class="btn btn-outline-primary headerbtns <?php if(isset($data) and $data==4){echo 'selectheaderbtn';} ?>">
                    <img class="nav_icon" src="<?=base_url()?>static/img/icons8-돋보기-48.png" alt="">검색
                </button>
            </div>
        </div>
        <div id="nav_login">
            <?php
            if(isset($_SESSION['useridx'])){
            ?>
            <div id="status_login" title="마이페이지"><a href="<?=base_url()?>mypage"><?=$nickname?>님!</a></div>
            <div id="loginstatus"><button type="button" id="logoutbtn" class="btn btn-outline-primary">로그아웃</button></div>
            <?php
            } else {
             ?>
            <a href="<?=base_url()?>home/login" title='로그인'><img src="<?=base_url()?>static/img/free-icon-login-7856156.png" id="logo"></a>
            <?php 
            } ?>
            
        </div>
    </div>
    <?php
        if(isset($_SESSION['useridx'])){ 
    ?>
    <script>
        const logoutbtn = document.querySelector('#logoutbtn');
        logoutbtn.addEventListener('click',()=>{
        window.location.href = "<?=base_url()?>users/logout";
        })
    </script>
    <?php
        } 
     ?>
    <hr>
    <div class="main">

