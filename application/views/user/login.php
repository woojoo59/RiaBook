<style>
    #login_main{
        width: 30vw;
        border: 1px solid  #eef0f2;
        border-radius: 1vw;
    }
    .dfcc{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .logintitle{
        width: 10vw;
        height: 10vw;
        margin-bottom: 4vw;
        margin-top: 4vw;
    }
    .form-floating{
        margin-left: 10%;
        margin-bottom: 1vw;
    }
    .form-control{
        width: 90%;
    }
    .h3font{
        font-style: italic;
        color: grey;
        margin-bottom: 1vw;
    }
    .form-check{
        margin-left: 10%;
    }
    .dfb{
        width: 90%;
        display: flex;
    }
    #loginbtn{
        margin-left: 10%;
        width: 80%;
        font-size: 1.5vw;
    }
    .mf{
        margin-left: 10%;
        width: 80%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 4vw;
    }
    .mf>a{
      text-decoration: none;
      color:black;
    }
    #top{
        display: flex;
        height: 5vw;
        align-items: center;
        justify-content: space-between;
    }
    .top{
        width: 15vw;
        text-align: center;
        border-bottom: 1px solid #eef0f2;
        font-size: 1vw;
        padding-bottom: 1vw
    }
    .check{
        color: blue;
        border-bottom: 1px solid blue;
    }
    .df{
        display: flex;
        margin-left: 1vw;
    }
    .mvw3{
        min-width: 4vw;
        margin-left: 1vw;
        margin-right: 1vw;
    }
    .top:hover{
        cursor: pointer;
    }
</style>
<div id="login_main">
    <div class="dfcc">
        <img src="/static/img/Ria.png" class="logintitle">
    </div>
    <h3 class="dfcc h3font">Please login</h3>
    <form action="<?=base_url()?>users/login" method="post" id="loginform">
    <div class="form-floating">
        <input type="text" name="id" class="form-control" id="floatingidentifier" placeholder="아이디">
        <label for="floatingidentifier">아이디</label>
    </div>
    <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="비밀번호">
        <label for="floatingPassword">비밀번호</label>
    </div>
    <div class="form-check text-start my-3">
        <input class="form-check-input" name="autologin" type="checkbox" value="on" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            자동 로그인
        </label>
    </div>
    <input type="submit" class="btn btn-primary" id="loginbtn" value="Login">
    </form>
    <div class="mf">
        <a href="<?=base_url()?>home/signin">회원가입</a>
        <a href='' data-bs-toggle="modal" data-bs-target="#exampleModal" >아이디/비밀번호 찾기</a>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">아이디/비밀번호 찾기</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="top">
                    <div class="top top1 check">
                        아이디 찾기
                    </div>
                    <div class="top top2">
                        비밀번호 찾기
                    </div>
                </div>
                <div class="form-floating mb-3 df">
                    <input type="text" class="form-control" id="sms" placeholder="name@example.com">
                    <label for="sms">휴대폰 번호 '-'없이 11글자</label>
                    <button class="btn btn-primary mvw3" id="smsbtn">전송</button>
                </div>
                <div class="form-floating df">
                    <input type="password" class="form-control" id="smsck" placeholder="Password">
                    <label for="smsck">인증번호</label>
                    <button class="btn btn-primary mvw3" disabled id="smsckbtn">인증</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const loginbtn = document.querySelector('#loginbtn');
    const loginform = document.querySelector('#loginform');
    loginbtn.addEventListener('click', ()=>{
        loginform.submit();
    })

    let option = 1;
    const sms = $('#sms');
    const smsbtn = $('#smsbtn');
    const smsck = $('#smsck');
    const smsckbtn = $('#smsckbtn');
    let okphone = 1001
    $('.top1').on('click',()=>{
        $('.top2').attr('class','top top2');
        $('.top1').attr('class','top top1 check');
        okphone = 1001;
        option = 1;
        sms.val('');
        smsck.val('');
        smsckbtn.attr('disabled',true);
    })
    $('.top2').on('click',()=>{
        $('.top1').attr('class','top top1');
        $('.top2').attr('class','top top2 check');
        okphone = 1001
        option = 2
        sms.val('');
        smsck.val('');
        smsckbtn.attr('disabled',true);
    })
    smsbtn.on('click',()=>{
        $.post('<?=base_url()?>users/sms',{'phonenumber':sms.val(),'option':option},function(data){
            let obj = JSON.parse(data);
            if(obj.success != 1){
                alert('올바른 휴대폰 번호를 입력해주세요');
                return false
            }
            okphone = obj.result;
            smsckbtn.removeAttr("disabled");
        })
    })

    smsckbtn.on('click',()=>{
        $.post('<?=base_url()?>users/pwdhash',{'number':smsck.val(),'hash':okphone},function(data){
            let obj = JSON.parse(data);
            if(obj.result=='ok'){
                if(option == 1){
                    $.post('<?=base_url()?>/users/findidentifier',{'phonenumber':sms.val()},function(data){
                        if(data==''){
                            alert('이 번호로 가입된 계정은 없습니다.');
                            return false;
                        }
                        alert('아이디는 : "'+data+'" 입니다.');
                    })
                } else if(option == 2){
                    $.post('<?=base_url()?>/users/findidentifier',{'phonenumber':sms.val()},function(data){
                        if(data==''){
                            alert('이 번호로 가입된 계정은 없습니다.');
                            return false;
                        }
                    })
                    var newForm = document.createElement('form');
                    newForm.name = 'newForm';
                    newForm.method = 'post';
                    newForm.action = '<?=base_url()?>home/password';
    
                    var input = document.createElement('input');
                    // set attribute (input)
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "phone");
                    input.setAttribute("value", sms.val());
    
                
                    // append input (to form)
                    newForm.appendChild(input);
                    document.body.appendChild(newForm);
                    newForm.submit();
                }
            }else {
                alert('인증번호가 다릅니다.');
            }
        })
    })
</script>