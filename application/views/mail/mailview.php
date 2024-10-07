<style type="text/css">
	.mailview{
		width: 60vw;
	}
	.mailtitle{
		font-size: 1.5vw;
		padding: 0.5vw;
	}
	.mailsub{
		margin-top: 0.5vw;
		padding-bottom: 0.5vw;
		margin-bottom:0.5vw;
		border-bottom:1px solid #eef0f2;
	}
	.touser{
		display: flex;
		font-size:0.8vw;
		padding-left:0.5vw;
	}
	.fromuser{
		display:flex;
		font-size:0.8vw;
		padding-left:0.5vw;
	}
	.datet{
		display:flex;
		font-size:0.8vw;
		padding-left:0.5vw;
		color:grey;
	}
	.subdata{
		margin-right:0.3vw;
	}
	.mailcontent{
		font-size:1vw;
		min-height: 15vw;
		padding:1vw;
		
	}
	.mailbottom{
		display: flex;
		justify-content: flex-end;
	}
	.btn-outline-info{
		margin:0.2vw;
		width: 5vw;
		height: 2vw;
	}
	.repot{
		width: 60vw;
		display: flex;
		justify-content:flex-end;
		padding-bottom:0.2vw;
		border-bottom:1px solid #eef0f2;
	}
	.repotbtn{
		width: 1.5vw;
		height:1.5vw;
	}
	.repotbtn:hover{
		cursor: pointer;
	}
</style>
<div class="mailview">
	<div class="mailtitle"><?=$subject?></div>
	<div class="mailsub">
		<div class="touser"><div class="subdata">보낸 사람 : </div><div><?=$fromuseridx?></div></div>
		<div class="fromuser"><div class="subdata">받는 사람 : </div><div><?=$touseridx?></div></div>
		<div class="datet"><div class="subdata">전송 시각 : </div><div><?=$subdate?></div></div>
	</div>
	<div class="mailcontent"><?=$content?></div>
	<div class="repot" id="repot"><img class="repotbtn" src="/static/img/repot.png" alt=""></div>
	<div class="mailbottom">
		<button id="commentmail" class="btn btn-outline-info">답장</button>
		<button id="removemail" class="btn btn-outline-info">삭제</button>
	</div>
</div>
<script type="text/javascript">
	$('#commentmail').on('click',()=>{
		location.href='<?=base_url()?>mail/write/<?=$mailidx?>';
	})
	$('#removemail').on('click',()=>{
		location.href='<?=base_url()?>mail/remove?idx=<?=$mailidx?>';
	})
	$('#repot').on('click',()=>{
		location.href='<?=base_url()?>report/add?index=<?=$mailidx?>&class=2';
	})
</script>