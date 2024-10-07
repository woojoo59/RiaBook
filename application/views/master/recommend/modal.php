<style type="text/css">
	.dn{
        display: none;
    }
    .say{
        width: 15vw;
        border-radius:0.5vw;
        border:1px solid #e6e9ec;
        position: fixed;
        top: 15vw;
        left: 42.5vw;
        padding: 0.5vw;
        background-color: #E3FDFD;
        pointer-events: auto; /* 이 div는 클릭 이벤트 허용 */
        z-index: 1001;
    }
    .sayhead{
        display: flex;
        justify-content:flex-end;
        padding-bottom: 0.5vw;
        margin-bottom:0.5vw;
        border-bottom: 1px solid #e6e9ec;

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
    .saybot{
    	border-top: 1px solid #e6e9ec;
    	margin-top:0.5vw;
    	padding-top: 0.5vw;
    	display: flex;
    	justify-content:center;
    	align-items:center;
    }
    .saybtns{
    	width: 5vw;
    	font-size:0.9vw;
    	padding:0.3vw;
    	border:none;
    	
    }
    .saybtns{
        border:1px solid #e6e9ec;
    	border-radius:0.3vw;
    }
    .saybtns:hover{
    	background-color: #E3FDFD;
    }

    .opensay{
    	pointer-events: none;
    }
    .filtering{
    	width: 100vw;
    	height: 100vw;
    	position: fixed;
    	top:0;
    	left:0;
    	z-index: 1000;
    	background-color:rgba(0, 0, 0, 0.5);
    }
</style>
<div id="filtering" class="filtering dn">
	
</div>
<div id="saydiv" class="say dn">
    <div class="sayhead">
        <div id="saysec" class="saysec"></div>
        <button type="button" id="saybtn" class="btn-close" aria-label="Close"></button>
    </div>
    <div id="saymain" class="saymain">추천은 해당 유저의 포인트를 사용하여 등록한 리스트입니다.<br>정말 추천 리스트에서 해당 소설을 삭제하시겠습니까?</div>
    <div class='saybot'>
    	<div class="saybtnsdiv">
    		<button id="sayyes" class='saybtns' title="검색된 당일만 삭제됩니다.">당일 삭제</button>
            <button id="sayyes2" class='saybtns' title="검색된 날짜 이후 등록된 추천 리스트에서 전부 삭제됩니다.">전체 삭제</button>
    	</div>
    </div>
</div>
<script>
	$('#saybtn').on('click',()=>{
		$('#saydiv').attr('class','say dn');
		$('body').css('overflow','').attr('class','');
		$('#filtering').attr('class','filtering dn');
	})


    function sayopen(idx){
        $('#saydiv').attr('class','say');
        $('body').css('overflow','hidden').attr('class','opensay');
        $('#filtering').attr('class','filtering');

        $('#sayyes').on('click',()=>{
            location.href='<?=base_url()?>master/deleterecommend/'+idx+'?option=0&date='+$('#fromdate').val();
        })
        $('#sayyes2').on('click',()=>{
            location.href='<?=base_url()?>master/deleterecommend/'+idx+'?option=1&date='+$('#fromdate').val();
        })
    }
</script>