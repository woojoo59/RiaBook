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
		padding:0.5vw;
	}
	.noticebtns{
		width: 4vw;
		height: 2vw;
		border: 1px solid #eef0f2;
		border-collapse: collapse;
		background-color: white;
		border-radius:0.3vw;
	}
	.noticebtns:hover{
		background-color:#eef0f2;
	}
</style>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body echobody">
        해당 게시글을 정말로 삭제하시겠습니까?
      </div>
      <div class="modal-footer">
        <button type="button" class="echobtn btn btn-secondary" data-bs-dismiss="modal">아니요</button>
        <button type="button" id="noticeremove" class="echobtn btn btn-primary">예</button>
      </div>
    </div>
  </div>
</div>
<div class="pagemain">
	<div class="title"><?=$title?></div>
	<div class="content"><?=$content?></div>
	<div class="noticebtnsdiv">
	<?php if(isset($_SESSION['useridx']) and $_SESSION['useridx']==1){ ?>
	
		<button id="noticeedit" class="noticebtns">수정</button>
		<button class="noticebtns" data-bs-toggle="modal" data-bs-target="#exampleModal">삭제</button>
	



	<script type="text/javascript">
		$('#noticeedit').on('click',()=>{
			location.href='<?=base_url()?>notice/editpage?view=<?=$_GET['view']?>'
		})
		$('#noticeremove').on('click',()=>{
			location.href='<?=base_url()?>notice/remove?view=<?=$_GET['view']?>'
		})
	</script>
	<?php } ?>
		<button id="listbtn" class="noticebtns">목록</button>
	</div>
	<script>
		$('#listbtn').on('click',()=>{
			location.href='<?=base_url()?>home/notice';
		})
	</script>
