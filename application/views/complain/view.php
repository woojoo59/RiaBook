<style type="text/css">
	.pagemain{
		width: 80vw;
	}
	.title{
		padding: 0.5vw;
		width: 80vw;
		min-height: 3vw;
		border-bottom: 1px solid #eef0f2;
		font-size: 1.3vw;
	}
	.content{
		padding: 0.5vw;
		margin-top: 1vw;
		width: 80vw;
		min-height: 16vw;
		font-size:1vw;
		border-bottom: 1px solid #eef0f2;
	}
	.echobody{
		height: 10vw;
		display: flex;
		align-items: center;
    	justify-content: center;
    	font-size:1.2vw;
	}
	.echobtn{
		width: 5vw;
	}
	.noticebtnsdiv{
		width: 80vw;
		display: flex;
		justify-content: flex-end;
	}
	.complaincomment{
		border-bottom: 1px solid #eef0f2;
		padding: 0.5vw;
		margin-top: 1vw;
		width: 80vw;
		min-height: 16vw;
		font-size:1vw;
	}
	.complainbtns{
		padding: 0.5vw;
		display:flex;
		justify-content:flex-end;
	}
	.complainbtn{
		width: 4vw;
		height:2vw;
		border-radius: 0.3vw;
		border:1px solid #eef0f2;
		background-color: white;
	}
	.complainbtn:hover{
		background-color:#eef0f2;
	}
	.creator{
		font-size:0.8vw;
	}
</style>
<div class="pagemain">
	<div class="title"><?=$subject?><?php if($_SESSION['useridx']==1)echo '<br><div class="creator">작성자 : '.$nick.'</div>'; ?></div>
	<div class="content"><?=$content?></div>
	<?php if($comment!=''){ ?>
		<div class="complaincomment"><?=$comment?></div>
	<?php } ?>
	<div class="complainbtns"><button id="complainbtn" class='complainbtn'>목록</button></div>
</div>
<script type="text/javascript">
	$('#complainbtn').on('click',()=>{
		location.href = '<?=base_url()?>other/complain';
	})
</script>
