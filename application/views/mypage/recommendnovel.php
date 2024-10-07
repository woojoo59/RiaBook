<style type="text/css">
	.df{
		display:flex;
	}
	<?php for($i=1;$i<=1000;$i++){ ?>
	.w<?=$i?>{
		width: <?=$i/10?>vw;
	}
	.h<?=$i?>{
		height: <?=$i/10?>vw;
	}
	.m<?=$i?>{
		margin: <?=$i/10?>vw;
	}
	.p<?=$i?>{
		padding: <?=$i/10?>vw;
	}
	.ml<?=$i?>{
		margin-left: <?=$i/10?>vw;
	}
	.pl<?=$i?>{
		padding-left: <?=$i/10?>vw;
	}
	.mt<?=$i?>{
		margin-top: <?=$i/10?>vw;
	}
	.pt<?=$i?>{
		padding-top: <?=$i/10?>vw;
	}
	.mr<?=$i?>{
		margin-right: <?=$i/10?>vw;
	}
	.pr<?=$i?>{
		padding-right: <?=$i/10?>vw;
	}
	.mb<?=$i?>{
		margin-bottom: <?=$i/10?>vw;
	}
	.pb<?=$i?>{
		padding-bottom: <?=$i/10?>vw;
	}
	<?php } ?>
	.bra{
		border: 1px solid black;
		border-radius: 0.3vw;
	}
	.fend{
		justify-content: flex-end;
	}
	.fmid{
		justify-content:center;
	}
	.fdc{
		flex-direction: column;
	}
	.fac{
		align-items: center;
	}
	.linetext{
		text-decoration: line-through;
	}
	.redtext{
		color: red;
	}
	.seleteddiv{
		border: 1px solid skyblue;
		outline: 2px solid skyblue;
	}
	.hoverpoint:hover{
		background-color:skyblue;
		cursor: pointer;
	}
	<?php for($i=1;$i<=20;$i++){ ?>
	.fontsize<?=$i?>{
		font-size: <?=$i/10?>vw;
	}
	<?php } ?>
	.greytext{
		color:grey;
	}
	.fstart{
		justify-content:flex-start;
	}
	.ullist{
		list-style-type: none;
		padding-left: 0; /* 전체 패딩 추가 */
	}
	.ullist>li{
		position:relative;
		padding-left: 1vw;
	}
	.ullist li::before{
		content: '※';
		position: absolute;
        left: 0;
        top: 0;
	}
    table {
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    td {
        text-align: center;
        vertical-align: middle;
        font-size: 0.9vw;
        color: #333;
        padding: 0.2vw;
        border: 2px solid #ddd;
    }
    td span {
        font-weight: bold;
        color: #007BFF;
    }
    #mainbtn:hover{
    	background-color:grey;
    }
</style>
<div class="w310 p5 df fdc fac fontsize10">
	<div class="w310 p5 df fend">
		<div class="df w130" title="해당 포인트를 사용하여 추천 리스트에 올릴 수 있습니다.">
			<div class="w50 fontsize9">My Point : </div>
			<div class="mr5"><i><?=number_format($mypoint)?></i></div>
			<div class="w30 fontsize9">Ria</div>
		</div>
	</div>
	<div class="w310 bra p5 df fmid fdc fac">
		<div id="select1" class="selectbox df w300 bra p5 m10 hoverpoint seleteddiv">
			<div class="df fmid w100">
				1일
			</div>
			<div class="w100"></div>
			<div class="w100 df fmid">
				10,000 Ria
			</div>
		</div>
		<div id="select2" class="selectbox df w300 bra p5 m10 hoverpoint">
			<div class="df fmid w100">
				7일
			</div>
			<div class="w100 df fmid fontsize9">
				<i class="linetext greytext w30">70,000</i>
				<div class="df ml20 w50"><div class="redtext"><i>10%</i></div><div class="ml5"><i>DC</i></div></div>
			</div>
			<div class="w100 df fmid">
				63,000 Ria
			</div>
		</div>
		<div id="select3" class="selectbox df w300 bra p5 m10 hoverpoint">
			<div class="df fmid w100">
				30일
			</div>
			<div class="w100 df fmid fontsize9">
				<i class="linetext greytext w30">300,000</i>
				<div class="df ml20 w50"><div class="redtext"><i>15%</i></div><div class="ml5"><i>DC</i></div></div>
			</div>
			<div class="w100 df fmid">
				255,000 Ria
			</div>
		</div>
		<div>
			<button id="mainbtn" class="p5 fontsize9 bra w100">추천 리스트 등록</button>
		</div>
	</div>
	<div class="w310 df fstart mt10 fontsize8 greytext">
		<div class="df fstart">
			<ul class="ullist">
				<li> 리스트는 다음날 0시 부터 적용 됩니다.</li>
				<li>
					적용된 리스트가 20개 넘을 시 다음 날 적용이 되지 않을 수 있으며<br>
					하루 하루 밀려서 적용됩니다.
				</li>
				<li>
					추천 리스트는 하루 총 20개로 정해져 있으며<br>
					하루 추천 소설이 20개 이하 일시 남은 리스트는<br>
					랭킹으로 채워집니다.
				</li>
				<li>
					포인트를 사용하여 추천 리스트 등록 후 환불이 불가능하오니<br>
					신중한 이용 부탁드립니다.
				</li>
				<li>
					소설 내 부적절한 내용이 발견될 시 비공개처리 및 추천 등록이 취소될 수 있습니다.<br>
				</li>
			</ul>
		</div>		
	</div>
</div>
<script>
	let flag = 1;
	let cost = <?=$mypoint?>;
	let costy = 0;
	$('#select1').on('click',()=>{
		flag = 1;
		sel10(1);
	})
	$('#select2').on('click',()=>{
		flag = 2;
		sel10(2);
	})
	$('#select3').on('click',()=>{
		flag = 3;
		sel10(3);
	})

	$('#mainbtn').on('click',()=>{
		switch (flag) {
			case 2:
				costy = 63000;
				break;
			case 3:
				costy = 255000;
				break;
			default:
				costy = 10000;
				break;
		}
		if(cost < costy){
			$('#saymain').html('포인트가 충분하지 않습니다.<br>충분한포인트를 확보해주세요.');
			sayopen(1)
			return false;
		}
		$.post('<?=base_url()?>novel/checkrecommend/<?=$idx?>',{'flag':flag},function(data){
			const obj = JSON.parse(data);
			console.log(obj);
			if(obj.result == 0){
				$('#saymain').html('포인트가 충분하지 않습니다.<br>충분한포인트를 확보해주세요.');
				sayopen(1)
				return false
			} else{
				let text = '';
				let test = 0;
				(obj.nodays).forEach( function(nodays) {
					text += '<tr><td class="saylist">';
					text += nodays;
					text += '</td></tr>';
					test++;
				});
				$('#saymain').html(obj.sday+' ~ '+obj.fday+'<br>추천을 등록하시겠습니까?<br><br><table><tr><td>등록불가 리스트</td></tr>'+text);
				if(text == '')$('#saymain').html(obj.sday+' ~ '+obj.fday+'<br>추천을 등록하시겠습니까?<br>');
				sayopen()
			}
        })
	})



	function sel10(test){
		$('.selectbox').attr('class','selectbox df w300 bra p5 m10 hoverpoint')
		$('#select'+test).attr('class', 'selectbox df w300 bra p5 m10 hoverpoint seleteddiv')
	}
</script>

<!-- <script src="<?=base_url()?>static/js/mousedevelopfalse.js"></script> -->
