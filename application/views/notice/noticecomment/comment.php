<style type="text/css">
	.commentmain{
		width: 80vw;
		margin-top: 1vw;
		margin-bottom: 2vw;
	}
	.commenttop{
		width: 80vw;
		height: 3vw;
		font-size: 1.5vw;
		display: flex;
		align-items: center;
	}
	.commentcontent{
		min-height: 3vw;
		width: 67vw;
		margin-left:1vw;
		margin-right: 1vw;
		border: 1px solid #eef0f2;
		border-radius: 0.5vw;
		font-size:1.3vw;
		padding: 0.5vw;
	}
	.recommentcontent{
		min-height: 3vw;
		width: 67vw;
		margin-right: 1vw;
		border: 1px solid #eef0f2;
		border-radius: 0.5vw;
		font-size:1.3vw;
		padding: 0.5vw;
	}
	.commentcontent:focus{
		outline: none;
	}
	.recommentcontent:focus{
		outline: none;
	}
	.commentform{
		display: flex;
	}
	.commentsubmit{
		height: 3vw;
		width: 10vw;
		font-size:1.5vw;
		outline: none;
		border:none;
		border-radius:0.5vw;
	}
	.commentlistdiv{
		margin-top:1vw;
		margin-left:1vw;
	}
	.commenttd1{
		width: 67vw;
		display: flex;
		flex-direction: column;
		align-items: flex-start;
	}
	.commenttd2{
		width: 11vw;
    	display: flex;
    	align-items: center;
    	justify-content: center;
    	flex-direction: column;
	}
	.commentbtn{
		width: 8vw;
		height: 2.5vw;
	}
	.mycommentcontent{
		width: 67vw;
		font-size:1.3vw;
	}
	.creator{
		padding: 0.5vw;
		border-radius:0.5vw;
		background-color:#bdf0f3;
		width: auto;
	}
	.commenttr{
		display: flex;
		border-bottom:1px solid #eef0f2;
		padding-top: 0.5vw;
		padding-bottom: 0.2vw;
	}
	.commenttd{
		width: 78vw;
		display: flex;
		flex-direction: column;
		align-items: flex-start;
	}
	.contentspan{
		width: 60vw;
		font-size:1.3vw;
	}
	.creatorspan{
		padding: 0.5vw;
		border-radius:0.5vw;
		background-color:#bdf0f3;
		width: auto;
	}
	.recomment{
		width: 100%;
		display: flex;
		justify-content: flex-end;
    	align-items: center;
	}
	.recommentbtn:hover{
		cursor: pointer;
	}
	tr{
		border-collapse: collapse;
	}
	.df{
		display: flex;
		margin-top:0.5vw;
	}
	.none{
		display: none;
	}
	.pagebtn{
		padding:0.5vw;
		display: flex;
		justify-content: center;
    	align-items: center;
	}
	.repot{
		margin-left:1vw;
		width:1.3vw;
	}
	.repot:hover{
		cursor: pointer;
	}
	.commentwrite{
		border-bottom: :1px solid #eef0f2;
	}
</style>
<div class="commentmain">
	<?php if(isset($_SESSION['useridx'])){ ?>
	<div class="commentwrite">
		<form method="post" action="<?=base_url()?>comment/commentwrite?index=<?=$_GET['view']?>&forcategory=1" 
			class="commentform" id='commentform'>
			<div id="commentcontent" class="commentcontent" contenteditable></div>
			<button id="commentsubmit" class="commentsubmit">댓글 작성</button>
			<input name="content" id="hiddencontent" type="hidden">
			<input name="comg" type="hidden" value="0">
			<input type="hidden" name="view" value="0">
		</form>
	</div>
<?php } ?>
	<div class="commentlistdiv">
		<table>
			



