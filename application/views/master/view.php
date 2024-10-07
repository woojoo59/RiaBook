<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 접속</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .main{
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .top{
            width: 100vw;
            padding: 0.5vw;
            border-bottom: 1px solid #eef0f2;
        }
        .mid{
            margin-top: 3vw;
            width:30vw;
            height: 40vw;
            border: 1px solid #eef0f2;
            border-radius: 1vw;
            padding: 1vw;
            display:flex;
            flex-direction: column;
            align-items: center;
        }
        .ria{
            width: 10vw;
            height: 10vw
        }
        .input{
            margin-top:5vw;
            margin-bottom: 1vw;
            width: 20vw;
        }
        .intro{
            color: grey;
            
        }
        #check{
            margin-top:5vw;
            width: 10vw;
            height: 4vw;
        }
        .dnone{
            display:none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">
        <div class="top"><a href="<?=base_url()?>"><img src="/static/img/home.png" alt=""></a></div>
        <div class="mid">
            <img class="ria" src="/static/img/Ria.png" alt="">
            <form id="masterform" method="post" action="<?=base_url()?>master/cook">
                <div class="form-floating input">
                    <input type="password" name="check" class="form-control" id="floatingInput" placeholder="aabbaab">
                    <input type="hidden" id="ck" name="ck">
                    <label for="floatingInput">인증 번호</label>
                </div>
            </form>
            <span id="intro" class="intro">
                등록된 휴대폰 번호로 인증 번호를 전송하였습니다.<br>
                관리자 페이지로 이동하시려면 인증 번호를 입력해주세요.
            </span>
            <div class="dnone">
                <button id="retry" class="btn btn-outline-info">재전송</button>
            </div>
            <div>
                <button id="check" class="btn btn-outline-info">인증</button>
            </div>
        </div>
    </div>
</body>
<script>
    code();
    $('#check').on('click',()=>{
        let flag = $('#floatingInput').val();
        if(flag.length == 6){
            $.post('<?=base_url()?>master/check',{'check': flag,'ck': $('#ck').val()},function(data){
                let obj = JSON.parse(data);
                if(obj.result==1){
                    $('#masterform').submit();
                } else {
                    $('#intro').html('올바른 인증번호가 다릅니다.');
                    $('.dnone').removeAttr('class',true)
                }
            })
        } else {
            $('#intro').html('올바른 인증번호가 아닙니다.');
            $('.dnone').removeAttr('class',true)
        }
    })
    $('#retry').on('click',()=>{
        code();
    })
    function code() {
        $.post('<?=base_url()?>users/sms',{'phonenumber':'<?=$phonenumber?>','option':1},function(data){
            let obj = JSON.parse(data);
            $('#ck').val(obj.result);
        })
    }
</script>
</html>