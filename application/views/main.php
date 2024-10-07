<style type="text/css">
	.main{
		flex-direction: column;
		align-items: center;
	}
	.noticemain{
		width: 60vw;
		margin-bottom: 1vw;
	}
	.noticeheader{
		display: flex;
		
		background-color: #eef0f2;
		justify-content: space-between;
		align-items:center;
	}
	.noheader{
		width: 50vw;
		font-size: 1.3vw;
	}
	.addnotice{
		border-radius: 0.3vw;
		margin-right: 0.2vw;
	}
	.noticetd{
		font-size:1vw;
		padding: 0.2vw;
		width: 60vw;
	}
	.noticetr{
		border-bottom: 1px solid #eef0f2;
	}
	.noticetd>a{
		color:black;
	}
</style>
<div class="noticemain">
	<div class="noticeheader">
		<div class="noheader">공지사항</div>
		<a href="<?=base_url()?>home/notice"><div class="addnotice">더 보기 +</div></a>
	</div>
	<table class="noticetable">
		<?php for($i=0;$i<5;$i++){ ?>
		<tr class="noticetr">
			<td class="noticetd"><a href="<?=base_url()?>notice/view?view=<?=$notices[$i]->noticeidx?>"><?=$notices[$i]->title?></a></td>
		</tr>
		<?php } ?>
	</table>
</div>
