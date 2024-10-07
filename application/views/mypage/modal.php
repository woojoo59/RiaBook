<style type="text/css">
	.dn{
        display: none;
    }
    .say{
        width: 15vw;
        border-radius:0.5vw;
        border:1px solid;
        position: fixed;
        top: 15vw;
        left: 42.5vw;
        padding: 0.5vw;
        background-color: skyblue;
        pointer-events: auto; /* 이 div는 클릭 이벤트 허용 */
        z-index: 1001;
    }
    .sayhead{
        display: flex;
        justify-content:flex-end;
        padding-bottom: 0.5vw;
        margin-bottom:0.5vw;

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
        overflow-y:scroll;
        overflow-x: hidden;
    }
    .saybot{
    	margin-top:0.5vw;
    	padding-top: 0.5vw;
    	display: flex;
    	justify-content:center;
    	align-items:center;
    }
    .saybtns{
    	width: 4vw;
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
        overflow:hidden;
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
    <div id="saymain" class="saymain"></div>
    <div class='saybot'>
    	<div class="saybtnsdiv">
    		<button id="sayyes" class='saybtns'>확인</button>
    	</div>
    </div>
</div>
<script>
	$('#saybtn').on('click',()=>{
		$('#saydiv').attr('class','say dn');
		$('body').css('overflow','').attr('class','');
		$('#filtering').attr('class','filtering dn');
	})


    function sayopen(i){
        $('#saydiv').attr('class','say');
        $('body').css('overflow','hidden').attr('class','opensay');
        $('#filtering').attr('class','filtering');

        switch (i) {
            case 1:
                $('#sayyes').on('click',()=>{
                    $('#saybtn').trigger('click');
                })
                break;
            default:
                $('#sayyes').on('click',()=>{
                    history.replaceState(null, null, '<?=base_url()?>');
                    location.href='<?=base_url()?>novel/recommendmynovel/<?=$idx?>?flag='+flag
                })
                break;
        }
    }
</script>