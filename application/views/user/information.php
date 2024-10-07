<style>
    .duo{
        height: 100%;
        margin-left: 1vw;
        min-width: 5vw;
    }
    .wvw74{
        width: 34vw;
    }
    .mbv-1{
        display: flex;
        justify-content: space-between;
    }
    .mbv0{
        display: flex;
        justify-content: space-between;
    }
    .row_center{
        display: flex;
        justify-content: center;
    }
    .between{
        display: flex;
        justify-content: space-between;
    }
    .div_signin{
        width: 40vw;
    }
    select,option{
        text-align: center;
        width: 40%;
        font-size: 1vw;
    }
    .vw_3{
        display: flex;
        margin-left: 1vw;
        margin-right: 1vw;
        align-items: flex-end;
    }
    .signin_btn{
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 2vw;
    }
    #signinbtn{
        width: 8vw;
        height: 3vw;
    }
    #passwordbtn{
        width: 8vw;
        height: 3vw;
    }
    #mail{
        border-radius: 4px;
        border: 2px solid  #eef0f2;
    }
    .checkedduo{
        height:2vw;
    }
    .inputintroduce{
        font-size: 10px;
        color: grey;
    }
    #mailid{
        width: 10vw;
    }
    .mailform{
        display: flex;
    }
    #mailurl{
        width: 20vw;
        margin-right: 1vw;
    }
    .mb05{
        margin-bottom: 0.5vw;
    }
    .dn{
        display: none;
    }
    .say{
        width: 15vw;
        height: 10vw;
        border-radius:0.5vw;
        border:1px solid;
        position: fixed;
        bottom: 7vw;
        left: 5vw;
        padding: 0.5vw;
        background-color: #E3FDFD;
    }
    .sayhead{
        display: flex;
        justify-content:flex-end;
        padding-bottom: 0.5vw;
        margin-bottom:0.5vw;
        border-bottom: 1px solid;

    }
    .saysec{
        margin-right:1vw;
        color: grey;
        font-size:0.6vw;
        display:flex;
        align-items:center;
    }
    .saymain{
        background-color: white;
        height:6.5vw;
        border-radius:0.5vw;
        padding: 0.5vw;
        font-size:0.8vw;
    }

</style>
<div class="div_signin">
    <script src="//d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>
    <form id="createuser" method="post" action="<?=base_url()?>users/userupdate">
        <div class="form-floating">
            <input type="text" name="identifier" class="form-control" id="identifier" placeholder="아이디" value="<?=$identifier?>" readonly>
            <label for="identifier">아이디</label>
        </div>
        <div class="checkedduo">
            <span id="checkid" class="inputintroduce"></span>
        </div>
        <div class="mbv0">
            <div class="form-floating">
                <input type="text" name="nickname" class="form-control wvw74" id="nickname" placeholder="닉네임" value="<?=$nickname?>">
                <label for="nickname">닉네임</label>
            </div>
            <div>
            <button type="button" id="nickck" class="btn btn-outline-primary duo" disabled>중복확인</button>
            </div>
        </div>
        <div class="checkedduo">
            <span id="cknick" class="inputintroduce"></span>
        </div>
        <div class="form-floating mbv-1">
            <input type="text" name="username" class="form-control" id="username" placeholder="이름" value="<?=$username?>" readonly>
            <label for="username">이름</label>
        </div>
        <div class="checkedduo">
            <span id="checkid" class="inputintroduce"></span>
        </div>
        <div class="mbv-1">
            <div class="form-floating">
                <input type="text" name="phonenumber" class="form-control wvw74" id="phonenumber" placeholder="아이디" value="<?=$phonenumber?>">
                <label for="phonenumber">휴대폰 번호</label>
            </div>
            <div>
            <button type="button" id="smscall" class="btn btn-outline-primary duo" disabled>SMS인증</button>
            </div>
        </div>
        <div id="cksmsdiv" class="checkedduo dn">
            <span id="cksms" class="inputintroduce"></span>
        </div>
        <div id="phoneckdiv" class="mbv-1 dn">
            <div class="form-floating">
                <input type="password" class="form-control wvw74" id="phonenumberck" placeholder="아이디">
                <label for="phonenumber">인증번호</label>
            </div>
            <div>
            <button type="button" id="smsck" class="btn btn-outline-primary duo">확인</button>
            </div>
        </div>
        <div class="checkedduo">
            <span class="inputintroduce"></span>
        </div>
        <div class="form-floating mailform mb05">
            <input type="text" name="mail" class="form-control" id="mailid" placeholder="이름" value="<?=$email[0]?>">
            <label for="mailid">이메일</label>
            <div class="vw_3">
            @
            </div>
            <input type="text" class="form-control" name="mailurl" id="mailurl" value="<?=$email[1]?>" readonly>
            <select id="mail">
                <option value="naver.com" <?php if($email[1]=='naver.com'){echo 'selected';} else {$abc=1;} ?>>
                    naver.com
                </option>
                <option value="kakao.com" <?php if($email[1]=='kakao.com'){echo 'selected';} else {$abc+=1;} ?>>
                    kakao.com
                </option>
                <option value="daum.net" <?php if($email[1]=='daum.net'){echo 'selected';} else {$abc+=1;} ?>>
                    daum.net
                </option>
                <option value="gmail.com" <?php if($email[1]=='gmail.com'){echo 'selected';} else {$abc+=1;} ?>>
                    gmail.com
                </option>
                <option value="" <?php if($abc==4){echo 'selected';} ?>>
                    직접입력 
                </option>
            </select>
            <div>
            <button type="button" id="mailcall" class="btn btn-outline-primary duo" disabled>인증번호 전송</button>
            </div>
        </div>
        <div id="mailckdiv" class="mbv-1 dn">
            <div class="form-floating">
                <input type="password" class="form-control wvw74" id="emailck" placeholder="아이디">
                <label for="phonenumber">인증번호</label>
            </div>
            <div>
            <button type="button" id="mailck" class="btn btn-outline-primary duo">확인</button>
            </div>
        </div>
        <div class="checkedduo">
            <span class="inputintroduce" id="ckmail"></span>
        </div>
        <input type="hidden" name="h1" id="h1">
        <input type="hidden" name="h2" id="h2">
        <input type="hidden" name="h4" id="h4">
        <input type="hidden" name="useridx" value="<?=$useridx?>">
    </form>
    <form id="passowordform" method="post" action="<?=base_url()?>home/password">
        <input type="hidden" name="phone" value="<?=$phonenumber?>">
    </form>
    <div id="address">
        <div id="input_id" class="between">
            <div class="form-floating">
                <input type="text" name="ad1" id="ad1" class="postcodify_postcode5 form-control codify" value="<?=$address[0]?>" placeholder="주소번호" readonly>
                <label for="ad1">주소번호</label>
            </div>
        </div>
        <div class="form-floating between">
            <input type="text" name="ad2" id="ad2" class="postcodify_address form-control" value="<?=$address[1]?>" placeholder="주소" readonly>
            <label for="ad2">도로명 주소</label>
        </div>
        <input type="hidden" id="ad3" class="postcodify_extra_info">
        <div class="form-floating between">
            <input type="text" name="ad4" id="ad4" class="postcodify_details form-control" value="<?=$address[2]?>" placeholder="주소">
            <label for="ad4">상세 주소</label>
        </div>

        <!-- jQuery와 Postcodify를 로딩한다 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="//d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>

        <!-- "검색" 단추를 누르면 팝업 레이어가 열리도록 설정한다 -->
        <script> $(function() { 
            $("#ad2").postcodifyPopUp();
            $("#ad1").postcodifyPopUp(); });

            let codifyaddress = ''
            $('#ad4').on('focus',()=>{
                
                if(codifyaddress != $('#ad2').val()){
                    $('#ad2').val($('#ad2').val()+' '+$('#ad3').val());
                    codifyaddress = $('#ad2').val();
                }
            })               
         </script>
    </div>

    <div class="signin_btn">
        <button type="button" class="btn btn-outline-primary" id="passwordbtn">비밀번호 수정</button>
        <button type="button" class="btn btn-outline-primary" id="signinbtn">회원정보 수정</button>
    </div>
</div>
<div id="saydiv" class="say dn">
    <div class="sayhead">
        <div id="saysec" class="saysec">10 seconds ago</div>
        <button type="button" id="saybtn" class="btn-close" aria-label="Close"></button>
    </div>
    <div id="saymain" class="saymain">닉네임 중복확인이 필요합니다.</div>
</div>
<script>
    $('#passwordbtn').on('click',()=>{
        history.replaceState(null, null, '<?=base_url()?>mypage');
        $('#passowordform').submit();
    })
    let nickflag = 1;
    let phoneflag = 1;
    let mailflag = 1;

    const dnick = '<?=$nickname?>';
    const dphone = <?=$phonenumber?>;
    const dmail0 = '<?=$email[0]?>';
    const dmail1 = '<?=$email[1]?>';
    let smscheck = '';
    let mailcheck = '';



    $('#nickname').on('change',()=>{
        nickflag = 0;
        $('#cknick').html('닉네임은 2~20글자, 한글, 영문, 숫자만 입력 가능 합니다.');
        $('#nickck').removeAttr('disabled',true);
        if($('#nickname').val()==dnick){
            nickflag = 1;
            $('#cknick').html('기존 닉네임입니다.');
            $('#nickck').attr('disabled',true);
        }
    })
    $('#nickck').on('click',()=>{
        $.post('<?=base_url()?>users/duplicate',{'nickname':$('#nickname').val()},function(data){
            let obj = JSON.parse(data);
            if(obj.result == 'no'){
                $('#saymain').html('이미 존재하는 닉네임 입니다.');
                dn10();
                return false;
            }
            nickflag = 1;
            $('#saymain').html('중복확인이 완료되었습니다.');
            dn10();
        })
    })




    $('#phonenumber').on('change',()=>{
        phoneflag = 0;
        $('#phoneckdiv').attr('class','mbv-1');
        $('#cksmsdiv').attr('class', 'checkedduo');
        $('#cksms').html('"-"를 뺀 숫자만 입력해주세요 ex)01012345678');
        $('#smscall').removeAttr('disabled',true);
        if($('#phonenumber').val()==dphone){
            phoneflag = 1;
            $('#phoneckdiv').attr('class','mbv-1 dn');
            $('#cksmsdiv').attr('class', 'checkedduo dn');
            $('#smscall').attr('disabled',true);
        }
    })
    $('#smscall').on('click',()=>{
        $.post('<?=base_url()?>users/sms',{'phonenumber':$('#phonenumber').val()},function(data){
            let obj = JSON.parse(data);
            if(obj.result == 'no'){
                $('#saymain').html('이미 가입된 번호입니다.');
                dn10();
                return false;
            }
            $('#saymain').html('문자가 발송되었습니다.');
            dn10();
            smscheck = obj.result;
        })
    })
    $('#smsck').on('click',()=>{
        $.post('<?=base_url()?>users/pwdhash',{'number':$('#phonenumberck').val(),'hash':smscheck},function(data){
            let obj = JSON.parse(data);
            if(obj.result=='ok'){
                phoneflag = 1;
                $('#saymain').html('인증이 완료되었습니다.');
                dn10();
                $('#phoneckdiv').attr('class','mbv-1 dn');
                $('#cksmsdiv').attr('class', 'checkedduo dn');
                $('#smscall').attr('disabled',true);
            }
        })
    })



    $('#mailid').on('change',()=>{
        mailflag = 0;
        $('#mailckdiv').attr('class','mbv-1');
        $('#mailcall').removeAttr('disabled',true);
        if($('#mailid').val()==dmail0 && $('#mailurl').val()==dmail1){
            mailflag = 1;
            $('#mailckdiv').attr('class','mbv-1 dn');
            $('#mailcall').attr('disabled',true)
        }
    })
    $('#mail').on('change',()=>{
        $('#mailurl').val($('#mail').val());
        if($('#mail').val()==''){
            $('#mailurl').removeAttr('readonly',true);
        } else {
            $('#mailurl').attr('readonly',true);
        }
        mailflag = 0;
        $('#mailckdiv').attr('class','mbv-1');
        $('#mailcall').removeAttr('disabled',true);
        if($('#mailurl').val()==dmail1 && $('#mailid').val()==dmail0){
            mailflag = 1;
            $('#mailckdiv').attr('class','mbv-1 dn');
            $('#mailcall').attr('disabled',true);
        }
    })
    $('#mailcall').on('click',()=>{
        $.post('<?=base_url()?>users/mail',{'mailid':$('#mailid').val(),'mailurl':$('#mailurl').val()},function(data){
            let obj = JSON.parse(data);
            $('#saymain').html('메일이 발송되었습니다..');
            dn10();
            mailcheck = obj.result;
        })
    })
    $('#mailck').on('click',()=>{
        $.post('<?=base_url()?>users/pwdhash',{'number':$('#emailck').val(),'hash':mailcheck},function(data){
            let obj = JSON.parse(data);
            if(obj.result=='ok'){
                mailflag = 1;
                $('#mailckdiv').attr('class','mbv-1 dn');
                $('#mailcall').attr('disabled',true);
                $('#saymain').html('인증이 완료되었습니다.');
                dn10();
            }
        })
    })


    $('#signinbtn').on('click',()=>{
        $('#h1').val($('#ad1').val());
        $('#h2').val($('#ad2').val());    
        $('#h4').val($('#ad4').val());   
        if(nickflag == 0){
            $('#saymain').html('닉네임 중복확인이 필요합니다.')
            dn10();
            return false;
        }
        if(phoneflag == 0){
            $('#saymain').html('휴대폰 인증이 필요합니다.')
            dn10();
            return false;
        }
        if(mailflag == 0){
            $('#saymain').html('메일 인증이 필요합니다.')
            dn10();
            return false;
        }
        let ad4pattern = /[^A-Za-z0-9가-힣\-]/;
        if(ad4pattern.test($('#ad4').val())){
            $('#saymain').html('상세주소는 한글과 영어, 숫자, "-"만 입력가능합니다.')
            dn10();
            return false;
        }
        history.replaceState(null, null, '<?=base_url()?>mypage');
        $('#createuser').submit();
    })

    $('#saybtn').on('click',()=>{
        $('#saydiv').attr('class','say dn');
    })




    let timeoutId;  // 타이머 ID 저장 변수

    function dn10() {
        $('#saydiv').attr('class','say');
        let sec = 10;
        $('#saysec').html(sec + ' seconds ago');
        sec1(sec);
    }
    
    function sec1(sec){
        // 이전 타이머가 있으면 중지
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
    
        // 새로운 타이머 시작
        timeoutId = setTimeout(() => {
    
            sec--;
            $('#saysec').html(sec + ' seconds ago');
    
            if (sec == 0) {
                $('#saybtn').trigger('click');
                return false;
            }
    
            sec1(sec);
    
        }, 1000);
    }
</script>
