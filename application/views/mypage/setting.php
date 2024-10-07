<style type="text/css">
    .example{
        font-size:<?=$setting[0]?>px;
        line-height: <?=$setting[1]?>px;
        color:<?=$setting[2]?>;
        background-color: <?=$setting[3]?>; 
        padding: 0.5vw;
    }
    .setting{
        display: flex;
        height: 3vw;
    }
    .set1{
        width: 10vw;
    }
    .set2{
        width: 2vw;
    }
    .set3{
        width: 10vw;
    }
    .set3>input{
        width: 10vw;
    }
    .setingbody{
        display: flex;
        flex-direction: column;
        align-items: center
    }
    .mlvw-1{
    margin-left: 1vw;
    width: 8vw;
}
.usermodal{
    display: flex;
}
</style>
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">환경 설정</h1>
        <button type="button" id="setclose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url()?>users/setting" method="post" class="setingbody" id="setform">
            <div class="setting">
                <div class="set1">폰트 사이즈</div>
                <div class="set2">:</div>
                <div class="set3"><input type="number" name="size" id="fontsize" value="<?=$setting[0]?>"></div>              
             </div>
             <div class="setting">
                <div class="set1">줄 간격</div>
                <div class="set2">:</div>
                <div class="set3"><input type="number" name="height" id="lineheight" value="<?=$setting[1]?>"></div>              
             </div>
             <div class="setting">
                <div class="set1">폰트 컬러</div>
                <div class="set2">:</div>
                <div class="set3"><input type="color" name="fcolor" id="fontcolor" value="<?=$setting[2]?>"></div>              
             </div>
             <div class="setting">
                <div class="set1">배경 컬러</div>
                <div class="set2">:</div>
                <div class="set3"><input type="color" name="bcolor" id="backcolor" value="<?=$setting[3]?>"></div>              
             </div>
             <input type="hidden" name="url" value="<?=$_SERVER['REQUEST_URI']?>">
        </form>
        <hr>
        <div>
            <div class="example" id="examplefont">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde impedit corporis itaque mollitia molestias accusamus repellat soluta expedita dignissimos architecto esse quia tenetur consequatur, dolores fugiat eum, culpa fugit in.
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="resetsetting" class="btn btn-secondary">reset</button>
        <button type="button" id="setsave" class="btn btn-primary">저장</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $('#fontsize').on('change',()=>{
        $('#examplefont').css('font-size',$('#fontsize').val()+'px');
    })
    $('#lineheight').on('change',()=>{
        $('#examplefont').css('line-height',$('#lineheight').val()+'px');
    })
    $('#fontcolor').on('change',()=>{
        $('#examplefont').css('color',$('#fontcolor').val());
    })
    $('#backcolor').on('change',()=>{
        $('#examplefont').css('background-color',$('#backcolor').val());
    })

    $('#Modal').on('hidden.bs.modal', function () {
        $('#fontsize').val(<?=$setting[0]?>);
        $('#lineheight').val(<?=$setting[1]?>);
        $('#fontcolor').val('<?=$setting[2]?>');
        $('#backcolor').val('<?=$setting[3]?>');
        reset()
    });
    const setform =  document.querySelector('#setform')
    $('#setsave').on('click',()=>{
        if($('#fontsize').val()==''){
            alert('폰트 사이즈가 비어있습니다.');
            return false;
        }
        if($('#lineheight').val()==''){
            alert('줄 간격 비어있습니다.');
            return false;
        }
        history.replaceState(null, null, '<?=base_url()?>');
        setform.submit();
    })
    $('#resetsetting').on('click',()=>{
        $('#fontsize').val(16);
        $('#lineheight').val(30);
        $('#fontcolor').val('#000000');
        $('#backcolor').val('#ccffcc');
        reset()
    })
    $(window).on('load',()=>{
        $('#viewermain').css('font-size',<?=$setting[0]?>+'px').css('line-height',<?=$setting[1]?>+'px')
        .css('color','<?=$setting[2]?>')
        .css('background-color','<?=$setting[3]?>')
    })

    function reset(){
        $('#examplefont').css('font-size',$('#fontsize').val()+'px').css('line-height',$('#lineheight').val()+'px').css('color',$('#fontcolor').val()).css('background-color',$('#backcolor').val());
    }
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">본인인증</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3 usermodal">
                    <input type="text" class="form-control modalinput" id="sms" placeholder="name@example.com">
                    <label for="sms">휴대폰 번호 '-'없이 11글자</label>
                    <button class="btn btn-primary mlvw-1" id="smsbtn">전송</button>
                </div>
                <div class="form-floating usermodal">
                    <input type="password" class="form-control modalinput" id="smsck" placeholder="Password">
                    <label for="smsck">인증번호</label>
                    <button class="btn btn-primary mlvw-1" disabled id="smsckbtn">인증</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    let okphone = 0
    let option = 2;

    $('#smsbtn').on('click',()=>{
        if($('#sms').val().length != 11){
            alert('올바른 휴대폰 번호를 입력해주세요.');
            return false;
        }
        let pattern = /[^0-9]/;
        if(pattern.test($('#sms').val())){
            alert('올바른 휴대폰 번호를 입력해주세요.');
            return false
        }

        $.post('<?=base_url()?>users/sms',{'phonenumber':$('#sms').val(),'option':3},function(data){
            let obj = JSON.parse(data);
            okphone = obj.result;
            if(okphone=='no'){
                alert('등록된 번호가 아닙니다.');
                return false
            }
            $('#smsckbtn').removeAttr('disabled');
        })
    })


    
    $('#smsckbtn').on('click',()=>{
        $.post('<?=base_url()?>users/pwdhash',{'number':$('#smsck').val(),'hash':okphone},function(data){
            let obj = JSON.parse(data);
            if(obj.result=='ok'){
                var newForm = document.createElement('form');
                newForm.name = 'newForm';
                newForm.method = 'post';
                newForm.action = '<?=base_url()?>users/userinformation';

                var input = document.createElement('input');
                // set attribute (input)
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "data");
                input.setAttribute("value", "ok");

            
                // append input (to form)
                newForm.appendChild(input);
                document.body.appendChild(newForm);
                newForm.submit();
            }else {
                alert('인증번호가 다릅니다.');
            }
        })
    })
</script>